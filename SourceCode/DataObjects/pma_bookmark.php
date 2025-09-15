<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a pma_bookmark Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class pma_bookmark
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
		$this->debug->Show(Debug::DEBUG, "pma_bookmark::Delete");

		$query = "DELETE FROM pma_bookmark ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "pma_bookmark::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM pma_bookmark";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$pma_bookmarks = $this->database->GetAll($sql);

		return $pma_bookmarks;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM pma_bookmark WHERE id = '$id'";

		$pma_bookmarkRecord = $this->database->GetRow($sql);

		return $pma_bookmarkRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($dbase, $user, $label, $query)
	{
		$this->debug->Show(Debug::DEBUG, "pma_bookmark::Insert");

		$sql = "INSERT INTO pma_bookmark (dbase, user, label, query)".
			" VALUES ('$dbase', '" + "'$user', '" + "'$label', '" + "'$query')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "pma_bookmark::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $dbase, $user, $label, $query)
	{
		$this->debug->Show(Debug::DEBUG, "pma_bookmark::Update");

		$sql = "UPDATE pma_bookmark SET ".
				@"dbase='$dbase'," + 
				@"user='$user'," + 
				@"label='$label'," + 
				@"query='$query'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "pma_bookmark::Update return: $result");

		return $result;
	}
}
?>
