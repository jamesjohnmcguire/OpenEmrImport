<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a audit_details Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class audit_details
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
		$this->debug->Show(Debug::DEBUG, "audit_details::Delete");

		$query = "DELETE FROM audit_details ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "audit_details::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM audit_details";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$audit_detailss = $this->database->GetAll($sql);

		return $audit_detailss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM audit_details WHERE id = '$id'";

		$audit_detailsRecord = $this->database->GetRow($sql);

		return $audit_detailsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($table_name, $field_name, $field_value, $audit_master_id, $entry_identification)
	{
		$this->debug->Show(Debug::DEBUG, "audit_details::Insert");

		$sql = "INSERT INTO audit_details (table_name, field_name, field_value, audit_master_id, entry_identification)".
			" VALUES ('$table_name', '" + "'$field_name', '" + "'$field_value', '" + "'$audit_master_id', '" + "'$entry_identification')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "audit_details::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $table_name, $field_name, $field_value, $audit_master_id, $entry_identification)
	{
		$this->debug->Show(Debug::DEBUG, "audit_details::Update");

		$sql = "UPDATE audit_details SET ".
				@"table_name='$table_name'," + 
				@"field_name='$field_name'," + 
				@"field_value='$field_value'," + 
				@"audit_master_id='$audit_master_id'," + 
				@"entry_identification='$entry_identification'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "audit_details::Update return: $result");

		return $result;
	}
}
?>
