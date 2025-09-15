<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a array Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class array
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
	function Delete($array_key)
	{
		$this->debug->Show(Debug::DEBUG, "array::Delete");

		$query = "DELETE FROM array ".
			"WHERE array_key = '$array_key'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "array::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM array";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$arrays = $this->database->GetAll($sql);

		return $arrays;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($array_key)
	{
		$sql = "SELECT * FROM array WHERE array_key = '$array_key'";

		$arrayRecord = $this->database->GetRow($sql);

		return $arrayRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($array_value)
	{
		$this->debug->Show(Debug::DEBUG, "array::Insert");

		$sql = "INSERT INTO array (array_value)".
			" VALUES ('$array_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "array::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($array_key, $array_value)
	{
		$this->debug->Show(Debug::DEBUG, "array::Update");

		$sql = "UPDATE array SET ".
				@"array_value='$array_value'" + 
				
				"WHERE array_key = '$array_key'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "array::Update return: $result");

		return $result;
	}
}
?>
