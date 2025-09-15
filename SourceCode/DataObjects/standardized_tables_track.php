<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a standardized_tables_track Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class standardized_tables_track
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
		$this->debug->Show(Debug::DEBUG, "standardized_tables_track::Delete");

		$query = "DELETE FROM standardized_tables_track ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "standardized_tables_track::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM standardized_tables_track";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$standardized_tables_tracks = $this->database->GetAll($sql);

		return $standardized_tables_tracks;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM standardized_tables_track WHERE id = '$id'";

		$standardized_tables_trackRecord = $this->database->GetRow($sql);

		return $standardized_tables_trackRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($imported_date, $name, $revision_version, $revision_date, $file_checksum)
	{
		$this->debug->Show(Debug::DEBUG, "standardized_tables_track::Insert");

		$sql = "INSERT INTO standardized_tables_track (imported_date, name, revision_version, revision_date, file_checksum)".
			" VALUES ('$imported_date', '" + "'$name', '" + "'$revision_version', '" + "'$revision_date', '" + "'$file_checksum')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "standardized_tables_track::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $imported_date, $name, $revision_version, $revision_date, $file_checksum)
	{
		$this->debug->Show(Debug::DEBUG, "standardized_tables_track::Update");

		$sql = "UPDATE standardized_tables_track SET ".
				@"imported_date='$imported_date'," + 
				@"name='$name'," + 
				@"revision_version='$revision_version'," + 
				@"revision_date='$revision_date'," + 
				@"file_checksum='$file_checksum'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "standardized_tables_track::Update return: $result");

		return $result;
	}
}
?>
