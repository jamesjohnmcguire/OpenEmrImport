<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a transactions Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class transactions
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
		$this->debug->Show(Debug::DEBUG, "transactions::Delete");

		$query = "DELETE FROM transactions ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "transactions::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM transactions";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$transactionss = $this->database->GetAll($sql);

		return $transactionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM transactions WHERE id = '$id'";

		$transactionsRecord = $this->database->GetRow($sql);

		return $transactionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $title, $pid, $user, $groupname, $authorized)
	{
		$this->debug->Show(Debug::DEBUG, "transactions::Insert");

		$sql = "INSERT INTO transactions (date, title, pid, user, groupname, authorized)".
			" VALUES ('$date', '" + "'$title', '" + "'$pid', '" + "'$user', '" + "'$groupname', '" + "'$authorized')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "transactions::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $title, $pid, $user, $groupname, $authorized)
	{
		$this->debug->Show(Debug::DEBUG, "transactions::Update");

		$sql = "UPDATE transactions SET ".
				@"date='$date'," + 
				@"title='$title'," + 
				@"pid='$pid'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "transactions::Update return: $result");

		return $result;
	}
}
?>
