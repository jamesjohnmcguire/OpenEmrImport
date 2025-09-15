<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a icd10_reimbr_pcs_9_10 Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class icd10_reimbr_pcs_9_10
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
	function Delete($map_id)
	{
		$this->debug->Show(Debug::DEBUG, "icd10_reimbr_pcs_9_10::Delete");

		$query = "DELETE FROM icd10_reimbr_pcs_9_10 ".
			"WHERE map_id = '$map_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "icd10_reimbr_pcs_9_10::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM icd10_reimbr_pcs_9_10";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$icd10_reimbr_pcs_9_10s = $this->database->GetAll($sql);

		return $icd10_reimbr_pcs_9_10s;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($map_id)
	{
		$sql = "SELECT * FROM icd10_reimbr_pcs_9_10 WHERE map_id = '$map_id'";

		$icd10_reimbr_pcs_9_10Record = $this->database->GetRow($sql);

		return $icd10_reimbr_pcs_9_10Record;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($code, $code_cnt, $ICD9_01, $ICD9_02, $ICD9_03, $ICD9_04, $ICD9_05, $ICD9_06, $active, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "icd10_reimbr_pcs_9_10::Insert");

		$sql = "INSERT INTO icd10_reimbr_pcs_9_10 (code, code_cnt, ICD9_01, ICD9_02, ICD9_03, ICD9_04, ICD9_05, ICD9_06, active, revision)".
			" VALUES ('$code', '" + "'$code_cnt', '" + "'$ICD9_01', '" + "'$ICD9_02', '" + "'$ICD9_03', '" + "'$ICD9_04', '" + "'$ICD9_05', '" + "'$ICD9_06', '" + "'$active', '" + "'$revision')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "icd10_reimbr_pcs_9_10::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($map_id, $code, $code_cnt, $ICD9_01, $ICD9_02, $ICD9_03, $ICD9_04, $ICD9_05, $ICD9_06, $active, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "icd10_reimbr_pcs_9_10::Update");

		$sql = "UPDATE icd10_reimbr_pcs_9_10 SET ".
				@"code='$code'," + 
				@"code_cnt='$code_cnt'," + 
				@"ICD9_01='$ICD9_01'," + 
				@"ICD9_02='$ICD9_02'," + 
				@"ICD9_03='$ICD9_03'," + 
				@"ICD9_04='$ICD9_04'," + 
				@"ICD9_05='$ICD9_05'," + 
				@"ICD9_06='$ICD9_06'," + 
				@"active='$active'," + 
				@"revision='$revision'" + 
				
				"WHERE map_id = '$map_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "icd10_reimbr_pcs_9_10::Update return: $result");

		return $result;
	}
}
?>
