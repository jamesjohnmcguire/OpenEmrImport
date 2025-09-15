<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a report_itemized Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class report_itemized
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
		$this->debug->Show(Debug::DEBUG, "report_itemized::Delete");

		$query = "DELETE FROM report_itemized ".
			"WHERE report_id = '$report_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "report_itemized::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM report_itemized";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$report_itemizeds = $this->database->GetAll($sql);

		return $report_itemizeds;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($report_id)
	{
		$sql = "SELECT * FROM report_itemized WHERE report_id = '$report_id'";

		$report_itemizedRecord = $this->database->GetRow($sql);

		return $report_itemizedRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($itemized_test_id, $numerator_label, $pass, $pid)
	{
		$this->debug->Show(Debug::DEBUG, "report_itemized::Insert");

		$sql = "INSERT INTO report_itemized (itemized_test_id, numerator_label, pass, pid)".
			" VALUES ('$itemized_test_id', '" + "'$numerator_label', '" + "'$pass', '" + "'$pid')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "report_itemized::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($report_id, $itemized_test_id, $numerator_label, $pass, $pid)
	{
		$this->debug->Show(Debug::DEBUG, "report_itemized::Update");

		$sql = "UPDATE report_itemized SET ".
				@"itemized_test_id='$itemized_test_id'," + 
				@"numerator_label='$numerator_label'," + 
				@"pass='$pass'," + 
				@"pid='$pid'" + 
				
				"WHERE report_id = '$report_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "report_itemized::Update return: $result");

		return $result;
	}
}
?>
