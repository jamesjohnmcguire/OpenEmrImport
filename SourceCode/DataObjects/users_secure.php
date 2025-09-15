<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a users_secure Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class users_secure
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
		$this->debug->Show(Debug::DEBUG, "users_secure::Delete");

		$query = "DELETE FROM users_secure ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "users_secure::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM users_secure";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$users_secures = $this->database->GetAll($sql);

		return $users_secures;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM users_secure WHERE id = '$id'";

		$users_secureRecord = $this->database->GetRow($sql);

		return $users_secureRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($username, $password, $salt, $last_update, $password_history1, $salt_history1, $password_history2, $salt_history2)
	{
		$this->debug->Show(Debug::DEBUG, "users_secure::Insert");

		$sql = "INSERT INTO users_secure (username, password, salt, last_update, password_history1, salt_history1, password_history2, salt_history2)".
			" VALUES ('$username', '" + "'$password', '" + "'$salt', '" + "'$last_update', '" + "'$password_history1', '" + "'$salt_history1', '" + "'$password_history2', '" + "'$salt_history2')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "users_secure::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $username, $password, $salt, $last_update, $password_history1, $salt_history1, $password_history2, $salt_history2)
	{
		$this->debug->Show(Debug::DEBUG, "users_secure::Update");

		$sql = "UPDATE users_secure SET ".
				@"username='$username'," + 
				@"password='$password'," + 
				@"salt='$salt'," + 
				@"last_update='$last_update'," + 
				@"password_history1='$password_history1'," + 
				@"salt_history1='$salt_history1'," + 
				@"password_history2='$password_history2'," + 
				@"salt_history2='$salt_history2'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "users_secure::Update return: $result");

		return $result;
	}
}
?>
