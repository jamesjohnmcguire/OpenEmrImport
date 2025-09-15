<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a procedure_result Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class procedure_result
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
	function Delete($procedure_result_id)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_result::Delete");

		$query = "DELETE FROM procedure_result ".
			"WHERE procedure_result_id = '$procedure_result_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "procedure_result::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM procedure_result";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$procedure_results = $this->database->GetAll($sql);

		return $procedure_results;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($procedure_result_id)
	{
		$sql = "SELECT * FROM procedure_result WHERE procedure_result_id = '$procedure_result_id'";

		$procedure_resultRecord = $this->database->GetRow($sql);

		return $procedure_resultRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($procedure_report_id, $result_data_type, $result_code, $result_text, $date, $facility, $units, $result, $range, $abnormal, $comments, $document_id, $result_status)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_result::Insert");

		$sql = "INSERT INTO procedure_result (procedure_report_id, result_data_type, result_code, result_text, date, facility, units, result, range, abnormal, comments, document_id, result_status)".
			" VALUES ('$procedure_report_id', '" + "'$result_data_type', '" + "'$result_code', '" + "'$result_text', '" + "'$date', '" + "'$facility', '" + "'$units', '" + "'$result', '" + "'$range', '" + "'$abnormal', '" + "'$comments', '" + "'$document_id', '" + "'$result_status')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_result::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($procedure_result_id, $procedure_report_id, $result_data_type, $result_code, $result_text, $date, $facility, $units, $result, $range, $abnormal, $comments, $document_id, $result_status)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_result::Update");

		$sql = "UPDATE procedure_result SET ".
				@"procedure_report_id='$procedure_report_id'," + 
				@"result_data_type='$result_data_type'," + 
				@"result_code='$result_code'," + 
				@"result_text='$result_text'," + 
				@"date='$date'," + 
				@"facility='$facility'," + 
				@"units='$units'," + 
				@"result='$result'," + 
				@"range='$range'," + 
				@"abnormal='$abnormal'," + 
				@"comments='$comments'," + 
				@"document_id='$document_id'," + 
				@"result_status='$result_status'" + 
				
				"WHERE procedure_result_id = '$procedure_result_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_result::Update return: $result");

		return $result;
	}
}
?>
