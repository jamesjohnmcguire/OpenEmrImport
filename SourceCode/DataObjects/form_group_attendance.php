<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_group_attendance Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_group_attendance
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
		$this->debug->Show(Debug::DEBUG, "form_group_attendance::Delete");

		$query = "DELETE FROM form_group_attendance ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_group_attendance::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_group_attendance";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_group_attendances = $this->database->GetAll($sql);

		return $form_group_attendances;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_group_attendance WHERE id = '$id'";

		$form_group_attendanceRecord = $this->database->GetRow($sql);

		return $form_group_attendanceRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $group_id, $user, $groupname, $authorized, $encounter_id, $activity)
	{
		$this->debug->Show(Debug::DEBUG, "form_group_attendance::Insert");

		$sql = "INSERT INTO form_group_attendance (date, group_id, user, groupname, authorized, encounter_id, activity)".
			" VALUES ('$date', '" + "'$group_id', '" + "'$user', '" + "'$groupname', '" + "'$authorized', '" + "'$encounter_id', '" + "'$activity')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_group_attendance::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $group_id, $user, $groupname, $authorized, $encounter_id, $activity)
	{
		$this->debug->Show(Debug::DEBUG, "form_group_attendance::Update");

		$sql = "UPDATE form_group_attendance SET ".
				@"date='$date'," + 
				@"group_id='$group_id'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'," + 
				@"encounter_id='$encounter_id'," + 
				@"activity='$activity'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_group_attendance::Update return: $result");

		return $result;
	}
}
?>
