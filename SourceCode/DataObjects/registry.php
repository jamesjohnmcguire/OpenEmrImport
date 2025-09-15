<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a registry Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class registry
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
	function Delete($name)
	{
		$this->debug->Show(Debug::DEBUG, "registry::Delete");

		$query = "DELETE FROM registry ".
			"WHERE name = '$name'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "registry::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM registry";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$registrys = $this->database->GetAll($sql);

		return $registrys;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($name)
	{
		$sql = "SELECT * FROM registry WHERE name = '$name'";

		$registryRecord = $this->database->GetRow($sql);

		return $registryRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($state, $directory, $id, $sql_run, $unpackaged, $date, $priority, $category, $nickname, $patient_encounter, $therapy_group_encounter, $aco_spec)
	{
		$this->debug->Show(Debug::DEBUG, "registry::Insert");

		$sql = "INSERT INTO registry (state, directory, id, sql_run, unpackaged, date, priority, category, nickname, patient_encounter, therapy_group_encounter, aco_spec)".
			" VALUES ('$state', '" + "'$directory', '" + "'$id', '" + "'$sql_run', '" + "'$unpackaged', '" + "'$date', '" + "'$priority', '" + "'$category', '" + "'$nickname', '" + "'$patient_encounter', '" + "'$therapy_group_encounter', '" + "'$aco_spec')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "registry::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($name, $state, $directory, $id, $sql_run, $unpackaged, $date, $priority, $category, $nickname, $patient_encounter, $therapy_group_encounter, $aco_spec)
	{
		$this->debug->Show(Debug::DEBUG, "registry::Update");

		$sql = "UPDATE registry SET ".
				@"state='$state'," + 
				@"directory='$directory'," + 
				@"id='$id'," + 
				@"sql_run='$sql_run'," + 
				@"unpackaged='$unpackaged'," + 
				@"date='$date'," + 
				@"priority='$priority'," + 
				@"category='$category'," + 
				@"nickname='$nickname'," + 
				@"patient_encounter='$patient_encounter'," + 
				@"therapy_group_encounter='$therapy_group_encounter'," + 
				@"aco_spec='$aco_spec'" + 
				
				"WHERE name = '$name'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "registry::Update return: $result");

		return $result;
	}
}
?>
