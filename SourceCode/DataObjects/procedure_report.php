<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a procedure_report Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class procedure_report
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
	function Delete($procedure_report_id)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_report::Delete");

		$query = "DELETE FROM procedure_report ".
			"WHERE procedure_report_id = '$procedure_report_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "procedure_report::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM procedure_report";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$procedure_reports = $this->database->GetAll($sql);

		return $procedure_reports;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($procedure_report_id)
	{
		$sql = "SELECT * FROM procedure_report WHERE procedure_report_id = '$procedure_report_id'";

		$procedure_reportRecord = $this->database->GetRow($sql);

		return $procedure_reportRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($procedure_order_id, $procedure_order_seq, $date_collected, $date_collected_tz, $date_report, $date_report_tz, $source, $specimen_num, $report_status, $review_status, $report_notes)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_report::Insert");

		$sql = "INSERT INTO procedure_report (procedure_order_id, procedure_order_seq, date_collected, date_collected_tz, date_report, date_report_tz, source, specimen_num, report_status, review_status, report_notes)".
			" VALUES ('$procedure_order_id', '" + "'$procedure_order_seq', '" + "'$date_collected', '" + "'$date_collected_tz', '" + "'$date_report', '" + "'$date_report_tz', '" + "'$source', '" + "'$specimen_num', '" + "'$report_status', '" + "'$review_status', '" + "'$report_notes')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_report::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($procedure_report_id, $procedure_order_id, $procedure_order_seq, $date_collected, $date_collected_tz, $date_report, $date_report_tz, $source, $specimen_num, $report_status, $review_status, $report_notes)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_report::Update");

		$sql = "UPDATE procedure_report SET ".
				@"procedure_order_id='$procedure_order_id'," + 
				@"procedure_order_seq='$procedure_order_seq'," + 
				@"date_collected='$date_collected'," + 
				@"date_collected_tz='$date_collected_tz'," + 
				@"date_report='$date_report'," + 
				@"date_report_tz='$date_report_tz'," + 
				@"source='$source'," + 
				@"specimen_num='$specimen_num'," + 
				@"report_status='$report_status'," + 
				@"review_status='$review_status'," + 
				@"report_notes='$report_notes'" + 
				
				"WHERE procedure_report_id = '$procedure_report_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_report::Update return: $result");

		return $result;
	}
}
?>
