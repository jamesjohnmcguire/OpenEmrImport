<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a external_procedures Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class external_procedures
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
	function Delete($ep_id)
	{
		$this->debug->Show(Debug::DEBUG, "external_procedures::Delete");

		$query = "DELETE FROM external_procedures ".
			"WHERE ep_id = '$ep_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "external_procedures::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM external_procedures";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$external_proceduress = $this->database->GetAll($sql);

		return $external_proceduress;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($ep_id)
	{
		$sql = "SELECT * FROM external_procedures WHERE ep_id = '$ep_id'";

		$external_proceduresRecord = $this->database->GetRow($sql);

		return $external_proceduresRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ep_date, $ep_code_type, $ep_code, $ep_pid, $ep_encounter, $ep_code_text, $ep_facility_id, $ep_external_id)
	{
		$this->debug->Show(Debug::DEBUG, "external_procedures::Insert");

		$sql = "INSERT INTO external_procedures (ep_date, ep_code_type, ep_code, ep_pid, ep_encounter, ep_code_text, ep_facility_id, ep_external_id)".
			" VALUES ('$ep_date', '" + "'$ep_code_type', '" + "'$ep_code', '" + "'$ep_pid', '" + "'$ep_encounter', '" + "'$ep_code_text', '" + "'$ep_facility_id', '" + "'$ep_external_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "external_procedures::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($ep_id, $ep_date, $ep_code_type, $ep_code, $ep_pid, $ep_encounter, $ep_code_text, $ep_facility_id, $ep_external_id)
	{
		$this->debug->Show(Debug::DEBUG, "external_procedures::Update");

		$sql = "UPDATE external_procedures SET ".
				@"ep_date='$ep_date'," + 
				@"ep_code_type='$ep_code_type'," + 
				@"ep_code='$ep_code'," + 
				@"ep_pid='$ep_pid'," + 
				@"ep_encounter='$ep_encounter'," + 
				@"ep_code_text='$ep_code_text'," + 
				@"ep_facility_id='$ep_facility_id'," + 
				@"ep_external_id='$ep_external_id'" + 
				
				"WHERE ep_id = '$ep_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "external_procedures::Update return: $result");

		return $result;
	}
}
?>
