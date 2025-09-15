<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a amendments Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class amendments
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
	function Delete($amendment_id)
	{
		$this->debug->Show(Debug::DEBUG, "amendments::Delete");

		$query = "DELETE FROM amendments ".
			"WHERE amendment_id = '$amendment_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "amendments::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM amendments";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$amendmentss = $this->database->GetAll($sql);

		return $amendmentss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($amendment_id)
	{
		$sql = "SELECT * FROM amendments WHERE amendment_id = '$amendment_id'";

		$amendmentsRecord = $this->database->GetRow($sql);

		return $amendmentsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($amendment_date, $amendment_by, $amendment_status, $pid, $amendment_desc, $created_by, $modified_by, $created_time, $modified_time)
	{
		$this->debug->Show(Debug::DEBUG, "amendments::Insert");

		$sql = "INSERT INTO amendments (amendment_date, amendment_by, amendment_status, pid, amendment_desc, created_by, modified_by, created_time, modified_time)".
			" VALUES ('$amendment_date', '" + "'$amendment_by', '" + "'$amendment_status', '" + "'$pid', '" + "'$amendment_desc', '" + "'$created_by', '" + "'$modified_by', '" + "'$created_time', '" + "'$modified_time')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "amendments::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($amendment_id, $amendment_date, $amendment_by, $amendment_status, $pid, $amendment_desc, $created_by, $modified_by, $created_time, $modified_time)
	{
		$this->debug->Show(Debug::DEBUG, "amendments::Update");

		$sql = "UPDATE amendments SET ".
				@"amendment_date='$amendment_date'," + 
				@"amendment_by='$amendment_by'," + 
				@"amendment_status='$amendment_status'," + 
				@"pid='$pid'," + 
				@"amendment_desc='$amendment_desc'," + 
				@"created_by='$created_by'," + 
				@"modified_by='$modified_by'," + 
				@"created_time='$created_time'," + 
				@"modified_time='$modified_time'" + 
				
				"WHERE amendment_id = '$amendment_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "amendments::Update return: $result");

		return $result;
	}
}
?>
