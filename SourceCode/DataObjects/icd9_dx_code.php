<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a icd9_dx_code Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class icd9_dx_code
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
	function Delete($dx_id)
	{
		$this->debug->Show(Debug::DEBUG, "icd9_dx_code::Delete");

		$query = "DELETE FROM icd9_dx_code ".
			"WHERE dx_id = '$dx_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "icd9_dx_code::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM icd9_dx_code";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$icd9_dx_codes = $this->database->GetAll($sql);

		return $icd9_dx_codes;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($dx_id)
	{
		$sql = "SELECT * FROM icd9_dx_code WHERE dx_id = '$dx_id'";

		$icd9_dx_codeRecord = $this->database->GetRow($sql);

		return $icd9_dx_codeRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($dx_code, $formatted_dx_code, $short_desc, $long_desc, $active, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "icd9_dx_code::Insert");

		$sql = "INSERT INTO icd9_dx_code (dx_code, formatted_dx_code, short_desc, long_desc, active, revision)".
			" VALUES ('$dx_code', '" + "'$formatted_dx_code', '" + "'$short_desc', '" + "'$long_desc', '" + "'$active', '" + "'$revision')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "icd9_dx_code::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($dx_id, $dx_code, $formatted_dx_code, $short_desc, $long_desc, $active, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "icd9_dx_code::Update");

		$sql = "UPDATE icd9_dx_code SET ".
				@"dx_code='$dx_code'," + 
				@"formatted_dx_code='$formatted_dx_code'," + 
				@"short_desc='$short_desc'," + 
				@"long_desc='$long_desc'," + 
				@"active='$active'," + 
				@"revision='$revision'" + 
				
				"WHERE dx_id = '$dx_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "icd9_dx_code::Update return: $result");

		return $result;
	}
}
?>
