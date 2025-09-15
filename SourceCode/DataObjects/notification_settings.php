<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a notification_settings Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class notification_settings
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
	function Delete($SettingsId)
	{
		$this->debug->Show(Debug::DEBUG, "notification_settings::Delete");

		$query = "DELETE FROM notification_settings ".
			"WHERE SettingsId = '$SettingsId'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "notification_settings::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM notification_settings";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$notification_settingss = $this->database->GetAll($sql);

		return $notification_settingss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($SettingsId)
	{
		$sql = "SELECT * FROM notification_settings WHERE SettingsId = '$SettingsId'";

		$notification_settingsRecord = $this->database->GetRow($sql);

		return $notification_settingsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert(
		$Send_SMS_Before_Hours,
		$Send_Email_Before_Hours,
		$SMS_gateway_username,
		$SMS_gateway_password,
		$SMS_gateway_apikey,
		$type)
	{
		$this->debug->Show(Debug::DEBUG, "notification_settings::Insert");

		$sql = "INSERT INTO notification_settings (Send_SMS_Before_Hours, Send_Email_Before_Hours, SMS_gateway_username, SMS_gateway_password, SMS_gateway_apikey, type)".
			" VALUES ('$Send_SMS_Before_Hours', '" + "'$Send_Email_Before_Hours', '" + "'$SMS_gateway_username', '" + "'$SMS_gateway_password', '" + "'$SMS_gateway_apikey', '" + "'$type')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "notification_settings::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($SettingsId, $Send_SMS_Before_Hours, $Send_Email_Before_Hours, $SMS_gateway_username, $SMS_gateway_password, $SMS_gateway_apikey, $type)
	{
		$this->debug->Show(Debug::DEBUG, "notification_settings::Update");

		$sql = "UPDATE notification_settings SET ".
				@"Send_SMS_Before_Hours='$Send_SMS_Before_Hours'," + 
				@"Send_Email_Before_Hours='$Send_Email_Before_Hours'," + 
				@"SMS_gateway_username='$SMS_gateway_username'," + 
				@"SMS_gateway_password='$SMS_gateway_password'," + 
				@"SMS_gateway_apikey='$SMS_gateway_apikey'," + 
				@"type='$type'" + 
				
				"WHERE SettingsId = '$SettingsId'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "notification_settings::Update return: $result");

		return $result;
	}
}
?>
