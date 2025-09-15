<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_observation Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_observation
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
		$this->debug->Show(Debug::DEBUG, "form_observation::Delete");

		$query = "DELETE FROM form_observation ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_observation::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_observation";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_observations = $this->database->GetAll($sql);

		return $form_observations;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_observation WHERE id = '$id'";

		$form_observationRecord = $this->database->GetRow($sql);

		return $form_observationRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $pid, $encounter, $user, $groupname, $authorized, $activity, $code, $observation, $ob_value, $ob_unit, $description, $code_type, $table_code)
	{
		$this->debug->Show(Debug::DEBUG, "form_observation::Insert");

		$sql = "INSERT INTO form_observation (date, pid, encounter, user, groupname, authorized, activity, code, observation, ob_value, ob_unit, description, code_type, table_code)".
			" VALUES ('$date', '" + "'$pid', '" + "'$encounter', '" + "'$user', '" + "'$groupname', '" + "'$authorized', '" + "'$activity', '" + "'$code', '" + "'$observation', '" + "'$ob_value', '" + "'$ob_unit', '" + "'$description', '" + "'$code_type', '" + "'$table_code')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_observation::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $pid, $encounter, $user, $groupname, $authorized, $activity, $code, $observation, $ob_value, $ob_unit, $description, $code_type, $table_code)
	{
		$this->debug->Show(Debug::DEBUG, "form_observation::Update");

		$sql = "UPDATE form_observation SET ".
				@"date='$date'," + 
				@"pid='$pid'," + 
				@"encounter='$encounter'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'," + 
				@"activity='$activity'," + 
				@"code='$code'," + 
				@"observation='$observation'," + 
				@"ob_value='$ob_value'," + 
				@"ob_unit='$ob_unit'," + 
				@"description='$description'," + 
				@"code_type='$code_type'," + 
				@"table_code='$table_code'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_observation::Update return: $result");

		return $result;
	}
}
?>
