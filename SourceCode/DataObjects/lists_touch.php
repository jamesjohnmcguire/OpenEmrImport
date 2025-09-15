<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a lists_touch Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class lists_touch
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
		$this->debug->Show(Debug::DEBUG, "lists_touch::Delete");

		$query = "DELETE FROM lists_touch ".
			"WHERE pid = '$pid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "lists_touch::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM lists_touch";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$lists_touchs = $this->database->GetAll($sql);

		return $lists_touchs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pid)
	{
		$sql = "SELECT * FROM lists_touch WHERE pid = '$pid'";

		$lists_touchRecord = $this->database->GetRow($sql);

		return $lists_touchRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($type, $date)
	{
		$this->debug->Show(Debug::DEBUG, "lists_touch::Insert");

		$sql = "INSERT INTO lists_touch (type, date)".
			" VALUES ('$type', '" + "'$date')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "lists_touch::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pid, $type, $date)
	{
		$this->debug->Show(Debug::DEBUG, "lists_touch::Update");

		$sql = "UPDATE lists_touch SET ".
				@"type='$type'," + 
				@"date='$date'" + 
				
				"WHERE pid = '$pid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "lists_touch::Update return: $result");

		return $result;
	}
}
?>
