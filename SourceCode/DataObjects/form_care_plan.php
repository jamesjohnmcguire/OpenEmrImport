<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_care_plan Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_care_plan
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
		$this->debug->Show(Debug::DEBUG, "form_care_plan::Delete");

		$query = "DELETE FROM form_care_plan ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_care_plan::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_care_plan";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_care_plans = $this->database->GetAll($sql);

		return $form_care_plans;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_care_plan WHERE id = '$id'";

		$form_care_planRecord = $this->database->GetRow($sql);

		return $form_care_planRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $pid, $encounter, $user, $groupname, $authorized, $activity, $code, $codetext, $description, $external_id, $care_plan_type)
	{
		$this->debug->Show(Debug::DEBUG, "form_care_plan::Insert");

		$sql = "INSERT INTO form_care_plan (date, pid, encounter, user, groupname, authorized, activity, code, codetext, description, external_id, care_plan_type)".
			" VALUES ('$date', '" + "'$pid', '" + "'$encounter', '" + "'$user', '" + "'$groupname', '" + "'$authorized', '" + "'$activity', '" + "'$code', '" + "'$codetext', '" + "'$description', '" + "'$external_id', '" + "'$care_plan_type')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_care_plan::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $pid, $encounter, $user, $groupname, $authorized, $activity, $code, $codetext, $description, $external_id, $care_plan_type)
	{
		$this->debug->Show(Debug::DEBUG, "form_care_plan::Update");

		$sql = "UPDATE form_care_plan SET ".
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
				@"external_id='$external_id'," + 
				@"care_plan_type='$care_plan_type'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_care_plan::Update return: $result");

		return $result;
	}
}
?>
