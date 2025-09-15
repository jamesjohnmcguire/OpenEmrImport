<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a ccda_field_mapping Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class ccda_field_mapping
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
		$this->debug->Show(Debug::DEBUG, "ccda_field_mapping::Delete");

		$query = "DELETE FROM ccda_field_mapping ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "ccda_field_mapping::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM ccda_field_mapping";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$ccda_field_mappings = $this->database->GetAll($sql);

		return $ccda_field_mappings;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM ccda_field_mapping WHERE id = '$id'";

		$ccda_field_mappingRecord = $this->database->GetRow($sql);

		return $ccda_field_mappingRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($table_id, $ccda_field)
	{
		$this->debug->Show(Debug::DEBUG, "ccda_field_mapping::Insert");

		$sql = "INSERT INTO ccda_field_mapping (table_id, ccda_field)".
			" VALUES ('$table_id', '" + "'$ccda_field')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "ccda_field_mapping::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $table_id, $ccda_field)
	{
		$this->debug->Show(Debug::DEBUG, "ccda_field_mapping::Update");

		$sql = "UPDATE ccda_field_mapping SET ".
				@"table_id='$table_id'," + 
				@"ccda_field='$ccda_field'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "ccda_field_mapping::Update return: $result");

		return $result;
	}
}
?>
