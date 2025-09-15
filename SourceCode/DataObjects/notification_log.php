<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a notification_log Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class notification_log
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
	function Delete($iLogId)
	{
		$this->debug->Show(Debug::DEBUG, "notification_log::Delete");

		$query = "DELETE FROM notification_log ".
			"WHERE iLogId = '$iLogId'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "notification_log::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM notification_log";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$notification_logs = $this->database->GetAll($sql);

		return $notification_logs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($iLogId)
	{
		$sql = "SELECT * FROM notification_log WHERE iLogId = '$iLogId'";

		$notification_logRecord = $this->database->GetRow($sql);

		return $notification_logRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $pc_eid, $sms_gateway_type, $smsgateway_info, $message, $email_sender, $email_subject, $type, $patient_info, $pc_eventDate, $pc_endDate, $pc_startTime, $pc_endTime, $dSentDateTime)
	{
		$this->debug->Show(Debug::DEBUG, "notification_log::Insert");

		$sql = "INSERT INTO notification_log (pid, pc_eid, sms_gateway_type, smsgateway_info, message, email_sender, email_subject, type, patient_info, pc_eventDate, pc_endDate, pc_startTime, pc_endTime, dSentDateTime)".
			" VALUES ('$pid', '" + "'$pc_eid', '" + "'$sms_gateway_type', '" + "'$smsgateway_info', '" + "'$message', '" + "'$email_sender', '" + "'$email_subject', '" + "'$type', '" + "'$patient_info', '" + "'$pc_eventDate', '" + "'$pc_endDate', '" + "'$pc_startTime', '" + "'$pc_endTime', '" + "'$dSentDateTime')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "notification_log::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($iLogId, $pid, $pc_eid, $sms_gateway_type, $smsgateway_info, $message, $email_sender, $email_subject, $type, $patient_info, $pc_eventDate, $pc_endDate, $pc_startTime, $pc_endTime, $dSentDateTime)
	{
		$this->debug->Show(Debug::DEBUG, "notification_log::Update");

		$sql = "UPDATE notification_log SET ".
				@"pid='$pid'," + 
				@"pc_eid='$pc_eid'," + 
				@"sms_gateway_type='$sms_gateway_type'," + 
				@"smsgateway_info='$smsgateway_info'," + 
				@"message='$message'," + 
				@"email_sender='$email_sender'," + 
				@"email_subject='$email_subject'," + 
				@"type='$type'," + 
				@"patient_info='$patient_info'," + 
				@"pc_eventDate='$pc_eventDate'," + 
				@"pc_endDate='$pc_endDate'," + 
				@"pc_startTime='$pc_startTime'," + 
				@"pc_endTime='$pc_endTime'," + 
				@"dSentDateTime='$dSentDateTime'" + 
				
				"WHERE iLogId = '$iLogId'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "notification_log::Update return: $result");

		return $result;
	}
}
?>
