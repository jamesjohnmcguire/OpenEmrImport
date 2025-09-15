<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a openemr_postcalendar_limits Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class openemr_postcalendar_limits
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
	function Delete($pc_limitid)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_limits::Delete");

		$query = "DELETE FROM openemr_postcalendar_limits ".
			"WHERE pc_limitid = '$pc_limitid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_limits::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM openemr_postcalendar_limits";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$openemr_postcalendar_limitss = $this->database->GetAll($sql);

		return $openemr_postcalendar_limitss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pc_limitid)
	{
		$sql = "SELECT * FROM openemr_postcalendar_limits WHERE pc_limitid = '$pc_limitid'";

		$openemr_postcalendar_limitsRecord = $this->database->GetRow($sql);

		return $openemr_postcalendar_limitsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pc_catid, $pc_starttime, $pc_endtime, $pc_limit)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_limits::Insert");

		$sql = "INSERT INTO openemr_postcalendar_limits (pc_catid, pc_starttime, pc_endtime, pc_limit)".
			" VALUES ('$pc_catid', '" + "'$pc_starttime', '" + "'$pc_endtime', '" + "'$pc_limit')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_limits::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pc_limitid, $pc_catid, $pc_starttime, $pc_endtime, $pc_limit)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_limits::Update");

		$sql = "UPDATE openemr_postcalendar_limits SET ".
				@"pc_catid='$pc_catid'," + 
				@"pc_starttime='$pc_starttime'," + 
				@"pc_endtime='$pc_endtime'," + 
				@"pc_limit='$pc_limit'" + 
				
				"WHERE pc_limitid = '$pc_limitid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_limits::Update return: $result");

		return $result;
	}
}
?>
