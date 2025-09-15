<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a therapy_groups_participants Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class therapy_groups_participants
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
	function Delete($group_id)
	{
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participants::Delete");

		$query = "DELETE FROM therapy_groups_participants ".
			"WHERE group_id = '$group_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participants::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM therapy_groups_participants";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$therapy_groups_participantss = $this->database->GetAll($sql);

		return $therapy_groups_participantss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($group_id)
	{
		$sql = "SELECT * FROM therapy_groups_participants WHERE group_id = '$group_id'";

		$therapy_groups_participantsRecord = $this->database->GetRow($sql);

		return $therapy_groups_participantsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $group_patient_status, $group_patient_start, $group_patient_end, $group_patient_comment)
	{
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participants::Insert");

		$sql = "INSERT INTO therapy_groups_participants (pid, group_patient_status, group_patient_start, group_patient_end, group_patient_comment)".
			" VALUES ('$pid', '" + "'$group_patient_status', '" + "'$group_patient_start', '" + "'$group_patient_end', '" + "'$group_patient_comment')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participants::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($group_id, $pid, $group_patient_status, $group_patient_start, $group_patient_end, $group_patient_comment)
	{
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participants::Update");

		$sql = "UPDATE therapy_groups_participants SET ".
				@"pid='$pid'," + 
				@"group_patient_status='$group_patient_status'," + 
				@"group_patient_start='$group_patient_start'," + 
				@"group_patient_end='$group_patient_end'," + 
				@"group_patient_comment='$group_patient_comment'" + 
				
				"WHERE group_id = '$group_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "therapy_groups_participants::Update return: $result");

		return $result;
	}
}
?>
