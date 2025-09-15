<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a lang_constants Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class lang_constants
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
	function Delete($cons_id)
	{
		$this->debug->Show(Debug::DEBUG, "lang_constants::Delete");

		$query = "DELETE FROM lang_constants ".
			"WHERE cons_id = '$cons_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "lang_constants::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM lang_constants";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$lang_constantss = $this->database->GetAll($sql);

		return $lang_constantss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($cons_id)
	{
		$sql = "SELECT * FROM lang_constants WHERE cons_id = '$cons_id'";

		$lang_constantsRecord = $this->database->GetRow($sql);

		return $lang_constantsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($constant_name)
	{
		$this->debug->Show(Debug::DEBUG, "lang_constants::Insert");

		$sql = "INSERT INTO lang_constants (constant_name)".
			" VALUES ('$constant_name')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "lang_constants::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($cons_id, $constant_name)
	{
		$this->debug->Show(Debug::DEBUG, "lang_constants::Update");

		$sql = "UPDATE lang_constants SET ".
				@"constant_name='$constant_name'" + 
				
				"WHERE cons_id = '$cons_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "lang_constants::Update return: $result");

		return $result;
	}
}
?>
