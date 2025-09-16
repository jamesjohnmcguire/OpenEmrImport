<?php
/////////////////////////////////////////////////////////////////////////////
// PracticeFusionImport Class
//
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once 'vendor/autoload.php';
require_once "Libraries/DatabaseLibrary.php";

require_once "DataObjects/chart_tracker.php";
require_once "DataObjects/codes.php";
require_once "DataObjects/documents.php";
require_once "DataObjects/form_soap.php";
require_once "DataObjects/form_vitals.php";
require_once "DataObjects/immunizations.php";
require_once "DataObjects/lists.php";
require_once "DataObjects/openemr_postcalendar_events.php";
require_once "DataObjects/patient_data.php";
require_once "DataObjects/pnotes.php";
require_once "DataObjects/prescriptions.php";
require_once "DataObjects/users.php";

require_once "ExcelWorkSheets/ExcelColumns.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Cache\Adapter\Memcache;
use Cache\Adapter\Common\AbstractCachePool;
use Cache\Adapter\Common\PhpCacheItem;
use Cache\Adapter\Common\TagSupportWithArray;

class PracticeFusionImport
{
	private $currentNumber = 0;
	private $database = null;
	private $dataStartRow;
	private $debug = null;
	private $excelFile = null;
	private $failedRecords = 0;
	private $inputSourceId = 0;
	private $lastQuery;
	private $logFile = null;
	private $today;
	private $uploadsDirectory = null;

	function __construct($level, $logFile, $uploadsDirectory, $host,
		$user, $password)
	{
		$this = self::)
	{
		$this->logFile = $logFile;
		$this->uploadsDirectory = $uploadsDirectory;

		$this->debug = new Debug($level, $this->logFile);

		$this->dataStartRow	= 2;
		$this->today	= date('Y-m-d');

		$this->database = new DatabaseLibrary($host, 'openemr', $user,
			$password, false, Debug::DEBUG, $logFile,
			$this->lastQuery);

		set_error_handler(array($this, 'ErrorHandler')); 
	}

	public function ErrorHandler($errno, $errstr, $errfile, $errline)
	{
		$error = 'PHP ERROR: '.$errno.' '.$errstr.' '.$errfile.' '.$errline;
		$this->debug->Show(Debug::ERROR, $error);

		$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		$this->debug->Dump(Debug::ERROR, $trace);
		Common::FlushBuffers();

		exit('ERRORS');
	}

	public function Import($inputFileName)
	{
		$this->debug->Show(Debug::DEBUG, "opening file");
		Common::FlushBuffers();

		$this->excelFile = $inputFileName;

		$useCache = false;

		if (true == $useCache)
		{
			$pool = new \Cache\Adapter\Apcu\ApcuCachePool();
			$simpleCache =
				new \Cache\Bridge\SimpleCache\SimpleCacheBridge($pool);
			\PhpOffice\PhpSpreadsheet\Settings::setCache($simpleCache);
		}

		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($inputFileName);

		$this->debug->Show(Debug::DEBUG, "getting worksheets");
		Common::FlushBuffers();
		$workSheets = $spreadsheet->getAllSheets();

		foreach($workSheets as $workSheet)
		{
			$title = $workSheet->getTitle();
			$this->debug->Show(Debug::DEBUG, "checking worksheet: $title");

			$function = str_replace(' ', '', $title);
			$function = str_replace('&', '', $function);

			$this->ProcessWorkSheet($function, $workSheet, 1);
			Common::FlushBuffers();
		}
	}

	private function ProcessWorkSheet($callBack, $workSheet, $begin)
	{
		$this->debug->Show(Debug::INFO, "ProcessWorkSheet begin");

		$index = 0;
		foreach ($workSheet->getRowIterator() AS $row)
		{
			try
			{
				if ($index >= $begin)
				{
					$cellIterator = $row->getCellIterator();
					// This loops through all cells
					$cellIterator->setIterateOnlyExistingCells(false);

					$cells = array();
					foreach ($cellIterator as $cell)
					{
						$cell = $cell->getValue();

						if ($cell == null)
						{
							$cell = '';
						}

						$cells[] = $cell;
					}

					$emptyRow = true;

					foreach($cells as $cell)
					{
						if (!empty($cell))
						{
							$emptyRow = false;
							break;
						}
					}

					if (false == $emptyRow)
					{
						$this->$callBack($workSheet, $cells, $index);
					}
				}
			}
			catch(Throwable $exception)
			{
				// PHP 7.x
				$message = "EXCEPTION ".$exception;

				if (!empty($this->lastQuery))
				{
					$message .= "\r\nquery: $this->lastQuery";
				}

				$this->debug->Show(Debug::ERROR, $message);

				exit('fatal exception');
			}
			catch(Exception $exception)
			{
				// PHP 5.x
				$message = "EXCEPTION ".$exception->getMessage();
				$code = $exception->getCode();

				if (!empty($this->lastQuery))
				{
					$messsage .= $this->lastQuery;
				}

				$this->debug->Show(Debug::ERROR, $message);
				exit('fatal exception');
			}

			$index++;
		}
	}

