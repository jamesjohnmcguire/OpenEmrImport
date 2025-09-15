<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a medex_recalls Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class medex_recalls
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
	function Delete($r_ID)
	{
		$this->debug->Show(Debug::DEBUG, "medex_recalls::Delete");

		$query = "DELETE FROM medex_recalls ".
			"WHERE r_ID = '$r_ID'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "medex_recalls::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM medex_recalls";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$medex_recallss = $this->database->GetAll($sql);

		return $medex_recallss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($r_ID)
	{
		$sql = "SELECT * FROM medex_recalls WHERE r_ID = '$r_ID'";

		$medex_recallsRecord = $this->database->GetRow($sql);

		return $medex_recallsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($r_PRACTID, $r_pid, $r_eventDate, $r_facility, $r_provider, $r_reason, $r_created)
	{
		$this->debug->Show(Debug::DEBUG, "medex_recalls::Insert");

		$sql = "INSERT INTO medex_recalls (r_PRACTID, r_pid, r_eventDate, r_facility, r_provider, r_reason, r_created)".
			" VALUES ('$r_PRACTID', '" + "'$r_pid', '" + "'$r_eventDate', '" + "'$r_facility', '" + "'$r_provider', '" + "'$r_reason', '" + "'$r_created')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "medex_recalls::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($r_ID, $r_PRACTID, $r_pid, $r_eventDate, $r_facility, $r_provider, $r_reason, $r_created)
	{
		$this->debug->Show(Debug::DEBUG, "medex_recalls::Update");

		$sql = "UPDATE medex_recalls SET ".
				@"r_PRACTID='$r_PRACTID'," + 
				@"r_pid='$r_pid'," + 
				@"r_eventDate='$r_eventDate'," + 
				@"r_facility='$r_facility'," + 
				@"r_provider='$r_provider'," + 
				@"r_reason='$r_reason'," + 
				@"r_created='$r_created'" + 
				
				"WHERE r_ID = '$r_ID'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "medex_recalls::Update return: $result");

		return $result;
	}
}
?>
