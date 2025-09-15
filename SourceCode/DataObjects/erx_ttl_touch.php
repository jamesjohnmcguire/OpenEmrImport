<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a erx_ttl_touch Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class erx_ttl_touch
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
	function Delete($patient_id)
	{
		$this->debug->Show(Debug::DEBUG, "erx_ttl_touch::Delete");

		$query = "DELETE FROM erx_ttl_touch ".
			"WHERE patient_id = '$patient_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "erx_ttl_touch::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM erx_ttl_touch";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$erx_ttl_touchs = $this->database->GetAll($sql);

		return $erx_ttl_touchs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($patient_id)
	{
		$sql = "SELECT * FROM erx_ttl_touch WHERE patient_id = '$patient_id'";

		$erx_ttl_touchRecord = $this->database->GetRow($sql);

		return $erx_ttl_touchRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($process, $updated)
	{
		$this->debug->Show(Debug::DEBUG, "erx_ttl_touch::Insert");

		$sql = "INSERT INTO erx_ttl_touch (process, updated)".
			" VALUES ('$process', '" + "'$updated')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "erx_ttl_touch::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($patient_id, $process, $updated)
	{
		$this->debug->Show(Debug::DEBUG, "erx_ttl_touch::Update");

		$sql = "UPDATE erx_ttl_touch SET ".
				@"process='$process'," + 
				@"updated='$updated'" + 
				
				"WHERE patient_id = '$patient_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "erx_ttl_touch::Update return: $result");

		return $result;
	}
}
?>