	private function Patients($workSheet, $row, $index)
	{
		$patients = new patient_data(
			$this->database, $this->debug, $this->lastQuery);
		$pnotes = new pnotes($this->database, $this->debug, $this->lastQuery);

		$givenName = $row[FirstName];
		$familyName = $row[LastName];
		$email = strtolower($row[Email]);

		$patientGuid = $row[PatientGUID];
		$patientRecordNumber = $row[PatientRecordNumber];
		$middleInitial = $row[MiddleInitial];
		$suffixOption = $row[SuffixOption];
		$race = $row[Race];
		$homePhone = $row[HomePhone];
		$officePhone = $row[OfficePhone];
		$mobilePhone = $row[MobilePhone];
		$SSNumber = $row[SSNumber];
		$language = $row[Language];
		$ethnicity = $row[Ethnicity];
		$comments = $row[Comments];

		$value = $row[DateOfBirth];
		$date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
			$value);
		$dateOfBirth = $date->format('Y-m-d');

		$genderInitial = $row[Gender];

		if ('F' == $genderInitial)
		{
			$gender = "Female";
		}
		else if ('M' == $genderInitial)
		{
			$gender = "Male";
		}
		else
		{
			$gender = "Unknown";
		}

		$isActive = $row[IsActive];

		if ('1' == $isActive)
		{
			$active = "Is Active: true";
		}
		else
		{
			$active = "Is Active: false";
		}

		$patient = $this->GetPatientByNameOrEmail($row);

		if (!empty($patient))
		{
			$id = $patient['id'];

			$message = "Patient found: $givenName $familyName";
			$this->debug->Show(Debug::DEBUG, $message);

			if ((empty($patient['patient_guid'])) && (!empty($patientGuid)))
			{
				$patients->Update($patient['id'], array('patient_guid'),
					array($patientGuid), array('s'));
			}

			if ((empty($patient['usertext1'])) &&
				(!empty($patientpatientNumber)))
			{
				$patients->Update($patient['id'], array('usertext1'),
					array($patientGuid), array('s'));
			}

			// if person found by email, it's possible this may be empty
			if ((empty($patient['fname'])) && (!empty($givenName)))
			{
				$patients->Update($patient['id'], array('fname'),
					array($givenName), array('s'));
			}

			if ((empty($patient['lname'])) && (!empty($familyName)))
			{
				$patients->Update($patient['id'], array('lname'),
					array($familyName), array('s'));
			}

			if ((empty($patient['mname'])) && (!empty($middleInitial)))
			{
				$patients->Update($patient['id'], array('mname'),
					array($middleInitial), array('s'));
			}

			if ((empty($patient['title'])) && (!empty($suffixOption)))
			{
				$patients->Update($patient['id'], array('title'),
					array($suffixOption), array('s'));
			}

			if ((empty($patient['race'])) && (!empty($race)))
			{
				$patients->Update($patient['id'], array('race'),
					array($race), array('s'));
			}

			if ((empty($patient['phone_home'])) && (!empty($homePhone)))
			{
				$patients->Update($patient['id'], array('phone_home'),
					array($homePhone), array('s'));
			}

			if ((empty($patient['phone_biz'])) && (!empty($officePhone)))
			{
				$patients->Update($patient['id'], array('phone_biz'),
					array($officePhone), array('s'));
			}

			if ((empty($patient['phone_cell'])) && (!empty($mobilePhone)))
			{
				$patients->Update($patient['id'], array('phone_cell'),
					array($mobilePhone), array('s'));
			}

			if ((empty($patient['email'])) && (!empty($email)))
			{
				$patients->Update($patient['id'], array('email'),
					array($email), array('s'));
			}

			if ((empty($patient['ss'])) && (!empty($SSNumber)))
			{
				$patients->Update($patient['id'], array('ss'),
					array($SSNumber), array('s'));
			}

			if ((empty($patient['DOB'])) && (!empty($dateOfBirth)))
			{
				$patients->Update($patient['id'], array('DOB'),
					array($dateOfBirth), array('s'));
			}

			if ((empty($patient['sex'])) && (!empty($gender)))
			{
				$patients->Update($patient['id'], array('sex'),
					array($gender), array('s'));
			}

			if ((empty($patient['language'])) &&
				(!empty($language)))
			{
				$patients->Update($patient['id'], array('language'),
					array($language), array('s'));
			}

			if ((empty($patient['ethnicity'])) &&
				(!empty($ethnicity)))
			{
				$patients->Update($patient['id'], array('ethnicity'),
					array($ethnicity), array('s'));
			}

			if ((empty($patient['usertext2'])) &&
				(!empty($active)))
			{
				$patients->Update($patient['id'], array('usertext2'),
					array($active), array('s'));
			}
		}
		else
		{
			$id = $patients->Insert($suffixOption, $language, '', $givenName,
				$familyName, $middleInitial, $dateOfBirth, '', '', '', '', '',
				'', $SSNumber, '', $homePhone, $officePhone, '', $mobilePhone,
				0, '', '', null, $gender, '', '', null, null, $email, '', '',
				$race, $ethnicity, '', '', '', '', '', '', '', '', '', 0, '',
				'', '', '', '', '', '', '', 'NO', 'NO', '', 0, '',
				$patientRecordNumber, $active, '', '', '', '', '', '', '', '',
				'', '', '', '', '', 'standard', null, null, 'NO', null, '',
				'', '', '', '', '', '', null, '', null, '', null, '', '', '',
				'', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
				$patientGuid);
		}

