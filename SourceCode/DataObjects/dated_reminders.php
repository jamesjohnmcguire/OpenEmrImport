<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a dated_reminders Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class dated_reminders
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
	function Delete($dr_id)
	{
		$this->debug->Show(Debug::DEBUG, "dated_reminders::Delete");

		$query = "DELETE FROM dated_reminders ".
			"WHERE dr_id = '$dr_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "dated_reminders::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM dated_reminders";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$dated_reminderss = $this->database->GetAll($sql);

		return $dated_reminderss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($dr_id)
	{
		$sql = "SELECT * FROM dated_reminders WHERE dr_id = '$dr_id'";

		$dated_remindersRecord = $this->database->GetRow($sql);

		return $dated_remindersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($dr_from_ID, $dr_message_text, $dr_message_sent_date, $dr_message_due_date, $pid, $message_priority, $message_processed, $processed_date, $dr_processed_by)
	{
		$this->debug->Show(Debug::DEBUG, "dated_reminders::Insert");

		$sql = "INSERT INTO dated_reminders (dr_from_ID, dr_message_text, dr_message_sent_date, dr_message_due_date, pid, message_priority, message_processed, processed_date, dr_processed_by)".
			" VALUES ('$dr_from_ID', '" + "'$dr_message_text', '" + "'$dr_message_sent_date', '" + "'$dr_message_due_date', '" + "'$pid', '" + "'$message_priority', '" + "'$message_processed', '" + "'$processed_date', '" + "'$dr_processed_by')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "dated_reminders::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($dr_id, $dr_from_ID, $dr_message_text, $dr_message_sent_date, $dr_message_due_date, $pid, $message_priority, $message_processed, $processed_date, $dr_processed_by)
	{
		$this->debug->Show(Debug::DEBUG, "dated_reminders::Update");

		$sql = "UPDATE dated_reminders SET ".
				@"dr_from_ID='$dr_from_ID'," + 
				@"dr_message_text='$dr_message_text'," + 
				@"dr_message_sent_date='$dr_message_sent_date'," + 
				@"dr_message_due_date='$dr_message_due_date'," + 
				@"pid='$pid'," + 
				@"message_priority='$message_priority'," + 
				@"message_processed='$message_processed'," + 
				@"processed_date='$processed_date'," + 
				@"dr_processed_by='$dr_processed_by'" + 
				
				"WHERE dr_id = '$dr_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "dated_reminders::Update return: $result");

		return $result;
	}
}
?>
