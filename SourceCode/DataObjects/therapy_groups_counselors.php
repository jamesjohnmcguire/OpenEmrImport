<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a therapy_groups_counselors Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class therapy_groups_counselors
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
		$this->debug->Show(Debug::DEBUG, "therapy_groups_counselors::Delete");

		$query = "DELETE FROM therapy_groups_counselors ".
			"WHERE group_id = '$group_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "therapy_groups_counselors::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM therapy_groups_counselors";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$therapy_groups_counselorss = $this->database->GetAll($sql);

		return $therapy_groups_counselorss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($group_id)
	{
		$sql = "SELECT * FROM therapy_groups_counselors WHERE group_id = '$group_id'";

		$therapy_groups_counselorsRecord = $this->database->GetRow($sql);

		return $therapy_groups_counselorsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($user_id)
	{
		$this->debug->Show(Debug::DEBUG, "therapy_groups_counselors::Insert");

		$sql = "INSERT INTO therapy_groups_counselors (user_id)".
			" VALUES ('$user_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "therapy_groups_counselors::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($group_id, $user_id)
	{
		$this->debug->Show(Debug::DEBUG, "therapy_groups_counselors::Update");

		$sql = "UPDATE therapy_groups_counselors SET ".
				@"user_id='$user_id'" + 
				
				"WHERE group_id = '$group_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "therapy_groups_counselors::Update return: $result");

		return $result;
	}
}
?>
