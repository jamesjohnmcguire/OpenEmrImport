<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_dictation Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_dictation
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
		$this->debug->Show(Debug::DEBUG, "form_dictation::Delete");

		$query = "DELETE FROM form_dictation ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_dictation::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_dictation";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_dictations = $this->database->GetAll($sql);

		return $form_dictations;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_dictation WHERE id = '$id'";

		$form_dictationRecord = $this->database->GetRow($sql);

		return $form_dictationRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $pid, $user, $groupname, $authorized, $activity, $dictation, $additional_notes)
	{
		$this->debug->Show(Debug::DEBUG, "form_dictation::Insert");

		$sql = "INSERT INTO form_dictation (date, pid, user, groupname, authorized, activity, dictation, additional_notes)".
			" VALUES ('$date', '" + "'$pid', '" + "'$user', '" + "'$groupname', '" + "'$authorized', '" + "'$activity', '" + "'$dictation', '" + "'$additional_notes')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_dictation::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $pid, $user, $groupname, $authorized, $activity, $dictation, $additional_notes)
	{
		$this->debug->Show(Debug::DEBUG, "form_dictation::Update");

		$sql = "UPDATE form_dictation SET ".
				@"date='$date'," + 
				@"pid='$pid'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'," + 
				@"activity='$activity'," + 
				@"dictation='$dictation'," + 
				@"additional_notes='$additional_notes'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_dictation::Update return: $result");

		return $result;
	}
}
?>
