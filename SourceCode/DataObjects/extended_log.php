<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a extended_log Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class extended_log
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
		$this->debug->Show(Debug::DEBUG, "extended_log::Delete");

		$query = "DELETE FROM extended_log ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "extended_log::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM extended_log";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$extended_logs = $this->database->GetAll($sql);

		return $extended_logs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM extended_log WHERE id = '$id'";

		$extended_logRecord = $this->database->GetRow($sql);

		return $extended_logRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $event, $user, $recipient, $description, $patient_id)
	{
		$this->debug->Show(Debug::DEBUG, "extended_log::Insert");

		$sql = "INSERT INTO extended_log (date, event, user, recipient, description, patient_id)".
			" VALUES ('$date', '" + "'$event', '" + "'$user', '" + "'$recipient', '" + "'$description', '" + "'$patient_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "extended_log::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $event, $user, $recipient, $description, $patient_id)
	{
		$this->debug->Show(Debug::DEBUG, "extended_log::Update");

		$sql = "UPDATE extended_log SET ".
				@"date='$date'," + 
				@"event='$event'," + 
				@"user='$user'," + 
				@"recipient='$recipient'," + 
				@"description='$description'," + 
				@"patient_id='$patient_id'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "extended_log::Update return: $result");

		return $result;
	}
}
?>
