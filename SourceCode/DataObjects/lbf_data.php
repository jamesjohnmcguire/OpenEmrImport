<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a lbf_data Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class lbf_data
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
		$this->debug->Show(Debug::DEBUG, "lbf_data::Delete");

		$query = "DELETE FROM lbf_data ".
			"WHERE form_id = '$form_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "lbf_data::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM lbf_data";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$lbf_datas = $this->database->GetAll($sql);

		return $lbf_datas;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($form_id)
	{
		$sql = "SELECT * FROM lbf_data WHERE form_id = '$form_id'";

		$lbf_dataRecord = $this->database->GetRow($sql);

		return $lbf_dataRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($field_id, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "lbf_data::Insert");

		$sql = "INSERT INTO lbf_data (field_id, field_value)".
			" VALUES ('$field_id', '" + "'$field_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "lbf_data::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($form_id, $field_id, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "lbf_data::Update");

		$sql = "UPDATE lbf_data SET ".
				@"field_id='$field_id'," + 
				@"field_value='$field_value'" + 
				
				"WHERE form_id = '$form_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "lbf_data::Update return: $result");

		return $result;
	}
}
?>
