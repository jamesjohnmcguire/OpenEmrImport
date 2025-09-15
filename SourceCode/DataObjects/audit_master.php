<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a audit_master Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class audit_master
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
		$this->debug->Show(Debug::DEBUG, "audit_master::Delete");

		$query = "DELETE FROM audit_master ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "audit_master::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM audit_master";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$audit_masters = $this->database->GetAll($sql);

		return $audit_masters;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM audit_master WHERE id = '$id'";

		$audit_masterRecord = $this->database->GetRow($sql);

		return $audit_masterRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $user_id, $approval_status, $comments, $created_time, $modified_time, $ip_address, $type)
	{
		$this->debug->Show(Debug::DEBUG, "audit_master::Insert");

		$sql = "INSERT INTO audit_master (pid, user_id, approval_status, comments, created_time, modified_time, ip_address, type)".
			" VALUES ('$pid', '" + "'$user_id', '" + "'$approval_status', '" + "'$comments', '" + "'$created_time', '" + "'$modified_time', '" + "'$ip_address', '" + "'$type')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "audit_master::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $pid, $user_id, $approval_status, $comments, $created_time, $modified_time, $ip_address, $type)
	{
		$this->debug->Show(Debug::DEBUG, "audit_master::Update");

		$sql = "UPDATE audit_master SET ".
				@"pid='$pid'," + 
				@"user_id='$user_id'," + 
				@"approval_status='$approval_status'," + 
				@"comments='$comments'," + 
				@"created_time='$created_time'," + 
				@"modified_time='$modified_time'," + 
				@"ip_address='$ip_address'," + 
				@"type='$type'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "audit_master::Update return: $result");

		return $result;
	}
}
?>
