<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a eligibility_verification Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class eligibility_verification
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
	function Delete($verification_id)
	{
		$this->debug->Show(Debug::DEBUG, "eligibility_verification::Delete");

		$query = "DELETE FROM eligibility_verification ".
			"WHERE verification_id = '$verification_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "eligibility_verification::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM eligibility_verification";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$eligibility_verifications = $this->database->GetAll($sql);

		return $eligibility_verifications;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($verification_id)
	{
		$sql = "SELECT * FROM eligibility_verification WHERE verification_id = '$verification_id'";

		$eligibility_verificationRecord = $this->database->GetRow($sql);

		return $eligibility_verificationRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($response_id, $insurance_id, $eligibility_check_date, $copay, $deductible, $deductiblemet, $create_date)
	{
		$this->debug->Show(Debug::DEBUG, "eligibility_verification::Insert");

		$sql = "INSERT INTO eligibility_verification (response_id, insurance_id, eligibility_check_date, copay, deductible, deductiblemet, create_date)".
			" VALUES ('$response_id', '" + "'$insurance_id', '" + "'$eligibility_check_date', '" + "'$copay', '" + "'$deductible', '" + "'$deductiblemet', '" + "'$create_date')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "eligibility_verification::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($verification_id, $response_id, $insurance_id, $eligibility_check_date, $copay, $deductible, $deductiblemet, $create_date)
	{
		$this->debug->Show(Debug::DEBUG, "eligibility_verification::Update");

		$sql = "UPDATE eligibility_verification SET ".
				@"response_id='$response_id'," + 
				@"insurance_id='$insurance_id'," + 
				@"eligibility_check_date='$eligibility_check_date'," + 
				@"copay='$copay'," + 
				@"deductible='$deductible'," + 
				@"deductiblemet='$deductiblemet'," + 
				@"create_date='$create_date'" + 
				
				"WHERE verification_id = '$verification_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "eligibility_verification::Update return: $result");

		return $result;
	}
}
?>
