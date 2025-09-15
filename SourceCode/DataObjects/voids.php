<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a voids Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class voids
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
	function Delete($void_id)
	{
		$this->debug->Show(Debug::DEBUG, "voids::Delete");

		$query = "DELETE FROM voids ".
			"WHERE void_id = '$void_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "voids::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM voids";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$voidss = $this->database->GetAll($sql);

		return $voidss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($void_id)
	{
		$sql = "SELECT * FROM voids WHERE void_id = '$void_id'";

		$voidsRecord = $this->database->GetRow($sql);

		return $voidsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($patient_id, $encounter_id, $what_voided, $date_original, $date_voided, $user_id, $amount1, $amount2, $other_info)
	{
		$this->debug->Show(Debug::DEBUG, "voids::Insert");

		$sql = "INSERT INTO voids (patient_id, encounter_id, what_voided, date_original, date_voided, user_id, amount1, amount2, other_info)".
			" VALUES ('$patient_id', '" + "'$encounter_id', '" + "'$what_voided', '" + "'$date_original', '" + "'$date_voided', '" + "'$user_id', '" + "'$amount1', '" + "'$amount2', '" + "'$other_info')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "voids::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($void_id, $patient_id, $encounter_id, $what_voided, $date_original, $date_voided, $user_id, $amount1, $amount2, $other_info)
	{
		$this->debug->Show(Debug::DEBUG, "voids::Update");

		$sql = "UPDATE voids SET ".
				@"patient_id='$patient_id'," + 
				@"encounter_id='$encounter_id'," + 
				@"what_voided='$what_voided'," + 
				@"date_original='$date_original'," + 
				@"date_voided='$date_voided'," + 
				@"user_id='$user_id'," + 
				@"amount1='$amount1'," + 
				@"amount2='$amount2'," + 
				@"other_info='$other_info'" + 
				
				"WHERE void_id = '$void_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "voids::Update return: $result");

		return $result;
	}
}
?>
