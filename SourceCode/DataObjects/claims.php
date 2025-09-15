<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a claims Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class claims
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
	function Delete($patient_id)
	{
		$this->debug->Show(Debug::DEBUG, "claims::Delete");

		$query = "DELETE FROM claims ".
			"WHERE patient_id = '$patient_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "claims::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM claims";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$claimss = $this->database->GetAll($sql);

		return $claimss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($patient_id)
	{
		$sql = "SELECT * FROM claims WHERE patient_id = '$patient_id'";

		$claimsRecord = $this->database->GetRow($sql);

		return $claimsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($encounter_id, $version, $payer_id, $status, $payer_type, $bill_process, $bill_time, $process_time, $process_file, $target, $x12_partner_id, $submitted_claim)
	{
		$this->debug->Show(Debug::DEBUG, "claims::Insert");

		$sql = "INSERT INTO claims (encounter_id, version, payer_id, status, payer_type, bill_process, bill_time, process_time, process_file, target, x12_partner_id, submitted_claim)".
			" VALUES ('$encounter_id', '" + "'$version', '" + "'$payer_id', '" + "'$status', '" + "'$payer_type', '" + "'$bill_process', '" + "'$bill_time', '" + "'$process_time', '" + "'$process_file', '" + "'$target', '" + "'$x12_partner_id', '" + "'$submitted_claim')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "claims::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($patient_id, $encounter_id, $version, $payer_id, $status, $payer_type, $bill_process, $bill_time, $process_time, $process_file, $target, $x12_partner_id, $submitted_claim)
	{
		$this->debug->Show(Debug::DEBUG, "claims::Update");

		$sql = "UPDATE claims SET ".
				@"encounter_id='$encounter_id'," + 
				@"version='$version'," + 
				@"payer_id='$payer_id'," + 
				@"status='$status'," + 
				@"payer_type='$payer_type'," + 
				@"bill_process='$bill_process'," + 
				@"bill_time='$bill_time'," + 
				@"process_time='$process_time'," + 
				@"process_file='$process_file'," + 
				@"target='$target'," + 
				@"x12_partner_id='$x12_partner_id'," + 
				@"submitted_claim='$submitted_claim'" + 
				
				"WHERE patient_id = '$patient_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "claims::Update return: $result");

		return $result;
	}
}
?>
