<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a log_comment_encrypt Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class log_comment_encrypt
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
		$this->debug->Show(Debug::DEBUG, "log_comment_encrypt::Delete");

		$query = "DELETE FROM log_comment_encrypt ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "log_comment_encrypt::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM log_comment_encrypt";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$log_comment_encrypts = $this->database->GetAll($sql);

		return $log_comment_encrypts;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM log_comment_encrypt WHERE id = '$id'";

		$log_comment_encryptRecord = $this->database->GetRow($sql);

		return $log_comment_encryptRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($log_id, $encrypt, $checksum, $version)
	{
		$this->debug->Show(Debug::DEBUG, "log_comment_encrypt::Insert");

		$sql = "INSERT INTO log_comment_encrypt (log_id, encrypt, checksum, version)".
			" VALUES ('$log_id', '" + "'$encrypt', '" + "'$checksum', '" + "'$version')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "log_comment_encrypt::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $log_id, $encrypt, $checksum, $version)
	{
		$this->debug->Show(Debug::DEBUG, "log_comment_encrypt::Update");

		$sql = "UPDATE log_comment_encrypt SET ".
				@"log_id='$log_id'," + 
				@"encrypt='$encrypt'," + 
				@"checksum='$checksum'," + 
				@"version='$version'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "log_comment_encrypt::Update return: $result");

		return $result;
	}
}
?>
