<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a insurance_numbers Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class insurance_numbers
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
		$this->debug->Show(Debug::DEBUG, "insurance_numbers::Delete");

		$query = "DELETE FROM insurance_numbers ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "insurance_numbers::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM insurance_numbers";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$insurance_numberss = $this->database->GetAll($sql);

		return $insurance_numberss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM insurance_numbers WHERE id = '$id'";

		$insurance_numbersRecord = $this->database->GetRow($sql);

		return $insurance_numbersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($provider_id, $insurance_company_id, $provider_number, $rendering_provider_number, $group_number, $provider_number_type, $rendering_provider_number_type)
	{
		$this->debug->Show(Debug::DEBUG, "insurance_numbers::Insert");

		$sql = "INSERT INTO insurance_numbers (provider_id, insurance_company_id, provider_number, rendering_provider_number, group_number, provider_number_type, rendering_provider_number_type)".
			" VALUES ('$provider_id', '" + "'$insurance_company_id', '" + "'$provider_number', '" + "'$rendering_provider_number', '" + "'$group_number', '" + "'$provider_number_type', '" + "'$rendering_provider_number_type')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "insurance_numbers::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $provider_id, $insurance_company_id, $provider_number, $rendering_provider_number, $group_number, $provider_number_type, $rendering_provider_number_type)
	{
		$this->debug->Show(Debug::DEBUG, "insurance_numbers::Update");

		$sql = "UPDATE insurance_numbers SET ".
				@"provider_id='$provider_id'," + 
				@"insurance_company_id='$insurance_company_id'," + 
				@"provider_number='$provider_number'," + 
				@"rendering_provider_number='$rendering_provider_number'," + 
				@"group_number='$group_number'," + 
				@"provider_number_type='$provider_number_type'," + 
				@"rendering_provider_number_type='$rendering_provider_number_type'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "insurance_numbers::Update return: $result");

		return $result;
	}
}
?>
