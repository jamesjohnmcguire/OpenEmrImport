<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a form_soap Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class form_soap
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
	function Delete($id)
	{
		$this->debug->Show(Debug::DEBUG, "form_soap::Delete");

		$query = "DELETE FROM form_soap ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_soap::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = null, $types = null)
	{
		$sql = "SELECT * FROM form_soap";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_soaps = $this->database->GetAll($sql, $values, $types);

		return $form_soaps;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_soap WHERE id = '$id'";

		$form_soapRecord = $this->database->GetRow($sql);

		return $form_soapRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $pid, $user, $groupname, $authorized, $activity,
		$subjective, $objective, $assessment, $plan)
	{
		$this->debug->Show(Debug::DEBUG, "form_soap::Insert");

		$statement = 'INSERT INTO form_soap (date, pid, user, groupname, '.
			'authorized, activity, subjective, objective, assessment, plan) '.
			'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

		$values = array($date, $pid, $user, $groupname, $authorized,
			$activity, $subjective, $objective, $assessment, $plan);

		$types = array('s', 'i', 's', 's', 's', 'i', 'i', 's', 's', 's', 's');

		$result	= $this->database->Insert($statement, $values, $types);
		$this->debug->Show(Debug::DEBUG, "form_soap::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $pid, $user, $groupname, $authorized, $activity, $subjective, $objective, $assessment, $plan)
	{
		$this->debug->Show(Debug::DEBUG, "form_soap::Update");

		$sql = "UPDATE form_soap SET ".
				@"date='$date'," + 
				@"pid='$pid'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'," + 
				@"activity='$activity'," + 
				@"subjective='$subjective'," + 
				@"objective='$objective'," + 
				@"assessment='$assessment'," + 
				@"plan='$plan'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_soap::Update return: $result");

		return $result;
	}
}
?>
