<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a clinical_plans Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class clinical_plans
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
		$this->debug->Show(Debug::DEBUG, "clinical_plans::Delete");

		$query = "DELETE FROM clinical_plans ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "clinical_plans::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM clinical_plans";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$clinical_planss = $this->database->GetAll($sql);

		return $clinical_planss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM clinical_plans WHERE id = '$id'";

		$clinical_plansRecord = $this->database->GetRow($sql);

		return $clinical_plansRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $normal_flag, $cqm_flag, $cqm_2011_flag, $cqm_2014_flag, $cqm_measure_group)
	{
		$this->debug->Show(Debug::DEBUG, "clinical_plans::Insert");

		$sql = "INSERT INTO clinical_plans (pid, normal_flag, cqm_flag, cqm_2011_flag, cqm_2014_flag, cqm_measure_group)".
			" VALUES ('$pid', '" + "'$normal_flag', '" + "'$cqm_flag', '" + "'$cqm_2011_flag', '" + "'$cqm_2014_flag', '" + "'$cqm_measure_group')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "clinical_plans::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $pid, $normal_flag, $cqm_flag, $cqm_2011_flag, $cqm_2014_flag, $cqm_measure_group)
	{
		$this->debug->Show(Debug::DEBUG, "clinical_plans::Update");

		$sql = "UPDATE clinical_plans SET ".
				@"pid='$pid'," + 
				@"normal_flag='$normal_flag'," + 
				@"cqm_flag='$cqm_flag'," + 
				@"cqm_2011_flag='$cqm_2011_flag'," + 
				@"cqm_2014_flag='$cqm_2014_flag'," + 
				@"cqm_measure_group='$cqm_measure_group'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "clinical_plans::Update return: $result");

		return $result;
	}
}
?>
