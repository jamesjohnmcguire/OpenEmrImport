<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a globals Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class globals
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
	function Delete($gl_name)
	{
		$this->debug->Show(Debug::DEBUG, "globals::Delete");

		$query = "DELETE FROM globals ".
			"WHERE gl_name = '$gl_name'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "globals::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM globals";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$globalss = $this->database->GetAll($sql);

		return $globalss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($gl_name)
	{
		$sql = "SELECT * FROM globals WHERE gl_name = '$gl_name'";

		$globalsRecord = $this->database->GetRow($sql);

		return $globalsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($gl_index, $gl_value)
	{
		$this->debug->Show(Debug::DEBUG, "globals::Insert");

		$sql = "INSERT INTO globals (gl_index, gl_value)".
			" VALUES ('$gl_index', '" + "'$gl_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "globals::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($gl_name, $gl_index, $gl_value)
	{
		$this->debug->Show(Debug::DEBUG, "globals::Update");

		$sql = "UPDATE globals SET ".
				@"gl_index='$gl_index'," + 
				@"gl_value='$gl_value'" + 
				
				"WHERE gl_name = '$gl_name'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "globals::Update return: $result");

		return $result;
	}
}
?>
