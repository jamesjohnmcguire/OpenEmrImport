<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a modules Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class modules
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
		$this->debug->Show(Debug::DEBUG, "modules::Delete");

		$query = "DELETE FROM modules ".
			"WHERE mod_id = '$mod_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "modules::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM modules";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$moduless = $this->database->GetAll($sql);

		return $moduless;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($mod_id)
	{
		$sql = "SELECT * FROM modules WHERE mod_id = '$mod_id'";

		$modulesRecord = $this->database->GetRow($sql);

		return $modulesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($mod_name, $mod_directory, $mod_parent, $mod_type, $mod_active, $mod_ui_name, $mod_relative_link, $mod_ui_order, $mod_ui_active, $mod_description, $mod_nick_name, $mod_enc_menu, $permissions_item_table, $directory, $date, $sql_run, $type)
	{
		$this->debug->Show(Debug::DEBUG, "modules::Insert");

		$sql = "INSERT INTO modules (mod_name, mod_directory, mod_parent, mod_type, mod_active, mod_ui_name, mod_relative_link, mod_ui_order, mod_ui_active, mod_description, mod_nick_name, mod_enc_menu, permissions_item_table, directory, date, sql_run, type)".
			" VALUES ('$mod_name', '" + "'$mod_directory', '" + "'$mod_parent', '" + "'$mod_type', '" + "'$mod_active', '" + "'$mod_ui_name', '" + "'$mod_relative_link', '" + "'$mod_ui_order', '" + "'$mod_ui_active', '" + "'$mod_description', '" + "'$mod_nick_name', '" + "'$mod_enc_menu', '" + "'$permissions_item_table', '" + "'$directory', '" + "'$date', '" + "'$sql_run', '" + "'$type')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "modules::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($mod_id, $mod_name, $mod_directory, $mod_parent, $mod_type, $mod_active, $mod_ui_name, $mod_relative_link, $mod_ui_order, $mod_ui_active, $mod_description, $mod_nick_name, $mod_enc_menu, $permissions_item_table, $directory, $date, $sql_run, $type)
	{
		$this->debug->Show(Debug::DEBUG, "modules::Update");

		$sql = "UPDATE modules SET ".
				@"mod_name='$mod_name'," + 
				@"mod_directory='$mod_directory'," + 
				@"mod_parent='$mod_parent'," + 
				@"mod_type='$mod_type'," + 
				@"mod_active='$mod_active'," + 
				@"mod_ui_name='$mod_ui_name'," + 
				@"mod_relative_link='$mod_relative_link'," + 
				@"mod_ui_order='$mod_ui_order'," + 
				@"mod_ui_active='$mod_ui_active'," + 
				@"mod_description='$mod_description'," + 
				@"mod_nick_name='$mod_nick_name'," + 
				@"mod_enc_menu='$mod_enc_menu'," + 
				@"permissions_item_table='$permissions_item_table'," + 
				@"directory='$directory'," + 
				@"date='$date'," + 
				@"sql_run='$sql_run'," + 
				@"type='$type'" + 
				
				"WHERE mod_id = '$mod_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "modules::Update return: $result");

		return $result;
	}
}
?>
