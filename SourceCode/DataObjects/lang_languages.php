<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a lang_languages Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class lang_languages
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
	function Delete($lang_id)
	{
		$this->debug->Show(Debug::DEBUG, "lang_languages::Delete");

		$query = "DELETE FROM lang_languages ".
			"WHERE lang_id = '$lang_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "lang_languages::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM lang_languages";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$lang_languagess = $this->database->GetAll($sql);

		return $lang_languagess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($lang_id)
	{
		$sql = "SELECT * FROM lang_languages WHERE lang_id = '$lang_id'";

		$lang_languagesRecord = $this->database->GetRow($sql);

		return $lang_languagesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($lang_code, $lang_description, $lang_is_rtl)
	{
		$this->debug->Show(Debug::DEBUG, "lang_languages::Insert");

		$sql = "INSERT INTO lang_languages (lang_code, lang_description, lang_is_rtl)".
			" VALUES ('$lang_code', '" + "'$lang_description', '" + "'$lang_is_rtl')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "lang_languages::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($lang_id, $lang_code, $lang_description, $lang_is_rtl)
	{
		$this->debug->Show(Debug::DEBUG, "lang_languages::Update");

		$sql = "UPDATE lang_languages SET ".
				@"lang_code='$lang_code'," + 
				@"lang_description='$lang_description'," + 
				@"lang_is_rtl='$lang_is_rtl'" + 
				
				"WHERE lang_id = '$lang_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "lang_languages::Update return: $result");

		return $result;
	}
}
?>
