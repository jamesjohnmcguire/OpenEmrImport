<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a calendar_external Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class calendar_external
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
		$this->debug->Show(Debug::DEBUG, "calendar_external::Delete");

		$query = "DELETE FROM calendar_external ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "calendar_external::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM calendar_external";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$calendar_externals = $this->database->GetAll($sql);

		return $calendar_externals;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM calendar_external WHERE id = '$id'";

		$calendar_externalRecord = $this->database->GetRow($sql);

		return $calendar_externalRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $description, $source)
	{
		$this->debug->Show(Debug::DEBUG, "calendar_external::Insert");

		$sql = "INSERT INTO calendar_external (date, description, source)".
			" VALUES ('$date', '" + "'$description', '" + "'$source')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "calendar_external::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $description, $source)
	{
		$this->debug->Show(Debug::DEBUG, "calendar_external::Update");

		$sql = "UPDATE calendar_external SET ".
				@"date='$date'," + 
				@"description='$description'," + 
				@"source='$source'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "calendar_external::Update return: $result");

		return $result;
	}
}
?>
