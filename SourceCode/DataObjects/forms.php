<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a forms Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class forms
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
		$this->debug->Show(Debug::DEBUG, "forms::Delete");

		$query = "DELETE FROM forms ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "forms::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM forms";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$formss = $this->database->GetAll($sql);

		return $formss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM forms WHERE id = '$id'";

		$formsRecord = $this->database->GetRow($sql);

		return $formsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $encounter, $form_name, $form_id, $pid, $user, $groupname, $authorized, $deleted, $formdir, $therapy_group_id, $issue_id, $provider_id)
	{
		$this->debug->Show(Debug::DEBUG, "forms::Insert");

		$sql = "INSERT INTO forms (date, encounter, form_name, form_id, pid, user, groupname, authorized, deleted, formdir, therapy_group_id, issue_id, provider_id)".
			" VALUES ('$date', '" + "'$encounter', '" + "'$form_name', '" + "'$form_id', '" + "'$pid', '" + "'$user', '" + "'$groupname', '" + "'$authorized', '" + "'$deleted', '" + "'$formdir', '" + "'$therapy_group_id', '" + "'$issue_id', '" + "'$provider_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "forms::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $encounter, $form_name, $form_id, $pid, $user, $groupname, $authorized, $deleted, $formdir, $therapy_group_id, $issue_id, $provider_id)
	{
		$this->debug->Show(Debug::DEBUG, "forms::Update");

		$sql = "UPDATE forms SET ".
				@"date='$date'," + 
				@"encounter='$encounter'," + 
				@"form_name='$form_name'," + 
				@"form_id='$form_id'," + 
				@"pid='$pid'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'," + 
				@"deleted='$deleted'," + 
				@"formdir='$formdir'," + 
				@"therapy_group_id='$therapy_group_id'," + 
				@"issue_id='$issue_id'," + 
				@"provider_id='$provider_id'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "forms::Update return: $result");

		return $result;
	}
}
?>
