<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a config Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class config
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
		$this->debug->Show(Debug::DEBUG, "config::Delete");

		$query = "DELETE FROM config ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "config::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM config";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$configs = $this->database->GetAll($sql);

		return $configs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM config WHERE id = '$id'";

		$configRecord = $this->database->GetRow($sql);

		return $configRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($name, $value, $parent, $lft, $rght)
	{
		$this->debug->Show(Debug::DEBUG, "config::Insert");

		$sql = "INSERT INTO config (name, value, parent, lft, rght)".
			" VALUES ('$name', '" + "'$value', '" + "'$parent', '" + "'$lft', '" + "'$rght')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "config::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $name, $value, $parent, $lft, $rght)
	{
		$this->debug->Show(Debug::DEBUG, "config::Update");

		$sql = "UPDATE config SET ".
				@"name='$name'," + 
				@"value='$value'," + 
				@"parent='$parent'," + 
				@"lft='$lft'," + 
				@"rght='$rght'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "config::Update return: $result");

		return $result;
	}
}
?>
