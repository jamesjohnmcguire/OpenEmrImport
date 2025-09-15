<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a icd9_sg_code Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class icd9_sg_code
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
	function Delete($sg_id)
	{
		$this->debug->Show(Debug::DEBUG, "icd9_sg_code::Delete");

		$query = "DELETE FROM icd9_sg_code ".
			"WHERE sg_id = '$sg_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "icd9_sg_code::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM icd9_sg_code";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$icd9_sg_codes = $this->database->GetAll($sql);

		return $icd9_sg_codes;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($sg_id)
	{
		$sql = "SELECT * FROM icd9_sg_code WHERE sg_id = '$sg_id'";

		$icd9_sg_codeRecord = $this->database->GetRow($sql);

		return $icd9_sg_codeRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($sg_code, $formatted_sg_code, $short_desc, $long_desc, $active, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "icd9_sg_code::Insert");

		$sql = "INSERT INTO icd9_sg_code (sg_code, formatted_sg_code, short_desc, long_desc, active, revision)".
			" VALUES ('$sg_code', '" + "'$formatted_sg_code', '" + "'$short_desc', '" + "'$long_desc', '" + "'$active', '" + "'$revision')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "icd9_sg_code::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($sg_id, $sg_code, $formatted_sg_code, $short_desc, $long_desc, $active, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "icd9_sg_code::Update");

		$sql = "UPDATE icd9_sg_code SET ".
				@"sg_code='$sg_code'," + 
				@"formatted_sg_code='$formatted_sg_code'," + 
				@"short_desc='$short_desc'," + 
				@"long_desc='$long_desc'," + 
				@"active='$active'," + 
				@"revision='$revision'" + 
				
				"WHERE sg_id = '$sg_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "icd9_sg_code::Update return: $result");

		return $result;
	}
}
?>
