<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a pnotes Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class pnotes
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
		$this->debug->Show(Debug::DEBUG, "pnotes::Delete");

		$query = "DELETE FROM pnotes ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "pnotes::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM pnotes";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$pnotess = $this->database->GetAll($sql);

		return $pnotess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM pnotes WHERE id = '$id'";

		$pnotesRecord = $this->database->GetRow($sql);

		return $pnotesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $body, $pid, $user, $groupname, $activity,
		$authorized, $title, $assigned_to, $deleted, $message_status,
		$portal_relation, $is_msg_encrypted)
	{
		$this->debug->Show(Debug::DEBUG, "pnotes::Insert");

		$sql = 'INSERT INTO pnotes (date, body, pid, user, groupname, '.
			'activity, authorized, title, assigned_to, deleted, '.
			'message_status, portal_relation, is_msg_encrypted) VALUES '.
			'(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

		$values = array($date, $body, $pid, $user, $groupname, $activity,
			$authorized, $title, $assigned_to, $deleted, $message_status,
			$portal_relation, $is_msg_encrypted);

		$types = array(
			's', 's', 'i', 's', 's', 'i', 'i', 's', 's', 'i', 's', 's', 'i');

		$result	= $this->database->Insert($sql, $values, $types);
		$this->debug->Show(Debug::DEBUG, "pnotes::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $body, $pid, $user, $groupname, $activity, $authorized, $title, $assigned_to, $deleted, $message_status, $portal_relation, $is_msg_encrypted)
	{
		$this->debug->Show(Debug::DEBUG, "pnotes::Update");

		$sql = "UPDATE pnotes SET ".
				@"date='$date'," + 
				@"body='$body'," + 
				@"pid='$pid'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"activity='$activity'," + 
				@"authorized='$authorized'," + 
				@"title='$title'," + 
				@"assigned_to='$assigned_to'," + 
				@"deleted='$deleted'," + 
				@"message_status='$message_status'," + 
				@"portal_relation='$portal_relation'," + 
				@"is_msg_encrypted='$is_msg_encrypted'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "pnotes::Update return: $result");

		return $result;
	}
}
?>
