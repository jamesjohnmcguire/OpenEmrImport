<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a onsite_messages Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class onsite_messages
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
		$this->debug->Show(Debug::DEBUG, "onsite_messages::Delete");

		$query = "DELETE FROM onsite_messages ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "onsite_messages::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM onsite_messages";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$onsite_messagess = $this->database->GetAll($sql);

		return $onsite_messagess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM onsite_messages WHERE id = '$id'";

		$onsite_messagesRecord = $this->database->GetRow($sql);

		return $onsite_messagesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($username, $message, $ip, $date, $sender_id, $recip_id)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_messages::Insert");

		$sql = "INSERT INTO onsite_messages (username, message, ip, date, sender_id, recip_id)".
			" VALUES ('$username', '" + "'$message', '" + "'$ip', '" + "'$date', '" + "'$sender_id', '" + "'$recip_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_messages::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $username, $message, $ip, $date, $sender_id, $recip_id)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_messages::Update");

		$sql = "UPDATE onsite_messages SET ".
				@"username='$username'," + 
				@"message='$message'," + 
				@"ip='$ip'," + 
				@"date='$date'," + 
				@"sender_id='$sender_id'," + 
				@"recip_id='$recip_id'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_messages::Update return: $result");

		return $result;
	}
}
?>
