<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a therapy_groups_participant_attendance Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class therapy_groups_participant_attendance
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
	function Delete($form_id)
	{
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participant_attendance::Delete");

		$query = "DELETE FROM therapy_groups_participant_attendance ".
			"WHERE form_id = '$form_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participant_attendance::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM therapy_groups_participant_attendance";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$therapy_groups_participant_attendances = $this->database->GetAll($sql);

		return $therapy_groups_participant_attendances;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($form_id)
	{
		$sql = "SELECT * FROM therapy_groups_participant_attendance WHERE form_id = '$form_id'";

		$therapy_groups_participant_attendanceRecord = $this->database->GetRow($sql);

		return $therapy_groups_participant_attendanceRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $meeting_patient_comment, $meeting_patient_status)
	{
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participant_attendance::Insert");

		$sql = "INSERT INTO therapy_groups_participant_attendance (pid, meeting_patient_comment, meeting_patient_status)".
			" VALUES ('$pid', '" + "'$meeting_patient_comment', '" + "'$meeting_patient_status')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participant_attendance::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($form_id, $pid, $meeting_patient_comment, $meeting_patient_status)
	{
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participant_attendance::Update");

		$sql = "UPDATE therapy_groups_participant_attendance SET ".
				@"pid='$pid'," + 
				@"meeting_patient_comment='$meeting_patient_comment'," + 
				@"meeting_patient_status='$meeting_patient_status'" + 
				
				"WHERE form_id = '$form_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participant_attendance::Update return: $result");

		return $result;
	}
}
?>
