<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a rule_reminder Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class rule_reminder
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
		$this->debug->Show(Debug::DEBUG, "rule_reminder::Delete");

		$query = "DELETE FROM rule_reminder ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "rule_reminder::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM rule_reminder";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$rule_reminders = $this->database->GetAll($sql);

		return $rule_reminders;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM rule_reminder WHERE id = '$id'";

		$rule_reminderRecord = $this->database->GetRow($sql);

		return $rule_reminderRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($method, $method_detail, $value)
	{
		$this->debug->Show(Debug::DEBUG, "rule_reminder::Insert");

		$sql = "INSERT INTO rule_reminder (method, method_detail, value)".
			" VALUES ('$method', '" + "'$method_detail', '" + "'$value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "rule_reminder::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $method, $method_detail, $value)
	{
		$this->debug->Show(Debug::DEBUG, "rule_reminder::Update");

		$sql = "UPDATE rule_reminder SET ".
				@"method='$method'," + 
				@"method_detail='$method_detail'," + 
				@"value='$value'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "rule_reminder::Update return: $result");

		return $result;
	}
}
?>
