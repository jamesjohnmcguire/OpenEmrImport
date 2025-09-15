<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a report_results Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class report_results
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
	function Delete($report_id)
	{
		$this->debug->Show(Debug::DEBUG, "report_results::Delete");

		$query = "DELETE FROM report_results ".
			"WHERE report_id = '$report_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "report_results::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM report_results";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$report_resultss = $this->database->GetAll($sql);

		return $report_resultss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($report_id)
	{
		$sql = "SELECT * FROM report_results WHERE report_id = '$report_id'";

		$report_resultsRecord = $this->database->GetRow($sql);

		return $report_resultsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($field_id, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "report_results::Insert");

		$sql = "INSERT INTO report_results (field_id, field_value)".
			" VALUES ('$field_id', '" + "'$field_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "report_results::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($report_id, $field_id, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "report_results::Update");

		$sql = "UPDATE report_results SET ".
				@"field_id='$field_id'," + 
				@"field_value='$field_value'" + 
				
				"WHERE report_id = '$report_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "report_results::Update return: $result");

		return $result;
	}
}
?>
