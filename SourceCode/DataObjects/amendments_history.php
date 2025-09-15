<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a amendments_history Collection
//
// NOTES:
//
// 2018 - 2018
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class amendments_history
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
	function Delete($amendment_id)
	{
		$this->debug->Show(Debug::DEBUG, "amendments_history::Delete");

		$query = "DELETE FROM amendments_history ".
			"WHERE amendment_id = '$amendment_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "amendments_history::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM amendments_history";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$amendments_historys = $this->database->GetAll($sql);

		return $amendments_historys;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($amendment_id)
	{
		$sql = "SELECT * FROM amendments_history WHERE amendment_id = '$amendment_id'";

		$amendments_historyRecord = $this->database->GetRow($sql);

		return $amendments_historyRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($amendment_note, $amendment_status, $created_by, $created_time)
	{
		$this->debug->Show(Debug::DEBUG, "amendments_history::Insert");

		$sql = "INSERT INTO amendments_history (amendment_note, amendment_status, created_by, created_time)".
			" VALUES ('$amendment_note', '" + "'$amendment_status', '" + "'$created_by', '" + "'$created_time')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "amendments_history::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($amendment_id, $amendment_note, $amendment_status, $created_by, $created_time)
	{
		$this->debug->Show(Debug::DEBUG, "amendments_history::Update");

		$sql = "UPDATE amendments_history SET ".
				@"amendment_note='$amendment_note'," + 
				@"amendment_status='$amendment_status'," + 
				@"created_by='$created_by'," + 
				@"created_time='$created_time'" + 
				
				"WHERE amendment_id = '$amendment_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "amendments_history::Update return: $result");

		return $result;
	}
}
?>
