<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a rule_filter Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class rule_filter
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
		$this->debug->Show(Debug::DEBUG, "rule_filter::Delete");

		$query = "DELETE FROM rule_filter ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "rule_filter::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM rule_filter";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$rule_filters = $this->database->GetAll($sql);

		return $rule_filters;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM rule_filter WHERE id = '$id'";

		$rule_filterRecord = $this->database->GetRow($sql);

		return $rule_filterRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($include_flag, $required_flag, $method, $method_detail, $value)
	{
		$this->debug->Show(Debug::DEBUG, "rule_filter::Insert");

		$sql = "INSERT INTO rule_filter (include_flag, required_flag, method, method_detail, value)".
			" VALUES ('$include_flag', '" + "'$required_flag', '" + "'$method', '" + "'$method_detail', '" + "'$value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "rule_filter::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $include_flag, $required_flag, $method, $method_detail, $value)
	{
		$this->debug->Show(Debug::DEBUG, "rule_filter::Update");

		$sql = "UPDATE rule_filter SET ".
				@"include_flag='$include_flag'," + 
				@"required_flag='$required_flag'," + 
				@"method='$method'," + 
				@"method_detail='$method_detail'," + 
				@"value='$value'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "rule_filter::Update return: $result");

		return $result;
	}
}
?>
