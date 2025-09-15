<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a esign_signatures Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class esign_signatures
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
		$this->debug->Show(Debug::DEBUG, "esign_signatures::Delete");

		$query = "DELETE FROM esign_signatures ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "esign_signatures::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM esign_signatures";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$esign_signaturess = $this->database->GetAll($sql);

		return $esign_signaturess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM esign_signatures WHERE id = '$id'";

		$esign_signaturesRecord = $this->database->GetRow($sql);

		return $esign_signaturesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($tid, $table, $uid, $datetime, $is_lock, $amendment, $hash, $signature_hash)
	{
		$this->debug->Show(Debug::DEBUG, "esign_signatures::Insert");

		$sql = "INSERT INTO esign_signatures (tid, table, uid, datetime, is_lock, amendment, hash, signature_hash)".
			" VALUES ('$tid', '" + "'$table', '" + "'$uid', '" + "'$datetime', '" + "'$is_lock', '" + "'$amendment', '" + "'$hash', '" + "'$signature_hash')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "esign_signatures::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $tid, $table, $uid, $datetime, $is_lock, $amendment, $hash, $signature_hash)
	{
		$this->debug->Show(Debug::DEBUG, "esign_signatures::Update");

		$sql = "UPDATE esign_signatures SET ".
				@"tid='$tid'," + 
				@"table='$table'," + 
				@"uid='$uid'," + 
				@"datetime='$datetime'," + 
				@"is_lock='$is_lock'," + 
				@"amendment='$amendment'," + 
				@"hash='$hash'," + 
				@"signature_hash='$signature_hash'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "esign_signatures::Update return: $result");

		return $result;
	}
}
?>
