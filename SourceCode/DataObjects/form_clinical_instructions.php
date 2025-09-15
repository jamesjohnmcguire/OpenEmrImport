<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_clinical_instructions Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_clinical_instructions
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
		$this->debug->Show(Debug::DEBUG, "form_clinical_instructions::Delete");

		$query = "DELETE FROM form_clinical_instructions ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_clinical_instructions::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_clinical_instructions";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_clinical_instructionss = $this->database->GetAll($sql);

		return $form_clinical_instructionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_clinical_instructions WHERE id = '$id'";

		$form_clinical_instructionsRecord = $this->database->GetRow($sql);

		return $form_clinical_instructionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $encounter, $user, $instruction, $date, $activity)
	{
		$this->debug->Show(Debug::DEBUG, "form_clinical_instructions::Insert");

		$sql = "INSERT INTO form_clinical_instructions (pid, encounter, user, instruction, date, activity)".
			" VALUES ('$pid', '" + "'$encounter', '" + "'$user', '" + "'$instruction', '" + "'$date', '" + "'$activity')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_clinical_instructions::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $pid, $encounter, $user, $instruction, $date, $activity)
	{
		$this->debug->Show(Debug::DEBUG, "form_clinical_instructions::Update");

		$sql = "UPDATE form_clinical_instructions SET ".
				@"pid='$pid'," + 
				@"encounter='$encounter'," + 
				@"user='$user'," + 
				@"instruction='$instruction'," + 
				@"date='$date'," + 
				@"activity='$activity'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_clinical_instructions::Update return: $result");

		return $result;
	}
}
?>
