<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a modules_hooks_settings Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class modules_hooks_settings
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
		$this->debug->Show(Debug::DEBUG, "modules_hooks_settings::Delete");

		$query = "DELETE FROM modules_hooks_settings ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "modules_hooks_settings::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM modules_hooks_settings";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$modules_hooks_settingss = $this->database->GetAll($sql);

		return $modules_hooks_settingss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM modules_hooks_settings WHERE id = '$id'";

		$modules_hooks_settingsRecord = $this->database->GetRow($sql);

		return $modules_hooks_settingsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($mod_id, $enabled_hooks, $attached_to)
	{
		$this->debug->Show(Debug::DEBUG, "modules_hooks_settings::Insert");

		$sql = "INSERT INTO modules_hooks_settings (mod_id, enabled_hooks, attached_to)".
			" VALUES ('$mod_id', '" + "'$enabled_hooks', '" + "'$attached_to')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "modules_hooks_settings::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $mod_id, $enabled_hooks, $attached_to)
	{
		$this->debug->Show(Debug::DEBUG, "modules_hooks_settings::Update");

		$sql = "UPDATE modules_hooks_settings SET ".
				@"mod_id='$mod_id'," + 
				@"enabled_hooks='$enabled_hooks'," + 
				@"attached_to='$attached_to'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "modules_hooks_settings::Update return: $result");

		return $result;
	}
}
?>
