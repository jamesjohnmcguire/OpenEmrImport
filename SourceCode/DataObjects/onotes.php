<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a onotes Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class onotes
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
		$this->debug->Show(Debug::DEBUG, "onotes::Delete");

		$query = "DELETE FROM onotes ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "onotes::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM onotes";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$onotess = $this->database->GetAll($sql);

		return $onotess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM onotes WHERE id = '$id'";

		$onotesRecord = $this->database->GetRow($sql);

		return $onotesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $body, $user, $groupname, $activity)
	{
		$this->debug->Show(Debug::DEBUG, "onotes::Insert");

		$sql = "INSERT INTO onotes (date, body, user, groupname, activity)".
			" VALUES ('$date', '" + "'$body', '" + "'$user', '" + "'$groupname', '" + "'$activity')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "onotes::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $body, $user, $groupname, $activity)
	{
		$this->debug->Show(Debug::DEBUG, "onotes::Update");

		$sql = "UPDATE onotes SET ".
				@"date='$date'," + 
				@"body='$body'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"activity='$activity'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "onotes::Update return: $result");

		return $result;
	}
}
?>
