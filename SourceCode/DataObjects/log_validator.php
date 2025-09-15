<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a log_validator Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class log_validator
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
	function Delete($log_id)
	{
		$this->debug->Show(Debug::DEBUG, "log_validator::Delete");

		$query = "DELETE FROM log_validator ".
			"WHERE log_id = '$log_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "log_validator::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM log_validator";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$log_validators = $this->database->GetAll($sql);

		return $log_validators;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($log_id)
	{
		$sql = "SELECT * FROM log_validator WHERE log_id = '$log_id'";

		$log_validatorRecord = $this->database->GetRow($sql);

		return $log_validatorRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($log_checksum)
	{
		$this->debug->Show(Debug::DEBUG, "log_validator::Insert");

		$sql = "INSERT INTO log_validator (log_checksum)".
			" VALUES ('$log_checksum')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "log_validator::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($log_id, $log_checksum)
	{
		$this->debug->Show(Debug::DEBUG, "log_validator::Update");

		$sql = "UPDATE log_validator SET ".
				@"log_checksum='$log_checksum'" + 
				
				"WHERE log_id = '$log_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "log_validator::Update return: $result");

		return $result;
	}
}
?>
