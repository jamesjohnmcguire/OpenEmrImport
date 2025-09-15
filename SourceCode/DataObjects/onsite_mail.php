<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a onsite_mail Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class onsite_mail
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
		$this->debug->Show(Debug::DEBUG, "onsite_mail::Delete");

		$query = "DELETE FROM onsite_mail ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "onsite_mail::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM onsite_mail";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$onsite_mails = $this->database->GetAll($sql);

		return $onsite_mails;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM onsite_mail WHERE id = '$id'";

		$onsite_mailRecord = $this->database->GetRow($sql);

		return $onsite_mailRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $owner, $user, $groupname, $activity, $authorized, $header, $title, $body, $recipient_id, $recipient_name, $sender_id, $sender_name, $assigned_to, $deleted, $delete_date, $mtype, $message_status, $mail_chain, $reply_mail_chain, $is_msg_encrypted)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_mail::Insert");

		$sql = "INSERT INTO onsite_mail (date, owner, user, groupname, activity, authorized, header, title, body, recipient_id, recipient_name, sender_id, sender_name, assigned_to, deleted, delete_date, mtype, message_status, mail_chain, reply_mail_chain, is_msg_encrypted)".
			" VALUES ('$date', '" + "'$owner', '" + "'$user', '" + "'$groupname', '" + "'$activity', '" + "'$authorized', '" + "'$header', '" + "'$title', '" + "'$body', '" + "'$recipient_id', '" + "'$recipient_name', '" + "'$sender_id', '" + "'$sender_name', '" + "'$assigned_to', '" + "'$deleted', '" + "'$delete_date', '" + "'$mtype', '" + "'$message_status', '" + "'$mail_chain', '" + "'$reply_mail_chain', '" + "'$is_msg_encrypted')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_mail::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $owner, $user, $groupname, $activity, $authorized, $header, $title, $body, $recipient_id, $recipient_name, $sender_id, $sender_name, $assigned_to, $deleted, $delete_date, $mtype, $message_status, $mail_chain, $reply_mail_chain, $is_msg_encrypted)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_mail::Update");

		$sql = "UPDATE onsite_mail SET ".
				@"date='$date'," + 
				@"owner='$owner'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"activity='$activity'," + 
				@"authorized='$authorized'," + 
				@"header='$header'," + 
				@"title='$title'," + 
				@"body='$body'," + 
				@"recipient_id='$recipient_id'," + 
				@"recipient_name='$recipient_name'," + 
				@"sender_id='$sender_id'," + 
				@"sender_name='$sender_name'," + 
				@"assigned_to='$assigned_to'," + 
				@"deleted='$deleted'," + 
				@"delete_date='$delete_date'," + 
				@"mtype='$mtype'," + 
				@"message_status='$message_status'," + 
				@"mail_chain='$mail_chain'," + 
				@"reply_mail_chain='$reply_mail_chain'," + 
				@"is_msg_encrypted='$is_msg_encrypted'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_mail::Update return: $result");

		return $result;
	}
}
?>
