<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a multiple_db Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class multiple_db
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
		$this->debug->Show(Debug::DEBUG, "multiple_db::Delete");

		$query = "DELETE FROM multiple_db ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "multiple_db::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM multiple_db";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$multiple_dbs = $this->database->GetAll($sql);

		return $multiple_dbs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM multiple_db WHERE id = '$id'";

		$multiple_dbRecord = $this->database->GetRow($sql);

		return $multiple_dbRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($namespace, $username, $password, $dbname, $host, $port, $date)
	{
		$this->debug->Show(Debug::DEBUG, "multiple_db::Insert");

		$sql = "INSERT INTO multiple_db (namespace, username, password, dbname, host, port, date)".
			" VALUES ('$namespace', '" + "'$username', '" + "'$password', '" + "'$dbname', '" + "'$host', '" + "'$port', '" + "'$date')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "multiple_db::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $namespace, $username, $password, $dbname, $host, $port, $date)
	{
		$this->debug->Show(Debug::DEBUG, "multiple_db::Update");

		$sql = "UPDATE multiple_db SET ".
				@"namespace='$namespace'," + 
				@"username='$username'," + 
				@"password='$password'," + 
				@"dbname='$dbname'," + 
				@"host='$host'," + 
				@"port='$port'," + 
				@"date='$date'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "multiple_db::Update return: $result");

		return $result;
	}
}
?>
