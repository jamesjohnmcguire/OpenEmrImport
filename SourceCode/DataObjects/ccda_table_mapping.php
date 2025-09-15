<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a ccda_table_mapping Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class ccda_table_mapping
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
		$this->debug->Show(Debug::DEBUG, "ccda_table_mapping::Delete");

		$query = "DELETE FROM ccda_table_mapping ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "ccda_table_mapping::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM ccda_table_mapping";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$ccda_table_mappings = $this->database->GetAll($sql);

		return $ccda_table_mappings;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM ccda_table_mapping WHERE id = '$id'";

		$ccda_table_mappingRecord = $this->database->GetRow($sql);

		return $ccda_table_mappingRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ccda_component, $ccda_component_section, $form_dir, $form_type, $form_table, $user_id, $deleted, $timestamp)
	{
		$this->debug->Show(Debug::DEBUG, "ccda_table_mapping::Insert");

		$sql = "INSERT INTO ccda_table_mapping (ccda_component, ccda_component_section, form_dir, form_type, form_table, user_id, deleted, timestamp)".
			" VALUES ('$ccda_component', '" + "'$ccda_component_section', '" + "'$form_dir', '" + "'$form_type', '" + "'$form_table', '" + "'$user_id', '" + "'$deleted', '" + "'$timestamp')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "ccda_table_mapping::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $ccda_component, $ccda_component_section, $form_dir, $form_type, $form_table, $user_id, $deleted, $timestamp)
	{
		$this->debug->Show(Debug::DEBUG, "ccda_table_mapping::Update");

		$sql = "UPDATE ccda_table_mapping SET ".
				@"ccda_component='$ccda_component'," + 
				@"ccda_component_section='$ccda_component_section'," + 
				@"form_dir='$form_dir'," + 
				@"form_type='$form_type'," + 
				@"form_table='$form_table'," + 
				@"user_id='$user_id'," + 
				@"deleted='$deleted'," + 
				@"timestamp='$timestamp'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "ccda_table_mapping::Update return: $result");

		return $result;
	}
}
?>
