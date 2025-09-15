<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a chart_tracker Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class chart_tracker
{
	var	$database;
	var $debug;
	var $lastQuery;

	/////////////////////////////////////////////////////////////////////////
	// constructor
	/////////////////////////////////////////////////////////////////////////
	function __construct($database, $debug, &$lastQuery)
	{
		$this->database	= $database;
		$this->debug = $debug;
		$this->lastQuery = & $lastQuery;
	}

	/////////////////////////////////////////////////////////////////////////
	// Delete
	/////////////////////////////////////////////////////////////////////////
	function Delete($ct_pid)
	{
		$this->debug->Show(Debug::DEBUG, "chart_tracker::Delete");

		$query = "DELETE FROM chart_tracker ".
			"WHERE ct_pid = '$ct_pid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "chart_tracker::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = null, $types = null)
	{
		$sql = "SELECT * FROM chart_tracker";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$chart_trackers = $this->database->GetAll($sql, $values, $types);

		return $chart_trackers;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($ct_pid)
	{
		$sql = "SELECT * FROM chart_tracker WHERE ct_pid = '$ct_pid'";

		$chart_trackerRecord = $this->database->GetRow($sql);

		return $chart_trackerRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ct_pid, $ct_when, $ct_userid, $ct_location)
	{
		$this->debug->Show(Debug::DEBUG, "chart_tracker::Insert");

		$sql = 'INSERT INTO chart_tracker (ct_pid, ct_when, ct_userid, '.
			'ct_location) VALUES (?, ?, ?, ?)';

		$values = array($ct_pid, $ct_when, $ct_userid, $ct_location);
		$types = array('i', 's', 'i', 's');

		$result	= $this->database->Insert($sql, $values, $types);
		$this->debug->Show(
			Debug::DEBUG, "chart_tracker::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($ct_pid, $ct_when, $ct_userid, $ct_location)
	{
		$this->debug->Show(Debug::DEBUG, "chart_tracker::Update");

		$sql = "UPDATE chart_tracker SET ".
				@"ct_when='$ct_when'," + 
				@"ct_userid='$ct_userid'," + 
				@"ct_location='$ct_location'" + 
				
				"WHERE ct_pid = '$ct_pid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "chart_tracker::Update return: $result");

		return $result;
	}
}
?>
