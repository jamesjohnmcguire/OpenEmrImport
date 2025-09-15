<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a lbt_data Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class lbt_data
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
	function Delete($form_id)
	{
		$this->debug->Show(Debug::DEBUG, "lbt_data::Delete");

		$query = "DELETE FROM lbt_data ".
			"WHERE form_id = '$form_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "lbt_data::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM lbt_data";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$lbt_datas = $this->database->GetAll($sql);

		return $lbt_datas;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($form_id)
	{
		$sql = "SELECT * FROM lbt_data WHERE form_id = '$form_id'";

		$lbt_dataRecord = $this->database->GetRow($sql);

		return $lbt_dataRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($field_id, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "lbt_data::Insert");

		$sql = "INSERT INTO lbt_data (field_id, field_value)".
			" VALUES ('$field_id', '" + "'$field_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "lbt_data::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($form_id, $field_id, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "lbt_data::Update");

		$sql = "UPDATE lbt_data SET ".
				@"field_id='$field_id'," + 
				@"field_value='$field_value'" + 
				
				"WHERE form_id = '$form_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "lbt_data::Update return: $result");

		return $result;
	}
}
?>
