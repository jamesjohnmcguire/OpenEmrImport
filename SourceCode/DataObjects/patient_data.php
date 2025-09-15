<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a patient_data Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class patient_data
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
		$this->debug->Show(Debug::DEBUG, "patient_data::Delete");

		$query = "DELETE FROM patient_data ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG,
			"patient_data::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = null, $types = null)
	{
		$sql = "SELECT * FROM patient_data";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$patient_datas = $this->database->GetAll($sql, $values, $types);

		return $patient_datas;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM patient_data WHERE id = '$id'";

		$patient_dataRecord = $this->database->GetRow($sql);

		return $patient_dataRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($title, $language, $financial, $fname, $lname, $mname,
		$DOB, $street, $postal_code, $city, $state, $country_code,
		$drivers_license, $ss, $occupation, $phone_home, $phone_biz,
		$phone_contact, $phone_cell, $pharmacy_id, $status,
		$contact_relationship, $date, $sex, $referrer, $referrerID,
		$providerID, $ref_providerID, $email, $email_direct, $ethnoracial,
		$race, $ethnicity, $religion, $interpretter, $migrantseasonal,
		$family_size, $monthly_income, $billing_note, $homeless,
		$financial_review, $pubpid, $pid, $genericname1, $genericval1,
		$genericname2, $genericval2, $hipaa_mail, $hipaa_voice, $hipaa_notice,
		$hipaa_message, $hipaa_allowsms, $hipaa_allowemail, $squad, $fitness,
		$referral_source, $usertext1, $usertext2, $usertext3, $usertext4,
		$usertext5, $usertext6, $usertext7, $usertext8, $userlist1,
		$userlist2, $userlist3, $userlist4, $userlist5, $userlist6,
		$userlist7, $pricelevel, $regdate, $contrastart, $completed_ad,
		$ad_reviewed, $vfc, $mothersname, $guardiansname, $allow_imm_reg_use,
		$allow_imm_info_share, $allow_health_info_ex, $allow_patient_portal,
		$deceased_date, $deceased_reason, $soap_import_status,
		$cmsportal_login, $care_team, $county, $industry, $imm_reg_status,
		$imm_reg_stat_effdate, $publicity_code, $publ_code_eff_date,
		$protect_indicator, $prot_indi_effdate, $guardianrelationship,
		$guardiansex, $guardianaddress, $guardiancity, $guardianstate,
		$guardianpostalcode, $guardiancountry, $guardianphone,
		$guardianworkphone, $guardianemail, $patient_guid)
	{
		$this->debug->Show(Debug::INFO, "patient_data::Insert begin");

		$nextId	= $this->database->NextId('patient_data', 'id');

		$sql = 'INSERT INTO patient_data (title, language, financial, fname,'.
			' lname, mname, DOB, street, postal_code, city, state, '.
			'country_code, drivers_license, ss, occupation, phone_home, '.
			'phone_biz, phone_contact, phone_cell, pharmacy_id, status, '.
			'contact_relationship, date, sex, referrer, referrerID, '.
			'providerID, ref_providerID, email, email_direct, ethnoracial, '.
			'race, ethnicity, religion, interpretter, migrantseasonal, '.
			'family_size, monthly_income, billing_note, homeless, '.
			'financial_review, pubpid, pid, genericname1, genericval1, '.
			'genericname2, genericval2, hipaa_mail, hipaa_voice, '.
			'hipaa_notice, hipaa_message, hipaa_allowsms, hipaa_allowemail, '.
			'squad, fitness, referral_source, usertext1, usertext2, '.
			'usertext3, usertext4, usertext5, usertext6, usertext7, '.
			'usertext8, userlist1, userlist2, userlist3, userlist4, '.
			'userlist5, userlist6, userlist7, pricelevel, regdate, '.
			'contrastart, completed_ad, ad_reviewed, vfc, mothersname, '.
			'guardiansname, allow_imm_reg_use, allow_imm_info_share, '.
			'allow_health_info_ex, allow_patient_portal, deceased_date, '.
			'deceased_reason, soap_import_status, cmsportal_login, '.
			'care_team, county, industry, imm_reg_status, '.
			'imm_reg_stat_effdate, publicity_code, publ_code_eff_date, '.
			'protect_indicator, prot_indi_effdate, guardianrelationship, '.
			'guardiansex, guardianaddress, guardiancity, guardianstate, '.
			'guardianpostalcode, guardiancountry, guardianphone, '.
			'guardianworkphone, guardianemail, patient_guid) VALUES '.
			'(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'.
			' ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'.
			' ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'.
			' ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'.
			' ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'.
			' ?, ?)';

		$values = array($title, $language, $financial, $fname, $lname, $mname,
			$DOB, $street, $postal_code, $city, $state, $country_code,
			$drivers_license, $ss, $occupation, $phone_home, $phone_biz,
			$phone_contact, $phone_cell, $pharmacy_id, $status,
			$contact_relationship, $date, $sex, $referrer, $referrerID,
			$providerID, $ref_providerID, $email, $email_direct, $ethnoracial,
			$race, $ethnicity, $religion, $interpretter, $migrantseasonal,
			$family_size, $monthly_income, $billing_note, $homeless,
			$financial_review, $pubpid, $nextId, $genericname1, $genericval1,
			$genericname2, $genericval2, $hipaa_mail, $hipaa_voice,
			$hipaa_notice, $hipaa_message, $hipaa_allowsms, $hipaa_allowemail,
			$squad, $fitness, $referral_source, $usertext1, $usertext2,
			$usertext3, $usertext4, $usertext5, $usertext6, $usertext7,
			$usertext8, $userlist1, $userlist2, $userlist3, $userlist4,
			$userlist5, $userlist6, $userlist7, $pricelevel, $regdate,
			$contrastart, $completed_ad, $ad_reviewed, $vfc, $mothersname,
			$guardiansname, $allow_imm_reg_use, $allow_imm_info_share,
			$allow_health_info_ex, $allow_patient_portal, $deceased_date,
			$deceased_reason, $soap_import_status, $cmsportal_login,
			$care_team, $county, $industry, $imm_reg_status,
			$imm_reg_stat_effdate, $publicity_code, $publ_code_eff_date,
			$protect_indicator, $prot_indi_effdate, $guardianrelationship,
			$guardiansex, $guardianaddress, $guardiancity, $guardianstate,
			$guardianpostalcode, $guardiancountry, $guardianphone,
			$guardianworkphone, $guardianemail, $patient_guid);

		$types = array('s', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's',
			's', 's', 's', 's', 's', 's', 's', 's', 'i', 's', 's', 's', 's',
			's', 's', 'i', 'i', 's', 's', 's', 's', 's', 's', 's', 's', 's',
			's', 's', 's', 's', 's', 'i', 's', 's', 's', 's', 's', 's', 's',
			's', 's', 's', 's', 'i', 's', 's', 's', 's', 's', 's', 's', 's',
			's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's',
			's', 's', 's', 's', 's', 's', 's', 's', 's', 'i', 's', 'i', 's',
			's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's',
			's', 's', 's', 's', 's');
		$result	= $this->database->Insert($sql, $values, $types);
		$this->debug->Show(Debug::INFO,
			"patient_data::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $fields, $values, $types)
	{
		$this->debug->Show(Debug::INFO, "patient_data::Update");

		$columns = '';
		$begin = true;
		foreach($fields as $field)
		{
			if (false == $begin)
			{
				$columns .= ', ';
				$begin = false;
			}

			$columns .= "`$field` = ?";
		}

		$sql = "UPDATE patient_data SET $columns WHERE id = $id";

		$result = $this->database->Update($sql, $values, $types);
		$this->debug->Show(
			Debug::INFO, "patient_data::Update return: $result");

		return $result;
	}
}
?>
