<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a syndromic_surveillance Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class syndromic_surveillance
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
		$this->debug->Show(Debug::DEBUG, "syndromic_surveillance::Delete");

		$query = "DELETE FROM syndromic_surveillance ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "syndromic_surveillance::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM syndromic_surveillance";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$syndromic_surveillances = $this->database->GetAll($sql);

		return $syndromic_surveillances;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM syndromic_surveillance WHERE id = '$id'";

		$syndromic_surveillanceRecord = $this->database->GetRow($sql);

		return $syndromic_surveillanceRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($lists_id, $submission_date, $filename)
	{
		$this->debug->Show(Debug::DEBUG, "syndromic_surveillance::Insert");

		$sql = "INSERT INTO syndromic_surveillance (lists_id, submission_date, filename)".
			" VALUES ('$lists_id', '" + "'$submission_date', '" + "'$filename')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "syndromic_surveillance::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $lists_id, $submission_date, $filename)
	{
		$this->debug->Show(Debug::DEBUG, "syndromic_surveillance::Update");

		$sql = "UPDATE syndromic_surveillance SET ".
				@"lists_id='$lists_id'," + 
				@"submission_date='$submission_date'," + 
				@"filename='$filename'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "syndromic_surveillance::Update return: $result");

		return $result;
	}
}
?>
