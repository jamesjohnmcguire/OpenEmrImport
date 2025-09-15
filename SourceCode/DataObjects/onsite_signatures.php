<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a onsite_signatures Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class onsite_signatures
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
		$this->debug->Show(Debug::DEBUG, "onsite_signatures::Delete");

		$query = "DELETE FROM onsite_signatures ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "onsite_signatures::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM onsite_signatures";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$onsite_signaturess = $this->database->GetAll($sql);

		return $onsite_signaturess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM onsite_signatures WHERE id = '$id'";

		$onsite_signaturesRecord = $this->database->GetRow($sql);

		return $onsite_signaturesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($status, $type, $created, $lastmod, $pid, $encounter, $user, $activity, $authorized, $signator, $sig_image, $signature, $sig_hash, $ip)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_signatures::Insert");

		$sql = "INSERT INTO onsite_signatures (status, type, created, lastmod, pid, encounter, user, activity, authorized, signator, sig_image, signature, sig_hash, ip)".
			" VALUES ('$status', '" + "'$type', '" + "'$created', '" + "'$lastmod', '" + "'$pid', '" + "'$encounter', '" + "'$user', '" + "'$activity', '" + "'$authorized', '" + "'$signator', '" + "'$sig_image', '" + "'$signature', '" + "'$sig_hash', '" + "'$ip')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_signatures::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $status, $type, $created, $lastmod, $pid, $encounter, $user, $activity, $authorized, $signator, $sig_image, $signature, $sig_hash, $ip)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_signatures::Update");

		$sql = "UPDATE onsite_signatures SET ".
				@"status='$status'," + 
				@"type='$type'," + 
				@"created='$created'," + 
				@"lastmod='$lastmod'," + 
				@"pid='$pid'," + 
				@"encounter='$encounter'," + 
				@"user='$user'," + 
				@"activity='$activity'," + 
				@"authorized='$authorized'," + 
				@"signator='$signator'," + 
				@"sig_image='$sig_image'," + 
				@"signature='$signature'," + 
				@"sig_hash='$sig_hash'," + 
				@"ip='$ip'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_signatures::Update return: $result");

		return $result;
	}
}
?>
