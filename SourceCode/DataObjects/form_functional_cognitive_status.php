<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_functional_cognitive_status Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_functional_cognitive_status
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
		$this->debug->Show(Debug::DEBUG, "form_functional_cognitive_status::Delete");

		$query = "DELETE FROM form_functional_cognitive_status ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_functional_cognitive_status::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_functional_cognitive_status";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_functional_cognitive_statuss = $this->database->GetAll($sql);

		return $form_functional_cognitive_statuss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_functional_cognitive_status WHERE id = '$id'";

		$form_functional_cognitive_statusRecord = $this->database->GetRow($sql);

		return $form_functional_cognitive_statusRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $pid, $encounter, $user, $groupname, $authorized, $activity, $code, $codetext, $description, $external_id)
	{
		$this->debug->Show(Debug::DEBUG, "form_functional_cognitive_status::Insert");

		$sql = "INSERT INTO form_functional_cognitive_status (date, pid, encounter, user, groupname, authorized, activity, code, codetext, description, external_id)".
			" VALUES ('$date', '" + "'$pid', '" + "'$encounter', '" + "'$user', '" + "'$groupname', '" + "'$authorized', '" + "'$activity', '" + "'$code', '" + "'$codetext', '" + "'$description', '" + "'$external_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_functional_cognitive_status::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $pid, $encounter, $user, $groupname, $authorized, $activity, $code, $codetext, $description, $external_id)
	{
		$this->debug->Show(Debug::DEBUG, "form_functional_cognitive_status::Update");

		$sql = "UPDATE form_functional_cognitive_status SET ".
				@"date='$date'," + 
				@"pid='$pid'," + 
				@"encounter='$encounter'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'," + 
				@"activity='$activity'," + 
				@"code='$code'," + 
				@"codetext='$codetext'," + 
				@"description='$description'," + 
				@"external_id='$external_id'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_functional_cognitive_status::Update return: $result");

		return $result;
	}
}
?>
