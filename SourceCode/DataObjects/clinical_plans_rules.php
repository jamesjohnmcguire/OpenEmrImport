<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a clinical_plans_rules Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class clinical_plans_rules
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
	function Delete($plan_id)
	{
		$this->debug->Show(Debug::DEBUG, "clinical_plans_rules::Delete");

		$query = "DELETE FROM clinical_plans_rules ".
			"WHERE plan_id = '$plan_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "clinical_plans_rules::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM clinical_plans_rules";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$clinical_plans_ruless = $this->database->GetAll($sql);

		return $clinical_plans_ruless;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($plan_id)
	{
		$sql = "SELECT * FROM clinical_plans_rules WHERE plan_id = '$plan_id'";

		$clinical_plans_rulesRecord = $this->database->GetRow($sql);

		return $clinical_plans_rulesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($rule_id)
	{
		$this->debug->Show(Debug::DEBUG, "clinical_plans_rules::Insert");

		$sql = "INSERT INTO clinical_plans_rules (rule_id)".
			" VALUES ('$rule_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "clinical_plans_rules::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($plan_id, $rule_id)
	{
		$this->debug->Show(Debug::DEBUG, "clinical_plans_rules::Update");

		$sql = "UPDATE clinical_plans_rules SET ".
				@"rule_id='$rule_id'" + 
				
				"WHERE plan_id = '$plan_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "clinical_plans_rules::Update return: $result");

		return $result;
	}
}
?>
