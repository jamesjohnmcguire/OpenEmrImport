<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a onsite_portal_activity Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class onsite_portal_activity
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
		$this->debug->Show(Debug::DEBUG, "onsite_portal_activity::Delete");

		$query = "DELETE FROM onsite_portal_activity ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "onsite_portal_activity::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM onsite_portal_activity";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$onsite_portal_activitys = $this->database->GetAll($sql);

		return $onsite_portal_activitys;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM onsite_portal_activity WHERE id = '$id'";

		$onsite_portal_activityRecord = $this->database->GetRow($sql);

		return $onsite_portal_activityRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $patient_id, $activity, $require_audit, $pending_action, $action_taken, $status, $narrative, $table_action, $table_args, $action_user, $action_taken_time, $checksum)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_portal_activity::Insert");

		$sql = "INSERT INTO onsite_portal_activity (date, patient_id, activity, require_audit, pending_action, action_taken, status, narrative, table_action, table_args, action_user, action_taken_time, checksum)".
			" VALUES ('$date', '" + "'$patient_id', '" + "'$activity', '" + "'$require_audit', '" + "'$pending_action', '" + "'$action_taken', '" + "'$status', '" + "'$narrative', '" + "'$table_action', '" + "'$table_args', '" + "'$action_user', '" + "'$action_taken_time', '" + "'$checksum')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_portal_activity::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $patient_id, $activity, $require_audit, $pending_action, $action_taken, $status, $narrative, $table_action, $table_args, $action_user, $action_taken_time, $checksum)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_portal_activity::Update");

		$sql = "UPDATE onsite_portal_activity SET ".
				@"date='$date'," + 
				@"patient_id='$patient_id'," + 
				@"activity='$activity'," + 
				@"require_audit='$require_audit'," + 
				@"pending_action='$pending_action'," + 
				@"action_taken='$action_taken'," + 
				@"status='$status'," + 
				@"narrative='$narrative'," + 
				@"table_action='$table_action'," + 
				@"table_args='$table_args'," + 
				@"action_user='$action_user'," + 
				@"action_taken_time='$action_taken_time'," + 
				@"checksum='$checksum'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_portal_activity::Update return: $result");

		return $result;
	}
}
?>
