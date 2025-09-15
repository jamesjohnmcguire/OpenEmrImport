<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a lang_definitions Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class lang_definitions
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
	function Delete($def_id)
	{
		$this->debug->Show(Debug::DEBUG, "lang_definitions::Delete");

		$query = "DELETE FROM lang_definitions ".
			"WHERE def_id = '$def_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "lang_definitions::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM lang_definitions";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$lang_definitionss = $this->database->GetAll($sql);

		return $lang_definitionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($def_id)
	{
		$sql = "SELECT * FROM lang_definitions WHERE def_id = '$def_id'";

		$lang_definitionsRecord = $this->database->GetRow($sql);

		return $lang_definitionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($cons_id, $lang_id, $definition)
	{
		$this->debug->Show(Debug::DEBUG, "lang_definitions::Insert");

		$sql = "INSERT INTO lang_definitions (cons_id, lang_id, definition)".
			" VALUES ('$cons_id', '" + "'$lang_id', '" + "'$definition')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "lang_definitions::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($def_id, $cons_id, $lang_id, $definition)
	{
		$this->debug->Show(Debug::DEBUG, "lang_definitions::Update");

		$sql = "UPDATE lang_definitions SET ".
				@"cons_id='$cons_id'," + 
				@"lang_id='$lang_id'," + 
				@"definition='$definition'" + 
				
				"WHERE def_id = '$def_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "lang_definitions::Update return: $result");

		return $result;
	}
}
?>
