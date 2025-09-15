<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a patient_tracker_element Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class patient_tracker_element
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
	function Delete($pt_tracker_id)
	{
		$this->debug->Show(Debug::DEBUG, "patient_tracker_element::Delete");

		$query = "DELETE FROM patient_tracker_element ".
			"WHERE pt_tracker_id = '$pt_tracker_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "patient_tracker_element::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM patient_tracker_element";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$patient_tracker_elements = $this->database->GetAll($sql);

		return $patient_tracker_elements;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pt_tracker_id)
	{
		$sql = "SELECT * FROM patient_tracker_element WHERE pt_tracker_id = '$pt_tracker_id'";

		$patient_tracker_elementRecord = $this->database->GetRow($sql);

		return $patient_tracker_elementRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($start_datetime, $room, $status, $seq, $user)
	{
		$this->debug->Show(Debug::DEBUG, "patient_tracker_element::Insert");

		$sql = "INSERT INTO patient_tracker_element (start_datetime, room, status, seq, user)".
			" VALUES ('$start_datetime', '" + "'$room', '" + "'$status', '" + "'$seq', '" + "'$user')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "patient_tracker_element::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pt_tracker_id, $start_datetime, $room, $status, $seq, $user)
	{
		$this->debug->Show(Debug::DEBUG, "patient_tracker_element::Update");

		$sql = "UPDATE patient_tracker_element SET ".
				@"start_datetime='$start_datetime'," + 
				@"room='$room'," + 
				@"status='$status'," + 
				@"seq='$seq'," + 
				@"user='$user'" + 
				
				"WHERE pt_tracker_id = '$pt_tracker_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "patient_tracker_element::Update return: $result");

		return $result;
	}
}
?>