		if (!empty($comments))
		{
			$pnotes->Insert(null, $comments, $id, null, null, null, null,
				null, null, 0, 'New', null, 0);
		}
	}

	private function Providers($workSheet, $row, $index)
	{
		$providers =
			new users($this->database, $this->debug, $this->lastQuery);

		$where = " WHERE (fname LIKE ? AND lname = ?) OR email = ?";

		$givenName = $row[ProviderFirstName];
		$familyName = $row[ProviderLastName];
		$email = strtolower($row[Email]);

		$providerGuid = $row[ProviderGUID];
		$userGuid = $row[UserGUID];
		$userName = $row[UserName];
		$suffixOption = $row[ProviderSuffixOption];
		$officePhone = $row[OfficePhone];

		$values = array("%$givenName%", $familyName, $email);
		$types = array('s', 's', 's');

		$records = $providers->GetList($where, $values, $types);

		$count = count($records);

		if ($count > 1)
		{
			$this->debug->Show(Debug::WARNING, 'WARNING: '.
				"$count RECORDS FOUND FOR: : $givenName $familyName");
		}

		if ($count > 0)
		{
			$record = $records[0];
			$message =
				"Provider found: $givenName $familyName";
			$this->debug->Show(Debug::DEBUG, $message);

			if ((empty($record['provider_guid'])) &&
				(!empty($providerGuid)))
			{
				$providers->Update($record['id'], array('provider_guid'),
					array($providerGuid), array('s'));
			}

			if ((empty($record['user_guid'])) &&
				(!empty($userGUID)))
			{
				$providers->Update($record['id'], array('user_guid'),
					array($userGUID), array('s'));
			}

			if ((empty($record['username'])) &&
				(!empty($userName)))
			{
				$providers->Update($record['id'], array('username'),
					array($userName), array('s'));
			}

			// if person found by email, it's possible this may be empty
			if ((empty($record['fname'])) &&
				(!empty($givenName)))
			{
				$providers->Update($record['id'], array('fname'),
					array($givenName), array('s'));
			}

			if ((empty($record['lname'])) &&
				(!empty($familyName)))
			{
				$providers->Update($record['id'], array('lname'),
					array($familyName), array('s'));
			}

			if ((empty($record['title'])) &&
				(!empty($suffixOption)))
			{
				$providers->Update($record['id'], array('title'),
					array($suffixOption), array('s'));
			}

			if ((empty($record['phonew1'])) &&
				(!empty($officePhone)))
			{
				$providers->Update($record['id'], array('phonew1'),
					array($officePhone), array('s'));
			}

			if ((empty($record['email'])) &&
				(!empty($email)))
			{
				$providers->Update($record['id'], array('email'),
					array($email), array('s'));
			}
		}
		else
		{
			$officePhone = 'office phone';

			$id = $providers->Insert($userName, '', null, null, null,
				$givenName, '', $familyName, null, null, null,
				null, null, 0, 1, 1, null, $suffixOption, null, null, $email,
				'', null, null, null, null, null, null, null, null, null,
				null, null, null, null, null, null, null, $officePhone,
				null, null, null, 1, '207Q00000X', 0, '', null, null, null,
				'', '', null, null, null, null, null, 'standard', 'standard',
				$providerGuid, $userGuid);
		}
	}

	private function Address($workSheet, $row, $index)
	{
		$patients = new patient_data(
			$this->database, $this->debug, $this->lastQuery);

		$where = " WHERE patient_guid = ?";

		$patientGuid = $row[PatientGUID];

		$addressLine1 = $row[AddressLine1];
		$addressLine2 = $row[AddressLine2];
		$city = strtolower($row[City]);
		$state = $row[State];
		$zipCode = $row[ZipCode];
		$country = $row[Country];

		$address = "$addressLine1 $addressLine2";

		$patient = $this->GetPatientByGuid($row);

		if (!empty($patient))
		{
			$message = "Patient found: $patientGuid";
			$this->debug->Show(Debug::DEBUG, $message);

			if ((empty($patient['street'])) &&
				(!empty($address)))
			{
				$patients->Update($patient['id'], array('street'),
					array($address), array('s'));
			}

			if ((empty($patient['city'])) &&
				(!empty($city)))
			{
				$patients->Update($patient['id'], array('city'),
					array($city), array('s'));
			}

			if ((empty($patient['state'])) &&
				(!empty($state)))
			{
				$patients->Update($patient['id'], array('state'),
					array($state), array('s'));
			}

			if ((empty($patient['postal_code'])) &&
				(!empty($zipCode)))
			{
				$patients->Update($patient['id'], array('postal_code'),
					array($zipCode), array('s'));
			}

			if ((empty($patient['country_code'])) &&
				(!empty($country)))
			{
				$patients->Update($patient['id'], array('country_code'),
					array($country), array('s'));
			}
		}
		else
		{
			$this->debug->Show(Debug::WARNING, 'WARNING: '.
				"No patient data found for address with: $patientGuid");

			$id = $patients->Insert('', '', '', '', '', '', null, $address,
				$zipCode, $city, $state, $country, '', '', '', '', '', '', '',
				0, '', '', null, '', '', '', null, null, '', '', '', '', '',
				'', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '',
				'', '', 'NO', 'NO', '', 0, '', '', '', '', '', '', '', '', '',
				'', '', '', '', '', '', '', 'standard', null, null, 'NO',
				null, '', '', '', '', '', '', '', null, '', null, '', null,
				'', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
				'', '', '', $patientGuid);
		}
	}

	private function Insurance($workSheet, $row, $index)
	{
	}

	private function ChartAccess($workSheet, $row, $index)
	{
		$patients = new patient_data(
			$this->database, $this->debug, $this->lastQuery);

		$patientGuid = $row[PatientGUID];

		$patient = $this->GetPatientByGuid($row);

		if (!empty($patient))
		{
			$provider = $this->GetProviderByGuid($row);

			if (!empty($provider))
			{
				$tracker = new chart_tracker(
					$this->database, $this->debug, $this->lastQuery);

				$where =
					" WHERE ct_pid = ? AND ct_userid = ? AND ct_when = ?";

				$patientId = $patient['id'];
				$providerId = $provider['id'];
				$timeAccessed = $row[2];

				$values = array($patientId, $providerId, $timeAccessed);
				$types = array('i', 'i', 's');

				$records = $tracker->GetList($where, $values, $types);

				$count = count($records);

				if ($count > 1)
				{
					$this->debug->Show(Debug::WARNING, "WARNING: $count ".
						"RECORDS FOUND FOR: $patient[id], $provider[id]");
				}

				if ($count > 0)
				{
					$access = $records[0];
					$message =
						"chart access found: $patient[id], $provider[id]";
					$this->debug->Show(Debug::DEBUG, $message);
				}
				else
				{
					$id = $tracker->Insert(
						$patientId, $timeAccessed, $providerId, '');
				}
			}
		}
	}

	private function ChartNotesVitals($workSheet, $row, $index)
	{
		$this->debug->Show(Debug::DEBUG, "ChartNotesVitals begin");

		$transcriptDOS = $row[TranscriptDOS];
		$weight = $row[Weight];
		$bp = $row[BP];
		$temp = $row[Temp];
		$height = $row[Height];
		$headCircumference = $row[HeadCircumference];
		$pulse = $row[Pulse];
		$respiratoryRate = $row[RespiratoryRate];
		$chiefComplaint = $row[ChiefComplaint];
		$subjective = $row[Subjective];
		$objective = $row[Objective];
		$assessment = $row[Assessment];
		$plan = $row[Plan];
		$transcriptSignedDate = $row[TranscriptSignedDate];

		if (!empty($transcriptDOS))
		{
			$date =
				\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
				$transcriptDOS);
			$serviceDate = $date->format('Y-m-d');
		}

		$patient = $this->GetPatientByGuid($row);

		if (empty($patient))
		{
			$patientGuid = $row[PatientGUID];
			$this->debug->Show(Debug::WARNING, 'WARNING: '.
				"No patient data for $patientGuid");
		}
		else
		{
			$patientId = $patient['id'];
			$provider = $this->GetProviderByGuid($row);

			if (empty($provider))
			{
				$providerGuid = $row[UserGUID];
				$this->debug->Show(Debug::WARNING, 'WARNING: '.
					"No provider data for $providerGuid");
			}
			else
			{
				$providerId = $provider['id'];

				$formSoap = new form_soap(
					$this->database, $this->debug, $this->lastQuery);

				$where = " WHERE pid = ? AND date = ?";

				$values = array($patientId, $serviceDate);
				$types = array('i', 's');

				$records = $formSoap->GetList($where, $values, $types);

				$count = count($records);

				if ($count > 0)
				{
					$this->debug->Show(Debug::WARNING, "WARNING: $count ".
						"FORM_SOAP RECORDS FOUND FOR: $patientId");
					$record = $records[0];
					$formSoapId = $record['id'];
				}
				else
				{
					$formSoapId = $formSoap->Insert($serviceDate, $patientId,
						$providerId, null, 0, 0, $subjective, $objective,
						$assessment, $plan);
				}

				$formVitals = new form_vitals(
					$this->database, $this->debug, $this->lastQuery);

				$where = " WHERE pid = ? AND date = ?";

				$values = array($patientId, $serviceDate);
				$types = array('i', 's');

				$records = $formVitals->GetList($where, $values, $types);

				$count = count($records);

				if ($count > 0)
				{
					$this->debug->Show(Debug::WARNING, "WARNING: $count ".
						"FORM VITALS RECORDS FOUND FOR: $patientId");
				}
				else
				{
					$formVitals->Insert($serviceDate, $patientId, $providerId,
						null, 0, 0, $bp, null, $weight, $height, $temp, null,
						$pulse, $respiratoryRate, $chiefComplaint, 0.0, null,
						0.00, $headCircumference, 0.00, $formSoapId);
				}
			}
		}
	}

	private function ChartNotesAddenda($workSheet, $row, $index)
	{
		$this->debug->Show(Debug::INFO, "ChartNotesAddenda begin");

		$addendumNote = $row[3];
		$addendumDate = $row[4];

		if (!empty($addendumDate))
		{
			$date =
				\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
				$addendumDate);
			$addendumDate = $date->format('Y-m-d');
		}

		$patient = $this->GetPatientByGuid($row);

		if (!empty($patient))
		{
			$patientId = $patient['id'];
			$provider = $this->GetProviderByGuid($row);

			if (!empty($provider))
			{
				$providerId = $provider['id'];

				$formVitals = new form_vitals(
					$this->database, $this->debug, $this->lastQuery);

				$where = " WHERE pid = ? AND date = ?";

				$values = array($patientId, $addendumDate);
				$types = array('i', 's');

				$records = $formVitals->GetList($where, $values, $types);

				$count = count($records);

				if ($count > 0)
				{
					$record = $records[0];
					$note = $record['note'] .' '.$addendumNote;
					$formVitals->Update($patient['id'], array('note'),
						array($note), array('s'));
				}
				else
				{
					$this->debug->Show(Debug::WARNING, "WARNING: $count ".
						"FORM VITALS RECORDS FOUND FOR: $patientId");
				}
			}
		}
	}

	private function Diagnoses($workSheet, $row, $index)
	{
		$diagnosis = $row[Diagnosis];
		$icd = $row[ICD];
		$isAcute = $row[IsAcute];
		$comments = $row[DiagnosisComments];
		$startDate = $row[DiagnosisStartDate];
		$stopDate = $row[DiagnosisStopDate];

		$this->DiagnosisCore($row, $diagnosis, $icd, $isAcute, $comments,
			$startDate, $stopDate);
	}

	private function ChartNoteDiagnoses($workSheet, $row, $index)
	{
		$diagnosis = $row[ChartNotesDiagnosis];
		$icd = $row[ChartNotesICD];
		$isAcute = $row[ChartNotesIsAcute];
		$diagnosisChartNotesComments = $row[DiagnosisChartNotesComments];
		$diagnosisChartNotesChartNoteComments =
			$row[DiagnosisChartNotesChartNoteComments];
		$startDate = $row[ChartNotesDiagnosisStartDate];
		$stopDate = $row[ChartNotesDiagnosisStopDate];

		$comments = '';

		if (!empty($diagnosisChartNotesComments))
		{
			$comments = $diagnosisChartNotesComments;
		}

		if (!empty($diagnosisChartNotesChartNoteComments))
		{
			if (!empty($comments))
			{
				$comments .= ' ';
			}

			$comments .= $diagnosisChartNotesChartNoteComments;
		}

		$this->DiagnosisCore($row, $diagnosis, $icd, $isAcute, $comments,
			$startDate, $stopDate);
	}

	private function Medications($workSheet, $row, $index)
	{
		$medicationName = $row[MedicationName];
		$medStrength = $row[MedStrength];
		$comments = $row[MedicationComments];
		$medStartDate = $row[MedStartDate];
		$medStopDate = $row[MedStopDate];

		$this->MedicationsCore($row, $medicationName, $medStrength, $comments,
			$medStartDate, $medStopDate);
	}

	private function ChartNoteMedications($workSheet, $row, $index)
	{
		$medicationName = $row[ChartNotesMedicationName];
		$medStrength = $row[ChartNotesMedStrength];
		$chartNotesComments = $row[ChartNotesComments];
		$medicationsChartNoteComments = $row[MedicationsChartNoteComments];
		$medStartDate = $row[ChartNotesMedStartDate];
		$medStopDate = $row[ChartNotesMedStopDate];

		$comments = '';

		if (!empty($chartNoteComments))
		{
			$comments = $chartNoteComments;
		}

		if (!empty($medicationsChartNoteComments))
		{
			if (!empty($comments))
			{
				$comments .= ' ';
			}

			$comments .= $medicationsChartNoteComments;
		}

		$this->MedicationsCore($row, $medicationName, $medStrength, $comments,
			$medStartDate, $medStopDate);
	}

	private function Prescriptions($workSheet, $row, $index)
	{
		$medicationName = $row[MedicationName];
		$medStrength = $row[MedStrength];
		$comments = $row[MedicationComments];
		$medStartDate = $row[MedStartDate];
		$medStopDate = $row[MedStopDate];
		$prescriptionDate = $row[PrescriptionDate];
		$maxDailyDose = $row[MaxDailyDose];
		$quantity = $row[Quantity];
		$refills = $row[Refills];
		$refillAsNeeded = $row[RefillAsNeeded];
		$genericOk = $row[GenericOK];

		$title = "$medicationName $medStrength";

		$date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
			$medStartDate);
		$medStartDate = $date->format('Y-m-d');

		$date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
			$medStopDate);
		$medStopDate = $date->format('Y-m-d');

		$date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
			$prescriptionDate);
		$prescriptionDate = $date->format('Y-m-d');

		$notes = '';

		if ($refillAsNeeded == '1')
		{
			$notes .= "Refill as needed.";
		}

		if ($genericOk == '1')
		{
			if (!empty($notes))
			{
				$notes .= ' ';
			}

			$notes .= "Generic OK.";
		}

		$patient = $this->GetPatientByGuid($row);

		if (!empty($patient))
		{
			$provider = $this->GetProviderByGuid($row);

			if (!empty($provider))
			{
				$patientId = $patient['id'];
				$providerId = $provider['id'];

				$prescriptions = new prescriptions(
					$this->database, $this->debug, $this->lastQuery);

				$where = "WHERE patient_id = ? AND drug LIKE ? AND ".
					"filled_date = ?";

				$values =
					array($patient['id'], $medicationName, $prescriptionDate);
				$types = array('i', 'i', 's');

				$this->debug->Show(Debug::DEBUG, 'Getting list of '.
						"prescriptions for: $patient[id]");

				$immunes = $prescriptions->GetList($where, $values, $types);

				$count = count($immunes);

				$this->debug->Dump(Debug::DEBUG, $immunes);

				if ($count > 0)
				{
					$this->debug->Show(Debug::WARNING, 'WARNING: '.
						"$count immunization RECORDS FOUND FOR: $patient[id]");
				}
				else
				{
					$prescriptions->Insert($patient['id'], null, null, null,
						null, null, null, $medStartDate, $title, 0,
						null, null, $maxDailyDose, $quantity, null, null,
						null, null, null, $refills, null, $prescriptionDate,
						null, $notes, 1, null, null, null, null, 0, 0, '',
						null, $medStopDate, '', null, null, null, '');
				}
			}
		}
	}

	private function Allergies($workSheet, $row, $index)
	{
		$severity = $row[Severity];
		$reaction = $row[Reaction];
		$reactionGroup = $row[ReactionGroup];
		$substance = $row[AllergyMedicationName];
		$allergySubstance = $row[Substance];
		$comments = $row[AllergyComments];
		$startDate = $row[AllergyStartDate];

		if ($substance == 'Penicillins')
		{
			$substance = 'penicillin';
		}

		if (empty($substance))
		{
			if (!empty($comments))
			{
				$substance = $comments;
			}
			else
			{
				$substance = $allergySubstance;
			}
		}

		$patient = $this->GetPatientByGuid($row);

		if (!empty($patient))
		{
			$lists =
				new lists($this->database, $this->debug, $this->lastQuery);

			$where = " WHERE type = 'allergy' AND pid = ? AND title = ?";

			$values = array($patient['id'], $substance);
			$types = array('i', 's');

			$allergies = $lists->GetList($where, $values, $types);

			$count = count($allergies);

			if ($count > 0)
			{
				$this->debug->Show(Debug::WARNING, 'WARNING: '.
					"$count ALLERGY RECORDS FOUND FOR: $patient[id]");
				$allergy = $allergies[0];
			}
			else
			{
				$lists->Insert(null, 'allergy', '', $substance, $startDate,
					null, null, 0, 0, null, null, null, null, $comments,
					$patient['id'], null, $reactionGroup, 0, null, 0, '', '',
					'', '', null, 0, 0, $severity, null);
			}
		}
	}

	private function ChartNoteAllergies($workSheet, $row, $index)
	{
	}

	private function PMH($workSheet, $row, $index)
	{
		$patientGuid = $row[PatientGUID];
		$problem = $row[PMHType];
		$comments = $row[PMHValue];

		$patient = $this->GetPatientByGuid($row);

		if (!empty($patient))
		{
			$lists =
				new lists($this->database, $this->debug, $this->lastQuery);

			$where = " WHERE type = 'medical_problem' AND pid = ? AND title = ?";

			$values = array($patient['id'], $problem);
			$types = array('i', 's');

			$problems = $lists->GetList($where, $values, $types);

			$count = count($problems);

			if ($count > 0)
			{
				$patientId = $patient['id'];
				$this->debug->Show(Debug::WARNING, 'WARNING: PMH - '.
					"$count medical_problem RECORDS FOUND FOR: $patientId");
			}
			else
			{
				$lists->Insert(null, 'medical_problem', '', $problem, null,
					null, null, 0, 0, null, null, null, null, $comments,
					$patient['id'], null, '', 0, null, 0, '', '',
					'', '', null, 0, 0, '', null);
			}
		}
		else
		{
			$this->debug->Show(Debug::WARNING, 'WARNING: PMH - '.
				"NO PATIENT RECORDS FOUND FOR: $patientGuid");
		}
	}

	private function AdvanceDirectives($workSheet, $row, $index)
	{
	}

	private function Immunizations($workSheet, $row, $index)
	{
		$immunization = $row[ImmunizationType];
		$value = $row[ImmunizationDate];
		$comments = $row[ImmunizationComments];

		$date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
			$value);
		$immunizationDate = $date->format('Y-m-d');

		$patient = $this->GetPatientByGuid($row);

		if (!empty($patient))
		{
			$immunizations = new immunizations(
				$this->database, $this->debug, $this->lastQuery);
			$codes = new codes(
				$this->database, $this->debug, $this->lastQuery);

			$keyword = $this->GetImmunizationCodeKeyword($immunization);

			$where = "WHERE code_type = 100 AND code_text LIKE '%$keyword%' ".
				"OR code_text_short LIKE '%$keyword%'";
			$records = $codes->GetList($where);
			$count = count($records);

			if ($count > 1)
			{
				$this->debug->Show(Debug::WARNING, 'WARNING: Immunizations - '.
					"$count cides RECORDS FOUND FOR: $immunization");
			}

			if ($count > 0)
			{
				$code = $records[0];

				$where = " WHERE patient_id = ? AND cvx_code = ? AND ".
					"administered_date = ?";

				$values =
					array($patient['id'], $code['id'], $immunizationDate);
				$types = array('i', 'i', 's');

				$immunes = $immunizations->GetList($where, $values, $types);

				$count = count($immunes);

				if ($count > 0)
				{
					$this->debug->Show(Debug::WARNING, 'WARNING: '.
						"$count immunization RECORDS FOUND FOR: $patient[id]");
				}
				else
				{
					$immunizations->Insert($patient['id'], $immunizationDate,
						null, $code['id'], null, null, null, null, null, null,
						'', null, null, null, null, null, null, null, null, 0,
						null, null, null, null, null);
				}
			}
		}
		else
		{
			$patientGuid = $row[PatientGUID];
			$this->debug->Show(Debug::WARNING, 'WARNING: '.
				"NO PATIENT RECORDS FOUND FOR: $patientGuid");
		}
	}

	private function Appointments($workSheet, $row, $index)
	{
		$patientGuid = $row[PatientGUID];
		$value = $row[ScheduledEventStartDate];
		$value2 = $row[ScheduledEventEndDate];
		$title = $row[ScheduledEventType];
		$result = $row[AppointmentsApptStatus];
		$comments = $row[ScheduledEventComments];

		$startDateTime = new DateTime($value);
		$calendarDate = $startDateTime->format('Y-m-d');
		$startTime = $startDateTime->format('H:i:s');

		$endDateTime = new DateTime($value2);
		$endTime = $endDateTime->format('H:i:s');

		$patient = $this->GetPatientByGuid($row);

		if (!empty($patient))
		{
			$provider = $this->GetProviderByGuid($row);

			if (!empty($provider))
			{
				$calendar = new openemr_postcalendar_events(
					$this->database, $this->debug, $this->lastQuery);

				$where = " WHERE pc_pid = ? AND pc_aid = ? AND ".
					"pc_eventDate = ? AND pc_startTime = ?";

				$patientId = $patient['id'];
				$providerId = $provider['id'];

				$values =
					array($patientId, $providerId, $calendarDate, $startTime);
				$types = array('i', 'i', 's', 's');

				$records = $calendar->GetList($where, $values, $types);

				$count = count($records);

				if ($count > 0)
				{
					$this->debug->Show(Debug::WARNING, 'WARNING: '.
						"$count RECORDS FOUND FOR: $patientId, $providerId");
				}
				else
				{
					$id = $calendar->Insert(0, 0, $providerId, $patientId, 0,
						$title, null, $comments, $result, 0, 1, null,
						$calendarDate, '0000-00-00', 0, 0, '', 0, $startTime,
						$endTime, 0, '', null, null, null, null, null, 0, 0,
						null, '-', 0, 0, 'NO', 'NO', 0, '');
				}
			}
		}
	}

	private function DocumentsXref($workSheet, $row, $index)
	{
		// filename: ea50bbb8-fc29-461b-9695-5308775254fb-2016_02_03_09_06_16_.pdf
		// composed from {DocumentFileName}-{DocumentName[Reformated]}_.{OriginalFileExtension}
		// 2016年02月03日09時06分16秒.pdf
		// 2016_02_03_09_06_16_.pdf

		$documentName = $row[DocumentName];
		$documentFileName = $row[DocumentFileName];
		$documentDate = $row[DocumentDate];
		$documentType = $row[DocumentType];
		$filepath2 = $row[filepath2];
		$originalLocalPath = $row[OriginalLocalPath];
		$originalFileExtension = $row[OriginalFileExtension];
		$comments = $row[DocumentComments];

		$newDocumentName = str_replace('年', '_', $documentName);
		$newDocumentName = str_replace('月', '_', $newDocumentName);
		$newDocumentName = str_replace('日', '_', $newDocumentName);
		$newDocumentName = str_replace('時', '_', $newDocumentName);
		$newDocumentName = str_replace('分', '_', $newDocumentName);
		$newDocumentName = str_replace('秒', '_', $newDocumentName);

		$fullDocumentName = $documentFileName .'-'.$newDocumentName;
		$path = $this->GetExternalDocumentsDirectory();

		$documentPath = $path . $fullDocumentName;

		if (!file_exists($documentPath))
		{
			$this->debug->Show(Debug::WARNING, 'WARNING: '.
				"$documentPath does NOT exist");
		}
		else
		{
			$patient = $this->GetPatientByGuid($row);

			if (empty($patient))
			{
				$patientGuid = $row[PatientGUID];
				$this->debug->Show(Debug::WARNING, 'WARNING: '.
					"No patient date for $patientGuid");
			}
			else
			{
				$nextId = $this->database->NextId('documents', 'id');
				$patientId = $patient['id'];
				$size = filesize($documentPath);

				$destinationPath =
					$this->GetDocumentsDirectory() . $patientId;
				if (false == file_exists($destinationPath))
				{
					mkdir($destinationPath);
				}

				$destination = $destinationPath . '/' . $fullDocumentName;

				copy($documentPath, $destination);

				$documents = new documents(
					$this->database, $this->debug, $this->lastQuery);

				$url = "file://$destination";
				$mimeType = mime_content_type($documentPath);
				$hash = sha1_file($documentPath);

				$documents->Insert($nextId, 'file_url', $size, $documentDate,
					$url, null, $mimeType, null, 1, 1, $documentDate,
					$hash, 0, null, null, 0, 1, 0, 0, 0, 1, null, null);
			}
		}
	}

	private function eRx($workSheet, $row, $index)
	{
	}

	private function DiagnosisCore(
		$row, $diagnosis, $icd, $isAcute, $comments, $startDate, $stopDate)
	{
		$title = "$diagnosis ICD: $icd";

		if (empty($startDate))
		{
			$medStartDate = '';
		}
		else
		{
			$date =
				\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
				$startDate);
			$medStartDate = $date->format('Y-m-d');
		}

		if ($stopDate == '9999-12-30')
		{
			$stopDate = '';
		}

		if (!empty($stopDate))
		{
			$date =
				\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
				$stopDate);
			$medStopDate = $date->format('Y-m-d');
		}

		$patient = $this->GetPatientByGuid($row);

		if (empty($patient))
		{
			$patientGuid = $row[PatientGUID];
			$this->debug->Show(Debug::WARNING, 'WARNING: '.
				"No patient data for $patientGuid");
		}
		else
		{
			$provider = $this->GetProviderByGuid($row);

			if (empty($provider))
			{
				$providerGuid = $row[UserGUID];
				$this->debug->Show(Debug::WARNING, 'WARNING: '.
					"No provider data for $providerGuid");
			}
			else
			{
				$patientId = $patient['id'];
				$providerId = $provider['id'];

				$lists = new lists(
					$this->database, $this->debug, $this->lastQuery);

				$where = " WHERE pid = ? AND user = ? AND diagnosis = ?";

				$values = array($patientId, $providerId, $diagnosis);
				$types = array('i', 's', 's');

				$diagnosises = $lists->GetList($where, $values, $types);

				$count = count($diagnosises);

				if ($count > 0)
				{
					$this->debug->Show(Debug::WARNING, 'WARNING: '.
						"$count DIAGNOSIS RECORDS FOUND FOR: $patientId");
				}
				else
				{
					$lists->Insert(null, 'diagnosis', '', $title, $startDate,
						$stopDate, null, 0, 0, null, null, $diagnosis, null,
						$comments, $patientId, $providerId, '', 0, null, 0,
						'', '', '', '', null, 0, 0, $isAcute, null);
				}
			}
		}
	}

	private function GetImmunizationCodeKeyword($immunization)
	{
		$keyword = $immunization;

		// this gets kinda ugly
		$position = strpos($immunization, 'TDaP');
		if (false !== $position)
		{
			$keyword = 'TDaP';
		}

		$position = strpos($immunization, 'Meningococcal (any group)');
		if (false !== $position)
		{
			$keyword = 'meningococcal, unspecifi';
		}

		$position = strpos($immunization, 'Hep B, adolescent or ped');
		if (false !== $position)
		{
			$keyword = 'meningococcal, unspecifi';
		}

		$position = strpos($immunization, 'HPV, quadrivalent');
		if (false !== $position)
		{
			$keyword = 'meningococcal, unspecifi';
		}

		$position = strpos($immunization, 'Hep A, unspecified formu');
		if (false !== $position)
		{
			$keyword = 'meningococcal, unspecifi';
		}

		return $keyword;
	}

	private function GetDocumentsDirectory()
	{
		$path =
			'/var/www/localhost/htdocs/openemr/sites/default/documents/';
		//$path = "C:\\Users\\JamesMc\\Data\\Clients\\AmericanClinicTokyo".
		//	"\\OpenEmr\\Temp\\Documents\\";

		return $path;
	}

	private function GetExternalDocumentsDirectory()
	{
		$fullPath = realpath($this->excelFile);

		$pathInfo = pathinfo($fullPath);
		$path = $pathInfo['dirname'] . '/Documents/';

		return $path;
	}

	private function GetPatientByGuid($row)
	{
		$patient = null;

		$patients = new patient_data(
			$this->database, $this->debug, $this->lastQuery);

		$where = " WHERE patient_guid = ?";

		$patientGuid = $row[PatientGUID];

		$values = array($patientGuid);
		$types = array('s');

		$records = $patients->GetList($where, $values, $types);

		$count = count($records);

		if ($count > 1)
		{
			$this->debug->Show(Debug::WARNING, 'WARNING: '.
				"$count RECORDS FOUND FOR: : $patientGuid");
		}

		if ($count > 0)
		{
			$patient = $records[0];
		}

		return $patient;
	}

	private function GetPatientByNameOrEmail($row)
	{
		$patient = null;

		$patients = new patient_data(
			$this->database, $this->debug, $this->lastQuery);

		$givenName = $row[FirstName];
		$familyName = $row[LastName];
		$email = strtolower($row[Email]);

		if (!empty($email))
		{
			$where = " WHERE (fname LIKE ? AND lname = ?) OR email = ?";

			$values = array("%$givenName%", $familyName, $email);
			$types = array('s', 's', 's');
		}
		else
		{
			$where = " WHERE fname LIKE ? AND lname = ?";

			$values = array("%$givenName%", $familyName);
			$types = array('s', 's');
		}

		$records = $patients->GetList($where, $values, $types);

		$count = count($records);

		if ($count > 1)
		{
			$this->debug->Show(Debug::WARNING, 'WARNING: '.
				"$count RECORDS FOUND FOR: : $givenName $familyName");
		}

		if ($count > 0)
		{
			$patient = $records[0];
		}

		return $patient;
	}

	private function GetProviderByGuid($row)
	{
		$provider = null;

		$providers =
			new users($this->database, $this->debug, $this->lastQuery);

		$where = " WHERE provider_guid = ?";

		$userGuid = $row[UserGUID];

		$values = array($userGuid);
		$types = array('s');

		$records = $providers->GetList($where, $values, $types);

		$count = count($records);

		if ($count > 1)
		{
			$this->debug->Show(Debug::WARNING, 'WARNING: '.
				"$count RECORDS FOUND FOR PROVIDER: $userGuid");
		}

		if ($count > 0)
		{
			$provider = $records[0];
		}

		return $provider;
	}

	private function MedicationsCore($row, $medicationName, $medStrength,
		$comments, $medStartDate, $medStopDate)
	{
		$title = "$medicationName $medStrength";

		if (!empty($medStartDate))
		{
			$date =
				\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
				$medStartDate);
			$medStartDate = $date->format('Y-m-d');
		}

		if (!empty($medStopDate))
		{
			$date =
				\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
				$medStopDate);
			$medStopDate = $date->format('Y-m-d');
		}

		$patient = $this->GetPatientByGuid($row);

		if (empty($patient))
		{
			$patientGuid = $row[PatientGUID];
			$this->debug->Show(Debug::WARNING, 'WARNING: '.
				"No patient data for $patientGuid");
		}
		else
		{
			$provider = $this->GetProviderByGuid($row);

			if (empty($provider))
			{
				$providerGuid = $row[UserGUID];
				$this->debug->Show(Debug::WARNING, 'WARNING: '.
					"No provider data for $providerGuid");
			}
			else
			{
				$lists = new lists(
					$this->database, $this->debug, $this->lastQuery);

				$where =
					" WHERE type = 'medication' AND pid = ? AND title LIKE ?";

				$values = array($patient['id'], $medicationName);
				$types = array('i', 's');

				$medications = $lists->GetList($where, $values, $types);

				$count = count($medications);

				if ($count > 0)
				{
					$this->debug->Show(Debug::WARNING, 'WARNING: '.
						"$count MEDICATIONS RECORDS FOUND FOR: $patient[id]");
				}
				else
				{
					$lists->Insert(null, 'medication', '', $medicationName,
						$medStartDate, $medStopDate, null, 0, 0, null, null,
						null, null, $comments, $patient['id'],
						$provider['id'], '', 0, null, 0, '', '', '', '', null,
						0, 0, '', null);
				}
			}
		}
	}
}

?>
