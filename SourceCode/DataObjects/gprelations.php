<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gprelations Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gprelations
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
	function Delete($type1)
	{
		$this->debug->Show(Debug::DEBUG, "gprelations::Delete");

		$query = "DELETE FROM gprelations ".
			"WHERE type1 = '$type1'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gprelations::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gprelations";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gprelationss = $this->database->GetAll($sql);

		return $gprelationss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($type1)
	{
		$sql = "SELECT * FROM gprelations WHERE type1 = '$type1'";

		$gprelationsRecord = $this->database->GetRow($sql);

		return $gprelationsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($id1, $type2, $id2)
	{
		$this->debug->Show(Debug::DEBUG, "gprelations::Insert");

		$sql = "INSERT INTO gprelations (id1, type2, id2)".
			" VALUES ('$id1', '" + "'$type2', '" + "'$id2')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gprelations::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($type1, $id1, $type2, $id2)
	{
		$this->debug->Show(Debug::DEBUG, "gprelations::Update");

		$sql = "UPDATE gprelations SET ".
				@"id1='$id1'," + 
				@"type2='$type2'," + 
				@"id2='$id2'" + 
				
				"WHERE type1 = '$type1'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gprelations::Update return: $result");

		return $result;
	}
}
?>
