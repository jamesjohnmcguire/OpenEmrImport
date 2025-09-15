<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a patient_reminders Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class patient_reminders
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
		$this->debug->Show(Debug::DEBUG, "patient_reminders::Delete");

		$query = "DELETE FROM patient_reminders ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "patient_reminders::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM patient_reminders";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$patient_reminderss = $this->database->GetAll($sql);

		return $patient_reminderss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM patient_reminders WHERE id = '$id'";

		$patient_remindersRecord = $this->database->GetRow($sql);

		return $patient_remindersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($active, $date_inactivated, $reason_inactivated, $due_status, $pid, $category, $item, $date_created, $date_sent, $voice_status, $sms_status, $email_status, $mail_status)
	{
		$this->debug->Show(Debug::DEBUG, "patient_reminders::Insert");

		$sql = "INSERT INTO patient_reminders (active, date_inactivated, reason_inactivated, due_status, pid, category, item, date_created, date_sent, voice_status, sms_status, email_status, mail_status)".
			" VALUES ('$active', '" + "'$date_inactivated', '" + "'$reason_inactivated', '" + "'$due_status', '" + "'$pid', '" + "'$category', '" + "'$item', '" + "'$date_created', '" + "'$date_sent', '" + "'$voice_status', '" + "'$sms_status', '" + "'$email_status', '" + "'$mail_status')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "patient_reminders::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $active, $date_inactivated, $reason_inactivated, $due_status, $pid, $category, $item, $date_created, $date_sent, $voice_status, $sms_status, $email_status, $mail_status)
	{
		$this->debug->Show(Debug::DEBUG, "patient_reminders::Update");

		$sql = "UPDATE patient_reminders SET ".
				@"active='$active'," + 
				@"date_inactivated='$date_inactivated'," + 
				@"reason_inactivated='$reason_inactivated'," + 
				@"due_status='$due_status'," + 
				@"pid='$pid'," + 
				@"category='$category'," + 
				@"item='$item'," + 
				@"date_created='$date_created'," + 
				@"date_sent='$date_sent'," + 
				@"voice_status='$voice_status'," + 
				@"sms_status='$sms_status'," + 
				@"email_status='$email_status'," + 
				@"mail_status='$mail_status'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "patient_reminders::Update return: $result");

		return $result;
	}
}
?>
