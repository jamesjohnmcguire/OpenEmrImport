<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a geo_country_reference Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class geo_country_reference
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
	function Delete($countries_id)
	{
		$this->debug->Show(Debug::DEBUG, "geo_country_reference::Delete");

		$query = "DELETE FROM geo_country_reference ".
			"WHERE countries_id = '$countries_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "geo_country_reference::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM geo_country_reference";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$geo_country_references = $this->database->GetAll($sql);

		return $geo_country_references;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($countries_id)
	{
		$sql = "SELECT * FROM geo_country_reference WHERE countries_id = '$countries_id'";

		$geo_country_referenceRecord = $this->database->GetRow($sql);

		return $geo_country_referenceRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($countries_name, $countries_iso_code_2, $countries_iso_code_3)
	{
		$this->debug->Show(Debug::DEBUG, "geo_country_reference::Insert");

		$sql = "INSERT INTO geo_country_reference (countries_name, countries_iso_code_2, countries_iso_code_3)".
			" VALUES ('$countries_name', '" + "'$countries_iso_code_2', '" + "'$countries_iso_code_3')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "geo_country_reference::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($countries_id, $countries_name, $countries_iso_code_2, $countries_iso_code_3)
	{
		$this->debug->Show(Debug::DEBUG, "geo_country_reference::Update");

		$sql = "UPDATE geo_country_reference SET ".
				@"countries_name='$countries_name'," + 
				@"countries_iso_code_2='$countries_iso_code_2'," + 
				@"countries_iso_code_3='$countries_iso_code_3'" + 
				
				"WHERE countries_id = '$countries_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "geo_country_reference::Update return: $result");

		return $result;
	}
}
?>
