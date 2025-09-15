<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a modules_settings Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class modules_settings
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
	function Delete($mod_id)
	{
		$this->debug->Show(Debug::DEBUG, "modules_settings::Delete");

		$query = "DELETE FROM modules_settings ".
			"WHERE mod_id = '$mod_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "modules_settings::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM modules_settings";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$modules_settingss = $this->database->GetAll($sql);

		return $modules_settingss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($mod_id)
	{
		$sql = "SELECT * FROM modules_settings WHERE mod_id = '$mod_id'";

		$modules_settingsRecord = $this->database->GetRow($sql);

		return $modules_settingsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($fld_type, $obj_name, $menu_name, $path)
	{
		$this->debug->Show(Debug::DEBUG, "modules_settings::Insert");

		$sql = "INSERT INTO modules_settings (fld_type, obj_name, menu_name, path)".
			" VALUES ('$fld_type', '" + "'$obj_name', '" + "'$menu_name', '" + "'$path')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "modules_settings::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($mod_id, $fld_type, $obj_name, $menu_name, $path)
	{
		$this->debug->Show(Debug::DEBUG, "modules_settings::Update");

		$sql = "UPDATE modules_settings SET ".
				@"fld_type='$fld_type'," + 
				@"obj_name='$obj_name'," + 
				@"menu_name='$menu_name'," + 
				@"path='$path'" + 
				
				"WHERE mod_id = '$mod_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "modules_settings::Update return: $result");

		return $result;
	}
}
?>
