<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a rule_action Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class rule_action
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
		$this->debug->Show(Debug::DEBUG, "rule_action::Delete");

		$query = "DELETE FROM rule_action ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "rule_action::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM rule_action";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$rule_actions = $this->database->GetAll($sql);

		return $rule_actions;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM rule_action WHERE id = '$id'";

		$rule_actionRecord = $this->database->GetRow($sql);

		return $rule_actionRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($group_id, $category, $item)
	{
		$this->debug->Show(Debug::DEBUG, "rule_action::Insert");

		$sql = "INSERT INTO rule_action (group_id, category, item)".
			" VALUES ('$group_id', '" + "'$category', '" + "'$item')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "rule_action::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $group_id, $category, $item)
	{
		$this->debug->Show(Debug::DEBUG, "rule_action::Update");

		$sql = "UPDATE rule_action SET ".
				@"group_id='$group_id'," + 
				@"category='$category'," + 
				@"item='$item'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "rule_action::Update return: $result");

		return $result;
	}
}
?>
