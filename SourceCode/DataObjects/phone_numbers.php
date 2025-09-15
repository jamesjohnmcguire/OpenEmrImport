<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a phone_numbers Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class phone_numbers
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
		$this->debug->Show(Debug::DEBUG, "phone_numbers::Delete");

		$query = "DELETE FROM phone_numbers ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "phone_numbers::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM phone_numbers";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$phone_numberss = $this->database->GetAll($sql);

		return $phone_numberss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM phone_numbers WHERE id = '$id'";

		$phone_numbersRecord = $this->database->GetRow($sql);

		return $phone_numbersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($country_code, $area_code, $prefix, $number, $type, $foreign_id)
	{
		$this->debug->Show(Debug::DEBUG, "phone_numbers::Insert");

		$sql = "INSERT INTO phone_numbers (country_code, area_code, prefix, number, type, foreign_id)".
			" VALUES ('$country_code', '" + "'$area_code', '" + "'$prefix', '" + "'$number', '" + "'$type', '" + "'$foreign_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "phone_numbers::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $country_code, $area_code, $prefix, $number, $type, $foreign_id)
	{
		$this->debug->Show(Debug::DEBUG, "phone_numbers::Update");

		$sql = "UPDATE phone_numbers SET ".
				@"country_code='$country_code'," + 
				@"area_code='$area_code'," + 
				@"prefix='$prefix'," + 
				@"number='$number'," + 
				@"type='$type'," + 
				@"foreign_id='$foreign_id'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "phone_numbers::Update return: $result");

		return $result;
	}
}
?>
