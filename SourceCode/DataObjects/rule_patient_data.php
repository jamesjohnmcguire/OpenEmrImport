<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a rule_patient_data Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class rule_patient_data
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
		$this->debug->Show(Debug::DEBUG, "rule_patient_data::Delete");

		$query = "DELETE FROM rule_patient_data ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "rule_patient_data::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM rule_patient_data";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$rule_patient_datas = $this->database->GetAll($sql);

		return $rule_patient_datas;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM rule_patient_data WHERE id = '$id'";

		$rule_patient_dataRecord = $this->database->GetRow($sql);

		return $rule_patient_dataRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $pid, $category, $item, $complete, $result)
	{
		$this->debug->Show(Debug::DEBUG, "rule_patient_data::Insert");

		$sql = "INSERT INTO rule_patient_data (date, pid, category, item, complete, result)".
			" VALUES ('$date', '" + "'$pid', '" + "'$category', '" + "'$item', '" + "'$complete', '" + "'$result')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "rule_patient_data::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $pid, $category, $item, $complete, $result)
	{
		$this->debug->Show(Debug::DEBUG, "rule_patient_data::Update");

		$sql = "UPDATE rule_patient_data SET ".
				@"date='$date'," + 
				@"pid='$pid'," + 
				@"category='$category'," + 
				@"item='$item'," + 
				@"complete='$complete'," + 
				@"result='$result'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "rule_patient_data::Update return: $result");

		return $result;
	}
}
?>
