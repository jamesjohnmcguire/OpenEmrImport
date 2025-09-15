<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a icd10_pcs_order_code Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class icd10_pcs_order_code
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
	function Delete($pcs_id)
	{
		$this->debug->Show(Debug::DEBUG, "icd10_pcs_order_code::Delete");

		$query = "DELETE FROM icd10_pcs_order_code ".
			"WHERE pcs_id = '$pcs_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "icd10_pcs_order_code::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM icd10_pcs_order_code";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$icd10_pcs_order_codes = $this->database->GetAll($sql);

		return $icd10_pcs_order_codes;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pcs_id)
	{
		$sql = "SELECT * FROM icd10_pcs_order_code WHERE pcs_id = '$pcs_id'";

		$icd10_pcs_order_codeRecord = $this->database->GetRow($sql);

		return $icd10_pcs_order_codeRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pcs_code, $valid_for_coding, $short_desc, $long_desc, $active, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "icd10_pcs_order_code::Insert");

		$sql = "INSERT INTO icd10_pcs_order_code (pcs_code, valid_for_coding, short_desc, long_desc, active, revision)".
			" VALUES ('$pcs_code', '" + "'$valid_for_coding', '" + "'$short_desc', '" + "'$long_desc', '" + "'$active', '" + "'$revision')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "icd10_pcs_order_code::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pcs_id, $pcs_code, $valid_for_coding, $short_desc, $long_desc, $active, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "icd10_pcs_order_code::Update");

		$sql = "UPDATE icd10_pcs_order_code SET ".
				@"pcs_code='$pcs_code'," + 
				@"valid_for_coding='$valid_for_coding'," + 
				@"short_desc='$short_desc'," + 
				@"long_desc='$long_desc'," + 
				@"active='$active'," + 
				@"revision='$revision'" + 
				
				"WHERE pcs_id = '$pcs_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "icd10_pcs_order_code::Update return: $result");

		return $result;
	}
}
?>
