<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a lang_custom Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class lang_custom
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
	function Delete($lang_description)
	{
		$this->debug->Show(Debug::DEBUG, "lang_custom::Delete");

		$query = "DELETE FROM lang_custom ".
			"WHERE lang_description = '$lang_description'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "lang_custom::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM lang_custom";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$lang_customs = $this->database->GetAll($sql);

		return $lang_customs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($lang_description)
	{
		$sql = "SELECT * FROM lang_custom WHERE lang_description = '$lang_description'";

		$lang_customRecord = $this->database->GetRow($sql);

		return $lang_customRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($lang_code, $constant_name, $definition)
	{
		$this->debug->Show(Debug::DEBUG, "lang_custom::Insert");

		$sql = "INSERT INTO lang_custom (lang_code, constant_name, definition)".
			" VALUES ('$lang_code', '" + "'$constant_name', '" + "'$definition')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "lang_custom::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($lang_description, $lang_code, $constant_name, $definition)
	{
		$this->debug->Show(Debug::DEBUG, "lang_custom::Update");

		$sql = "UPDATE lang_custom SET ".
				@"lang_code='$lang_code'," + 
				@"constant_name='$constant_name'," + 
				@"definition='$definition'" + 
				
				"WHERE lang_description = '$lang_description'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "lang_custom::Update return: $result");

		return $result;
	}
}
?>
