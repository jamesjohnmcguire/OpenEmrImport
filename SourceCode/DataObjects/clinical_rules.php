<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a clinical_rules Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class clinical_rules
{
	var	$database;
	var $debug;

	/////////////////////////////////////////////////////////////////////////
	// constructor
	/////////////////////////////////////////////////////////////////////////
	function __construct($database, $debug)
	{
		$this->database	= $database;
		$this->debug = $debug;
	}

	/////////////////////////////////////////////////////////////////////////
	// Delete
	/////////////////////////////////////////////////////////////////////////
	function Delete($id)
	{
		$this->debug->Show(Debug::DEBUG, "clinical_rules::Delete");

		$query = "DELETE FROM clinical_rules ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "clinical_rules::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM clinical_rules";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$clinical_ruless = $this->database->GetAll($sql);

		return $clinical_ruless;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM clinical_rules WHERE id = '$id'";

		$clinical_rulesRecord = $this->database->GetRow($sql);

		return $clinical_rulesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $active_alert_flag, $passive_alert_flag, $cqm_flag, $cqm_2011_flag, $cqm_2014_flag, $cqm_nqf_code, $cqm_pqri_code, $amc_flag, $amc_2011_flag, $amc_2014_flag, $amc_code, $amc_code_2014, $amc_2014_stage1_flag, $amc_2014_stage2_flag, $patient_reminder_flag, $developer, $funding_source, $release_version, $web_reference, $access_control)
	{
		$this->debug->Show(Debug::DEBUG, "clinical_rules::Insert");

		$sql = "INSERT INTO clinical_rules (pid, active_alert_flag, passive_alert_flag, cqm_flag, cqm_2011_flag, cqm_2014_flag, cqm_nqf_code, cqm_pqri_code, amc_flag, amc_2011_flag, amc_2014_flag, amc_code, amc_code_2014, amc_2014_stage1_flag, amc_2014_stage2_flag, patient_reminder_flag, developer, funding_source, release_version, web_reference, access_control)".
			" VALUES ('$pid', '" + "'$active_alert_flag', '" + "'$passive_alert_flag', '" + "'$cqm_flag', '" + "'$cqm_2011_flag', '" + "'$cqm_2014_flag', '" + "'$cqm_nqf_code', '" + "'$cqm_pqri_code', '" + "'$amc_flag', '" + "'$amc_2011_flag', '" + "'$amc_2014_flag', '" + "'$amc_code', '" + "'$amc_code_2014', '" + "'$amc_2014_stage1_flag', '" + "'$amc_2014_stage2_flag', '" + "'$patient_reminder_flag', '" + "'$developer', '" + "'$funding_source', '" + "'$release_version', '" + "'$web_reference', '" + "'$access_control')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "clinical_rules::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $pid, $active_alert_flag, $passive_alert_flag, $cqm_flag, $cqm_2011_flag, $cqm_2014_flag, $cqm_nqf_code, $cqm_pqri_code, $amc_flag, $amc_2011_flag, $amc_2014_flag, $amc_code, $amc_code_2014, $amc_2014_stage1_flag, $amc_2014_stage2_flag, $patient_reminder_flag, $developer, $funding_source, $release_version, $web_reference, $access_control)
	{
		$this->debug->Show(Debug::DEBUG, "clinical_rules::Update");

		$sql = "UPDATE clinical_rules SET ".
				@"pid='$pid'," + 
				@"active_alert_flag='$active_alert_flag'," + 
				@"passive_alert_flag='$passive_alert_flag'," + 
				@"cqm_flag='$cqm_flag'," + 
				@"cqm_2011_flag='$cqm_2011_flag'," + 
				@"cqm_2014_flag='$cqm_2014_flag'," + 
				@"cqm_nqf_code='$cqm_nqf_code'," + 
				@"cqm_pqri_code='$cqm_pqri_code'," + 
				@"amc_flag='$amc_flag'," + 
				@"amc_2011_flag='$amc_2011_flag'," + 
				@"amc_2014_flag='$amc_2014_flag'," + 
				@"amc_code='$amc_code'," + 
				@"amc_code_2014='$amc_code_2014'," + 
				@"amc_2014_stage1_flag='$amc_2014_stage1_flag'," + 
				@"amc_2014_stage2_flag='$amc_2014_stage2_flag'," + 
				@"patient_reminder_flag='$patient_reminder_flag'," + 
				@"developer='$developer'," + 
				@"funding_source='$funding_source'," + 
				@"release_version='$release_version'," + 
				@"web_reference='$web_reference'," + 
				@"access_control='$access_control'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "clinical_rules::Update return: $result");

		return $result;
	}
}
?>
