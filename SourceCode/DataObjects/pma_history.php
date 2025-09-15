<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a pma_history Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class pma_history
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
		$this->debug->Show(Debug::DEBUG, "pma_history::Delete");

		$query = "DELETE FROM pma_history ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "pma_history::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM pma_history";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$pma_historys = $this->database->GetAll($sql);

		return $pma_historys;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM pma_history WHERE id = '$id'";

		$pma_historyRecord = $this->database->GetRow($sql);

		return $pma_historyRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($username, $db, $table, $timevalue, $sqlquery)
	{
		$this->debug->Show(Debug::DEBUG, "pma_history::Insert");

		$sql = "INSERT INTO pma_history (username, db, table, timevalue, sqlquery)".
			" VALUES ('$username', '" + "'$db', '" + "'$table', '" + "'$timevalue', '" + "'$sqlquery')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "pma_history::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $username, $db, $table, $timevalue, $sqlquery)
	{
		$this->debug->Show(Debug::DEBUG, "pma_history::Update");

		$sql = "UPDATE pma_history SET ".
				@"username='$username'," + 
				@"db='$db'," + 
				@"table='$table'," + 
				@"timevalue='$timevalue'," + 
				@"sqlquery='$sqlquery'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "pma_history::Update return: $result");

		return $result;
	}
}
?>
