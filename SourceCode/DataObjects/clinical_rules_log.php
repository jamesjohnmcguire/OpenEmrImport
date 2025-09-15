<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a clinical_rules_log Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class clinical_rules_log
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
		$this->debug->Show(Debug::DEBUG, "clinical_rules_log::Delete");

		$query = "DELETE FROM clinical_rules_log ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "clinical_rules_log::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM clinical_rules_log";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$clinical_rules_logs = $this->database->GetAll($sql);

		return $clinical_rules_logs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM clinical_rules_log WHERE id = '$id'";

		$clinical_rules_logRecord = $this->database->GetRow($sql);

		return $clinical_rules_logRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $pid, $uid, $category, $value, $new_value)
	{
		$this->debug->Show(Debug::DEBUG, "clinical_rules_log::Insert");

		$sql = "INSERT INTO clinical_rules_log (date, pid, uid, category, value, new_value)".
			" VALUES ('$date', '" + "'$pid', '" + "'$uid', '" + "'$category', '" + "'$value', '" + "'$new_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "clinical_rules_log::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $pid, $uid, $category, $value, $new_value)
	{
		$this->debug->Show(Debug::DEBUG, "clinical_rules_log::Update");

		$sql = "UPDATE clinical_rules_log SET ".
				@"date='$date'," + 
				@"pid='$pid'," + 
				@"uid='$uid'," + 
				@"category='$category'," + 
				@"value='$value'," + 
				@"new_value='$new_value'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "clinical_rules_log::Update return: $result");

		return $result;
	}
}
?>
