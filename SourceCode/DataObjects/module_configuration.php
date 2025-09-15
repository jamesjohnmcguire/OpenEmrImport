<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a module_configuration Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class module_configuration
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
	function Delete($module_config_id)
	{
		$this->debug->Show(Debug::DEBUG, "module_configuration::Delete");

		$query = "DELETE FROM module_configuration ".
			"WHERE module_config_id = '$module_config_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "module_configuration::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM module_configuration";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$module_configurations = $this->database->GetAll($sql);

		return $module_configurations;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($module_config_id)
	{
		$sql = "SELECT * FROM module_configuration WHERE module_config_id = '$module_config_id'";

		$module_configurationRecord = $this->database->GetRow($sql);

		return $module_configurationRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($module_id, $field_name, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "module_configuration::Insert");

		$sql = "INSERT INTO module_configuration (module_id, field_name, field_value)".
			" VALUES ('$module_id', '" + "'$field_name', '" + "'$field_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "module_configuration::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($module_config_id, $module_id, $field_name, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "module_configuration::Update");

		$sql = "UPDATE module_configuration SET ".
				@"module_id='$module_id'," + 
				@"field_name='$field_name'," + 
				@"field_value='$field_value'" + 
				
				"WHERE module_config_id = '$module_config_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "module_configuration::Update return: $result");

		return $result;
	}
}
?>
