<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a prescriptions Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class prescriptions
{
	var	$database;
	var $debug;
	var $lastQuery;

	/////////////////////////////////////////////////////////////////////////
	// constructor
	/////////////////////////////////////////////////////////////////////////
	function __construct($database, $debug, &$lastQuery)
	{
		$this->database	= $database;
		$this->debug = $debug;
		$this->lastQuery = & $lastQuery;
	}

	/////////////////////////////////////////////////////////////////////////
	// Delete
	/////////////////////////////////////////////////////////////////////////
	function Delete($id)
	{
		$this->debug->Show(Debug::DEBUG, "prescriptions::Delete");

		$query = "DELETE FROM prescriptions ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "prescriptions::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = null, $types = null)
	{
		$sql = "SELECT * FROM prescriptions";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$prescriptionss = $this->database->GetAll($sql, $values, $types);

		return $prescriptionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM prescriptions WHERE id = '$id'";

		$prescriptionsRecord = $this->database->GetRow($sql);

		return $prescriptionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($patient_id, $filled_by_id, $pharmacy_id, $date_added,
		$date_modified, $provider_id, $encounter, $start_date, $drug,
		$drug_id, $rxnorm_drugcode, $form, $dosage, $quantity, $size, $unit,
		$route, $interval, $substitute, $refills, $per_refill, $filled_date,
		$medication, $note, $active, $datetime, $user, $site,
		$prescriptionguid, $erx_source, $erx_uploaded, $drug_info_erx,
		$external_id, $end_date, $indication, $prn, $ntx, $rtx, $txDate)
	{
		$this->debug->Show(Debug::DEBUG, "prescriptions::Insert");

		$statement = 'INSERT INTO prescriptions (patient_id, filled_by_id, '.
			'pharmacy_id, date_added, date_modified, provider_id, encounter,'.
			' start_date, drug, drug_id, rxnorm_drugcode, form, dosage, '.
			'quantity, size, unit, route, `interval`, substitute, refills, '.
			'per_refill, filled_date, medication, note, active, datetime, '.
			'user, site, prescriptionguid, erx_source, erx_uploaded, '.
			'drug_info_erx, external_id, end_date, indication, prn, ntx, '.
			'rtx, txDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '.
			'?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'.
			'?, ?, ?, ?)';

		$values = array($patient_id, $filled_by_id, $pharmacy_id, $date_added,
			$date_modified, $provider_id, $encounter, $start_date, $drug,
			$drug_id, $rxnorm_drugcode, $form, $dosage, $quantity, $size,
			$unit, $route, $interval, $substitute, $refills, $per_refill,
			$filled_date, $medication, $note, $active, $datetime, $user,
			$site, $prescriptionguid, $erx_source, $erx_uploaded,
			$drug_info_erx, $external_id, $end_date, $indication, $prn, $ntx,
			$rtx, $txDate);

		$types = array('i', 'i', 'i', 's', 's', 'i', 'i', 's', 's', 'i', 'i',
			'i', 's', 's', 's', 'i', 'i', 'i', 'i', 'i', 'i', 's', 'i', 's',
			'i', 's', 's', 's', 's', 'i', 'i', 's', 's', 's', 's', 's', 'i',
			'i', 's');

		$result	= $this->database->Insert($statement, $values, $types);
		$this->debug->Show(
			Debug::INFO, "prescriptions::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $patient_id, $filled_by_id, $pharmacy_id, $date_added, $date_modified, $provider_id, $encounter, $start_date, $drug, $drug_id, $rxnorm_drugcode, $form, $dosage, $quantity, $size, $unit, $route, $interval, $substitute, $refills, $per_refill, $filled_date, $medication, $note, $active, $datetime, $user, $site, $prescriptionguid, $erx_source, $erx_uploaded, $drug_info_erx, $external_id, $end_date, $indication, $prn, $ntx, $rtx, $txDate)
	{
		$this->debug->Show(Debug::DEBUG, "prescriptions::Update");

		$sql = "UPDATE prescriptions SET ".
				@"patient_id='$patient_id'," + 
				@"filled_by_id='$filled_by_id'," + 
				@"pharmacy_id='$pharmacy_id'," + 
				@"date_added='$date_added'," + 
				@"date_modified='$date_modified'," + 
				@"provider_id='$provider_id'," + 
				@"encounter='$encounter'," + 
				@"start_date='$start_date'," + 
				@"drug='$drug'," + 
				@"drug_id='$drug_id'," + 
				@"rxnorm_drugcode='$rxnorm_drugcode'," + 
				@"form='$form'," + 
				@"dosage='$dosage'," + 
				@"quantity='$quantity'," + 
				@"size='$size'," + 
				@"unit='$unit'," + 
				@"route='$route'," + 
				@"interval='$interval'," + 
				@"substitute='$substitute'," + 
				@"refills='$refills'," + 
				@"per_refill='$per_refill'," + 
				@"filled_date='$filled_date'," + 
				@"medication='$medication'," + 
				@"note='$note'," + 
				@"active='$active'," + 
				@"datetime='$datetime'," + 
				@"user='$user'," + 
				@"site='$site'," + 
				@"prescriptionguid='$prescriptionguid'," + 
				@"erx_source='$erx_source'," + 
				@"erx_uploaded='$erx_uploaded'," + 
				@"drug_info_erx='$drug_info_erx'," + 
				@"external_id='$external_id'," + 
				@"end_date='$end_date'," + 
				@"indication='$indication'," + 
				@"prn='$prn'," + 
				@"ntx='$ntx'," + 
				@"rtx='$rtx'," + 
				@"txDate='$txDate'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "prescriptions::Update return: $result");

		return $result;
	}
}
?>
