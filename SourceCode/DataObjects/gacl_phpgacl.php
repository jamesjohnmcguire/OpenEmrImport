<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_phpgacl Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_phpgacl
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
	function Delete($name)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_phpgacl::Delete");

		$query = "DELETE FROM gacl_phpgacl ".
			"WHERE name = '$name'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_phpgacl::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_phpgacl";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_phpgacls = $this->database->GetAll($sql);

		return $gacl_phpgacls;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($name)
	{
		$sql = "SELECT * FROM gacl_phpgacl WHERE name = '$name'";

		$gacl_phpgaclRecord = $this->database->GetRow($sql);

		return $gacl_phpgaclRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($value)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_phpgacl::Insert");

		$sql = "INSERT INTO gacl_phpgacl (value)".
			" VALUES ('$value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_phpgacl::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($name, $value)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_phpgacl::Update");

		$sql = "UPDATE gacl_phpgacl SET ".
				@"value='$value'" + 
				
				"WHERE name = '$name'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_phpgacl::Update return: $result");

		return $result;
	}
}
?>
