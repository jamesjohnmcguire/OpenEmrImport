<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a direct_message_log Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class direct_message_log
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
		$this->debug->Show(Debug::DEBUG, "direct_message_log::Delete");

		$query = "DELETE FROM direct_message_log ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "direct_message_log::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM direct_message_log";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$direct_message_logs = $this->database->GetAll($sql);

		return $direct_message_logs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM direct_message_log WHERE id = '$id'";

		$direct_message_logRecord = $this->database->GetRow($sql);

		return $direct_message_logRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($msg_type, $msg_id, $sender, $recipient, $create_ts, $status, $status_info, $status_ts, $patient_id, $user_id)
	{
		$this->debug->Show(Debug::DEBUG, "direct_message_log::Insert");

		$sql = "INSERT INTO direct_message_log (msg_type, msg_id, sender, recipient, create_ts, status, status_info, status_ts, patient_id, user_id)".
			" VALUES ('$msg_type', '" + "'$msg_id', '" + "'$sender', '" + "'$recipient', '" + "'$create_ts', '" + "'$status', '" + "'$status_info', '" + "'$status_ts', '" + "'$patient_id', '" + "'$user_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "direct_message_log::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $msg_type, $msg_id, $sender, $recipient, $create_ts, $status, $status_info, $status_ts, $patient_id, $user_id)
	{
		$this->debug->Show(Debug::DEBUG, "direct_message_log::Update");

		$sql = "UPDATE direct_message_log SET ".
				@"msg_type='$msg_type'," + 
				@"msg_id='$msg_id'," + 
				@"sender='$sender'," + 
				@"recipient='$recipient'," + 
				@"create_ts='$create_ts'," + 
				@"status='$status'," + 
				@"status_info='$status_info'," + 
				@"status_ts='$status_ts'," + 
				@"patient_id='$patient_id'," + 
				@"user_id='$user_id'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "direct_message_log::Update return: $result");

		return $result;
	}
}
?>
