<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a issue_encounter Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class issue_encounter
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
	function Delete($pid)
	{
		$this->debug->Show(Debug::DEBUG, "issue_encounter::Delete");

		$query = "DELETE FROM issue_encounter ".
			"WHERE pid = '$pid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "issue_encounter::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM issue_encounter";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$issue_encounters = $this->database->GetAll($sql);

		return $issue_encounters;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pid)
	{
		$sql = "SELECT * FROM issue_encounter WHERE pid = '$pid'";

		$issue_encounterRecord = $this->database->GetRow($sql);

		return $issue_encounterRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($list_id, $encounter, $resolved)
	{
		$this->debug->Show(Debug::DEBUG, "issue_encounter::Insert");

		$sql = "INSERT INTO issue_encounter (list_id, encounter, resolved)".
			" VALUES ('$list_id', '" + "'$encounter', '" + "'$resolved')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "issue_encounter::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pid, $list_id, $encounter, $resolved)
	{
		$this->debug->Show(Debug::DEBUG, "issue_encounter::Update");

		$sql = "UPDATE issue_encounter SET ".
				@"list_id='$list_id'," + 
				@"encounter='$encounter'," + 
				@"resolved='$resolved'" + 
				
				"WHERE pid = '$pid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "issue_encounter::Update return: $result");

		return $result;
	}
}
?>
