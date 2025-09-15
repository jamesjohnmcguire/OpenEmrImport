<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a openemr_postcalendar_topics Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class openemr_postcalendar_topics
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
	function Delete($pc_catid)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_topics::Delete");

		$query = "DELETE FROM openemr_postcalendar_topics ".
			"WHERE pc_catid = '$pc_catid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_topics::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM openemr_postcalendar_topics";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$openemr_postcalendar_topicss = $this->database->GetAll($sql);

		return $openemr_postcalendar_topicss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pc_catid)
	{
		$sql = "SELECT * FROM openemr_postcalendar_topics WHERE pc_catid = '$pc_catid'";

		$openemr_postcalendar_topicsRecord = $this->database->GetRow($sql);

		return $openemr_postcalendar_topicsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pc_catname, $pc_catcolor, $pc_catdesc)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_topics::Insert");

		$sql = "INSERT INTO openemr_postcalendar_topics (pc_catname, pc_catcolor, pc_catdesc)".
			" VALUES ('$pc_catname', '" + "'$pc_catcolor', '" + "'$pc_catdesc')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_topics::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pc_catid, $pc_catname, $pc_catcolor, $pc_catdesc)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_topics::Update");

		$sql = "UPDATE openemr_postcalendar_topics SET ".
				@"pc_catname='$pc_catname'," + 
				@"pc_catcolor='$pc_catcolor'," + 
				@"pc_catdesc='$pc_catdesc'" + 
				
				"WHERE pc_catid = '$pc_catid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_topics::Update return: $result");

		return $result;
	}
}
?>
