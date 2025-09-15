<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a automatic_notification Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class automatic_notification
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
	function Delete($notification_id)
	{
		$this->debug->Show(Debug::DEBUG, "automatic_notification::Delete");

		$query = "DELETE FROM automatic_notification ".
			"WHERE notification_id = '$notification_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "automatic_notification::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM automatic_notification";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$automatic_notifications = $this->database->GetAll($sql);

		return $automatic_notifications;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($notification_id)
	{
		$sql = "SELECT * FROM automatic_notification WHERE notification_id = '$notification_id'";

		$automatic_notificationRecord = $this->database->GetRow($sql);

		return $automatic_notificationRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($sms_gateway_type, $next_app_date, $next_app_time, $provider_name, $message, $email_sender, $email_subject, $type, $notification_sent_date)
	{
		$this->debug->Show(Debug::DEBUG, "automatic_notification::Insert");

		$sql = "INSERT INTO automatic_notification (sms_gateway_type, next_app_date, next_app_time, provider_name, message, email_sender, email_subject, type, notification_sent_date)".
			" VALUES ('$sms_gateway_type', '" + "'$next_app_date', '" + "'$next_app_time', '" + "'$provider_name', '" + "'$message', '" + "'$email_sender', '" + "'$email_subject', '" + "'$type', '" + "'$notification_sent_date')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "automatic_notification::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($notification_id, $sms_gateway_type, $next_app_date, $next_app_time, $provider_name, $message, $email_sender, $email_subject, $type, $notification_sent_date)
	{
		$this->debug->Show(Debug::DEBUG, "automatic_notification::Update");

		$sql = "UPDATE automatic_notification SET ".
				@"sms_gateway_type='$sms_gateway_type'," + 
				@"next_app_date='$next_app_date'," + 
				@"next_app_time='$next_app_time'," + 
				@"provider_name='$provider_name'," + 
				@"message='$message'," + 
				@"email_sender='$email_sender'," + 
				@"email_subject='$email_subject'," + 
				@"type='$type'," + 
				@"notification_sent_date='$notification_sent_date'" + 
				
				"WHERE notification_id = '$notification_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "automatic_notification::Update return: $result");

		return $result;
	}
}
?>
