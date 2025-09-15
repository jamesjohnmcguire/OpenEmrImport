<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a therapy_groups Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class therapy_groups
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
		$this->debug->Show(Debug::DEBUG, "therapy_groups::Delete");

		$query = "DELETE FROM therapy_groups ".
			"WHERE group_id = '$group_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "therapy_groups::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM therapy_groups";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$therapy_groupss = $this->database->GetAll($sql);

		return $therapy_groupss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($group_id)
	{
		$sql = "SELECT * FROM therapy_groups WHERE group_id = '$group_id'";

		$therapy_groupsRecord = $this->database->GetRow($sql);

		return $therapy_groupsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($group_name, $group_start_date, $group_end_date, $group_type, $group_participation, $group_status, $group_notes, $group_guest_counselors)
	{
		$this->debug->Show(Debug::DEBUG, "therapy_groups::Insert");

		$sql = "INSERT INTO therapy_groups (group_name, group_start_date, group_end_date, group_type, group_participation, group_status, group_notes, group_guest_counselors)".
			" VALUES ('$group_name', '" + "'$group_start_date', '" + "'$group_end_date', '" + "'$group_type', '" + "'$group_participation', '" + "'$group_status', '" + "'$group_notes', '" + "'$group_guest_counselors')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "therapy_groups::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($group_id, $group_name, $group_start_date, $group_end_date, $group_type, $group_participation, $group_status, $group_notes, $group_guest_counselors)
	{
		$this->debug->Show(Debug::DEBUG, "therapy_groups::Update");

		$sql = "UPDATE therapy_groups SET ".
				@"group_name='$group_name'," + 
				@"group_start_date='$group_start_date'," + 
				@"group_end_date='$group_end_date'," + 
				@"group_type='$group_type'," + 
				@"group_participation='$group_participation'," + 
				@"group_status='$group_status'," + 
				@"group_notes='$group_notes'," + 
				@"group_guest_counselors='$group_guest_counselors'" + 
				
				"WHERE group_id = '$group_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "therapy_groups::Update return: $result");

		return $result;
	}
}
?>
