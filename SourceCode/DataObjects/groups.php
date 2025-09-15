<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a groups Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class groups
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
		$this->debug->Show(Debug::DEBUG, "groups::Delete");

		$query = "DELETE FROM groups ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "groups::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM groups";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$groupss = $this->database->GetAll($sql);

		return $groupss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM groups WHERE id = '$id'";

		$groupsRecord = $this->database->GetRow($sql);

		return $groupsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($name, $user)
	{
		$this->debug->Show(Debug::DEBUG, "groups::Insert");

		$sql = "INSERT INTO groups (name, user)".
			" VALUES ('$name', '" + "'$user')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "groups::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $name, $user)
	{
		$this->debug->Show(Debug::DEBUG, "groups::Update");

		$sql = "UPDATE groups SET ".
				@"name='$name'," + 
				@"user='$user'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "groups::Update return: $result");

		return $result;
	}
}
?>
