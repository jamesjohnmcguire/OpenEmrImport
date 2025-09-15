<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a rule_action_item Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class rule_action_item
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
	function Delete($category)
	{
		$this->debug->Show(Debug::DEBUG, "rule_action_item::Delete");

		$query = "DELETE FROM rule_action_item ".
			"WHERE category = '$category'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "rule_action_item::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM rule_action_item";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$rule_action_items = $this->database->GetAll($sql);

		return $rule_action_items;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($category)
	{
		$sql = "SELECT * FROM rule_action_item WHERE category = '$category'";

		$rule_action_itemRecord = $this->database->GetRow($sql);

		return $rule_action_itemRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($item, $clin_rem_link, $reminder_message, $custom_flag)
	{
		$this->debug->Show(Debug::DEBUG, "rule_action_item::Insert");

		$sql = "INSERT INTO rule_action_item (item, clin_rem_link, reminder_message, custom_flag)".
			" VALUES ('$item', '" + "'$clin_rem_link', '" + "'$reminder_message', '" + "'$custom_flag')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "rule_action_item::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($category, $item, $clin_rem_link, $reminder_message, $custom_flag)
	{
		$this->debug->Show(Debug::DEBUG, "rule_action_item::Update");

		$sql = "UPDATE rule_action_item SET ".
				@"item='$item'," + 
				@"clin_rem_link='$clin_rem_link'," + 
				@"reminder_message='$reminder_message'," + 
				@"custom_flag='$custom_flag'" + 
				
				"WHERE category = '$category'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "rule_action_item::Update return: $result");

		return $result;
	}
}
?>
