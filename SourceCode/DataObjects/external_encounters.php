<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a external_encounters Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class external_encounters
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
	function Delete($ee_id)
	{
		$this->debug->Show(Debug::DEBUG, "external_encounters::Delete");

		$query = "DELETE FROM external_encounters ".
			"WHERE ee_id = '$ee_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "external_encounters::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM external_encounters";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$external_encounterss = $this->database->GetAll($sql);

		return $external_encounterss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($ee_id)
	{
		$sql = "SELECT * FROM external_encounters WHERE ee_id = '$ee_id'";

		$external_encountersRecord = $this->database->GetRow($sql);

		return $external_encountersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ee_date, $ee_pid, $ee_provider_id, $ee_facility_id, $ee_encounter_diagnosis, $ee_external_id)
	{
		$this->debug->Show(Debug::DEBUG, "external_encounters::Insert");

		$sql = "INSERT INTO external_encounters (ee_date, ee_pid, ee_provider_id, ee_facility_id, ee_encounter_diagnosis, ee_external_id)".
			" VALUES ('$ee_date', '" + "'$ee_pid', '" + "'$ee_provider_id', '" + "'$ee_facility_id', '" + "'$ee_encounter_diagnosis', '" + "'$ee_external_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "external_encounters::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($ee_id, $ee_date, $ee_pid, $ee_provider_id, $ee_facility_id, $ee_encounter_diagnosis, $ee_external_id)
	{
		$this->debug->Show(Debug::DEBUG, "external_encounters::Update");

		$sql = "UPDATE external_encounters SET ".
				@"ee_date='$ee_date'," + 
				@"ee_pid='$ee_pid'," + 
				@"ee_provider_id='$ee_provider_id'," + 
				@"ee_facility_id='$ee_facility_id'," + 
				@"ee_encounter_diagnosis='$ee_encounter_diagnosis'," + 
				@"ee_external_id='$ee_external_id'" + 
				
				"WHERE ee_id = '$ee_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "external_encounters::Update return: $result");

		return $result;
	}
}
?>
