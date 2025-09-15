<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a eligibility_response Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class eligibility_response
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
	function Delete($response_id)
	{
		$this->debug->Show(Debug::DEBUG, "eligibility_response::Delete");

		$query = "DELETE FROM eligibility_response ".
			"WHERE response_id = '$response_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "eligibility_response::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM eligibility_response";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$eligibility_responses = $this->database->GetAll($sql);

		return $eligibility_responses;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($response_id)
	{
		$sql = "SELECT * FROM eligibility_response WHERE response_id = '$response_id'";

		$eligibility_responseRecord = $this->database->GetRow($sql);

		return $eligibility_responseRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($response_description, $response_status, $response_vendor_id, $response_create_date, $response_modify_date)
	{
		$this->debug->Show(Debug::DEBUG, "eligibility_response::Insert");

		$sql = "INSERT INTO eligibility_response (response_description, response_status, response_vendor_id, response_create_date, response_modify_date)".
			" VALUES ('$response_description', '" + "'$response_status', '" + "'$response_vendor_id', '" + "'$response_create_date', '" + "'$response_modify_date')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "eligibility_response::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($response_id, $response_description, $response_status, $response_vendor_id, $response_create_date, $response_modify_date)
	{
		$this->debug->Show(Debug::DEBUG, "eligibility_response::Update");

		$sql = "UPDATE eligibility_response SET ".
				@"response_description='$response_description'," + 
				@"response_status='$response_status'," + 
				@"response_vendor_id='$response_vendor_id'," + 
				@"response_create_date='$response_create_date'," + 
				@"response_modify_date='$response_modify_date'" + 
				
				"WHERE response_id = '$response_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "eligibility_response::Update return: $result");

		return $result;
	}
}
?>
