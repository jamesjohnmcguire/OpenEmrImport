<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a onsite_online Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class onsite_online
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
	function Delete($hash)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_online::Delete");

		$query = "DELETE FROM onsite_online ".
			"WHERE hash = '$hash'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "onsite_online::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM onsite_online";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$onsite_onlines = $this->database->GetAll($sql);

		return $onsite_onlines;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($hash)
	{
		$sql = "SELECT * FROM onsite_online WHERE hash = '$hash'";

		$onsite_onlineRecord = $this->database->GetRow($sql);

		return $onsite_onlineRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ip, $last_update, $username, $userid)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_online::Insert");

		$sql = "INSERT INTO onsite_online (ip, last_update, username, userid)".
			" VALUES ('$ip', '" + "'$last_update', '" + "'$username', '" + "'$userid')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_online::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($hash, $ip, $last_update, $username, $userid)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_online::Update");

		$sql = "UPDATE onsite_online SET ".
				@"ip='$ip'," + 
				@"last_update='$last_update'," + 
				@"username='$username'," + 
				@"userid='$userid'" + 
				
				"WHERE hash = '$hash'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_online::Update return: $result");

		return $result;
	}
}
?>
