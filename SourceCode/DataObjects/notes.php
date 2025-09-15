<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a notes Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class notes
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
		$this->debug->Show(Debug::DEBUG, "notes::Delete");

		$query = "DELETE FROM notes ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "notes::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM notes";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$notess = $this->database->GetAll($sql);

		return $notess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM notes WHERE id = '$id'";

		$notesRecord = $this->database->GetRow($sql);

		return $notesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($foreign_id, $note, $owner, $date, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "notes::Insert");

		$sql = "INSERT INTO notes (foreign_id, note, owner, date, revision)".
			" VALUES ('$foreign_id', '" + "'$note', '" + "'$owner', '" + "'$date', '" + "'$revision')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "notes::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $foreign_id, $note, $owner, $date, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "notes::Update");

		$sql = "UPDATE notes SET ".
				@"foreign_id='$foreign_id'," + 
				@"note='$note'," + 
				@"owner='$owner'," + 
				@"date='$date'," + 
				@"revision='$revision'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "notes::Update return: $result");

		return $result;
	}
}
?>
