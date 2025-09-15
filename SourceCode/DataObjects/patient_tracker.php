<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a patient_tracker Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class patient_tracker
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
		$this->debug->Show(Debug::DEBUG, "patient_tracker::Delete");

		$query = "DELETE FROM patient_tracker ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "patient_tracker::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM patient_tracker";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$patient_trackers = $this->database->GetAll($sql);

		return $patient_trackers;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM patient_tracker WHERE id = '$id'";

		$patient_trackerRecord = $this->database->GetRow($sql);

		return $patient_trackerRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $apptdate, $appttime, $eid, $pid, $original_user, $encounter, $lastseq, $random_drug_test, $drug_screen_completed)
	{
		$this->debug->Show(Debug::DEBUG, "patient_tracker::Insert");

		$sql = "INSERT INTO patient_tracker (date, apptdate, appttime, eid, pid, original_user, encounter, lastseq, random_drug_test, drug_screen_completed)".
			" VALUES ('$date', '" + "'$apptdate', '" + "'$appttime', '" + "'$eid', '" + "'$pid', '" + "'$original_user', '" + "'$encounter', '" + "'$lastseq', '" + "'$random_drug_test', '" + "'$drug_screen_completed')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "patient_tracker::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $apptdate, $appttime, $eid, $pid, $original_user, $encounter, $lastseq, $random_drug_test, $drug_screen_completed)
	{
		$this->debug->Show(Debug::DEBUG, "patient_tracker::Update");

		$sql = "UPDATE patient_tracker SET ".
				@"date='$date'," + 
				@"apptdate='$apptdate'," + 
				@"appttime='$appttime'," + 
				@"eid='$eid'," + 
				@"pid='$pid'," + 
				@"original_user='$original_user'," + 
				@"encounter='$encounter'," + 
				@"lastseq='$lastseq'," + 
				@"random_drug_test='$random_drug_test'," + 
				@"drug_screen_completed='$drug_screen_completed'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "patient_tracker::Update return: $result");

		return $result;
	}
}
?>
