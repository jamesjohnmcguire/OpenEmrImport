<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a rule_target Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class rule_target
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
		$this->debug->Show(Debug::DEBUG, "rule_target::Delete");

		$query = "DELETE FROM rule_target ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "rule_target::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM rule_target";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$rule_targets = $this->database->GetAll($sql);

		return $rule_targets;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM rule_target WHERE id = '$id'";

		$rule_targetRecord = $this->database->GetRow($sql);

		return $rule_targetRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($group_id, $include_flag, $required_flag, $method, $value, $interval)
	{
		$this->debug->Show(Debug::DEBUG, "rule_target::Insert");

		$sql = "INSERT INTO rule_target (group_id, include_flag, required_flag, method, value, interval)".
			" VALUES ('$group_id', '" + "'$include_flag', '" + "'$required_flag', '" + "'$method', '" + "'$value', '" + "'$interval')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "rule_target::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $group_id, $include_flag, $required_flag, $method, $value, $interval)
	{
		$this->debug->Show(Debug::DEBUG, "rule_target::Update");

		$sql = "UPDATE rule_target SET ".
				@"group_id='$group_id'," + 
				@"include_flag='$include_flag'," + 
				@"required_flag='$required_flag'," + 
				@"method='$method'," + 
				@"value='$value'," + 
				@"interval='$interval'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "rule_target::Update return: $result");

		return $result;
	}
}
?>
