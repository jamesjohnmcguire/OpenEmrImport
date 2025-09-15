<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a user_settings Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class user_settings
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
	function Delete($setting_user)
	{
		$this->debug->Show(Debug::DEBUG, "user_settings::Delete");

		$query = "DELETE FROM user_settings ".
			"WHERE setting_user = '$setting_user'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "user_settings::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM user_settings";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$user_settingss = $this->database->GetAll($sql);

		return $user_settingss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($setting_user)
	{
		$sql = "SELECT * FROM user_settings WHERE setting_user = '$setting_user'";

		$user_settingsRecord = $this->database->GetRow($sql);

		return $user_settingsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($setting_label, $setting_value)
	{
		$this->debug->Show(Debug::DEBUG, "user_settings::Insert");

		$sql = "INSERT INTO user_settings (setting_label, setting_value)".
			" VALUES ('$setting_label', '" + "'$setting_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "user_settings::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($setting_user, $setting_label, $setting_value)
	{
		$this->debug->Show(Debug::DEBUG, "user_settings::Update");

		$sql = "UPDATE user_settings SET ".
				@"setting_label='$setting_label'," + 
				@"setting_value='$setting_value'" + 
				
				"WHERE setting_user = '$setting_user'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "user_settings::Update return: $result");

		return $result;
	}
}
?>
