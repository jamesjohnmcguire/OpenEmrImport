<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a log Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class log
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
		$this->debug->Show(Debug::DEBUG, "log::Delete");

		$query = "DELETE FROM log ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "log::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM log";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$logs = $this->database->GetAll($sql);

		return $logs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM log WHERE id = '$id'";

		$logRecord = $this->database->GetRow($sql);

		return $logRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $event, $category, $user, $groupname, $comments, $user_notes, $patient_id, $success, $checksum, $crt_user, $log_from, $menu_item_id, $ccda_doc_id)
	{
		$this->debug->Show(Debug::DEBUG, "log::Insert");

		$sql = "INSERT INTO log (date, event, category, user, groupname, comments, user_notes, patient_id, success, checksum, crt_user, log_from, menu_item_id, ccda_doc_id)".
			" VALUES ('$date', '" + "'$event', '" + "'$category', '" + "'$user', '" + "'$groupname', '" + "'$comments', '" + "'$user_notes', '" + "'$patient_id', '" + "'$success', '" + "'$checksum', '" + "'$crt_user', '" + "'$log_from', '" + "'$menu_item_id', '" + "'$ccda_doc_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "log::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $event, $category, $user, $groupname, $comments, $user_notes, $patient_id, $success, $checksum, $crt_user, $log_from, $menu_item_id, $ccda_doc_id)
	{
		$this->debug->Show(Debug::DEBUG, "log::Update");

		$sql = "UPDATE log SET ".
				@"date='$date'," + 
				@"event='$event'," + 
				@"category='$category'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"comments='$comments'," + 
				@"user_notes='$user_notes'," + 
				@"patient_id='$patient_id'," + 
				@"success='$success'," + 
				@"checksum='$checksum'," + 
				@"crt_user='$crt_user'," + 
				@"log_from='$log_from'," + 
				@"menu_item_id='$menu_item_id'," + 
				@"ccda_doc_id='$ccda_doc_id'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "log::Update return: $result");

		return $result;
	}
}
?>
