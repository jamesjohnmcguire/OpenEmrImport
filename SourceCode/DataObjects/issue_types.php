<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a issue_types Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class issue_types
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
	function Delete($active)
	{
		$this->debug->Show(Debug::DEBUG, "issue_types::Delete");

		$query = "DELETE FROM issue_types ".
			"WHERE active = '$active'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "issue_types::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM issue_types";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$issue_typess = $this->database->GetAll($sql);

		return $issue_typess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($active)
	{
		$sql = "SELECT * FROM issue_types WHERE active = '$active'";

		$issue_typesRecord = $this->database->GetRow($sql);

		return $issue_typesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($category, $type, $plural, $singular, $abbreviation, $style, $force_show, $ordering, $aco_spec)
	{
		$this->debug->Show(Debug::DEBUG, "issue_types::Insert");

		$sql = "INSERT INTO issue_types (category, type, plural, singular, abbreviation, style, force_show, ordering, aco_spec)".
			" VALUES ('$category', '" + "'$type', '" + "'$plural', '" + "'$singular', '" + "'$abbreviation', '" + "'$style', '" + "'$force_show', '" + "'$ordering', '" + "'$aco_spec')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "issue_types::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($active, $category, $type, $plural, $singular, $abbreviation, $style, $force_show, $ordering, $aco_spec)
	{
		$this->debug->Show(Debug::DEBUG, "issue_types::Update");

		$sql = "UPDATE issue_types SET ".
				@"category='$category'," + 
				@"type='$type'," + 
				@"plural='$plural'," + 
				@"singular='$singular'," + 
				@"abbreviation='$abbreviation'," + 
				@"style='$style'," + 
				@"force_show='$force_show'," + 
				@"ordering='$ordering'," + 
				@"aco_spec='$aco_spec'" + 
				
				"WHERE active = '$active'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "issue_types::Update return: $result");

		return $result;
	}
}
?>
