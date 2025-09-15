<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a module_acl_group_settings Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class module_acl_group_settings
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
	function Delete($module_id)
	{
		$this->debug->Show(Debug::DEBUG, "module_acl_group_settings::Delete");

		$query = "DELETE FROM module_acl_group_settings ".
			"WHERE module_id = '$module_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "module_acl_group_settings::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM module_acl_group_settings";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$module_acl_group_settingss = $this->database->GetAll($sql);

		return $module_acl_group_settingss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($module_id)
	{
		$sql = "SELECT * FROM module_acl_group_settings WHERE module_id = '$module_id'";

		$module_acl_group_settingsRecord = $this->database->GetRow($sql);

		return $module_acl_group_settingsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($group_id, $section_id, $allowed)
	{
		$this->debug->Show(Debug::DEBUG, "module_acl_group_settings::Insert");

		$sql = "INSERT INTO module_acl_group_settings (group_id, section_id, allowed)".
			" VALUES ('$group_id', '" + "'$section_id', '" + "'$allowed')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "module_acl_group_settings::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($module_id, $group_id, $section_id, $allowed)
	{
		$this->debug->Show(Debug::DEBUG, "module_acl_group_settings::Update");

		$sql = "UPDATE module_acl_group_settings SET ".
				@"group_id='$group_id'," + 
				@"section_id='$section_id'," + 
				@"allowed='$allowed'" + 
				
				"WHERE module_id = '$module_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "module_acl_group_settings::Update return: $result");

		return $result;
	}
}
?>
