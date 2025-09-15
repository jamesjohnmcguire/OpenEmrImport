<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a patient_access_onsite Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class patient_access_onsite
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
		$this->debug->Show(Debug::DEBUG, "patient_access_onsite::Delete");

		$query = "DELETE FROM patient_access_onsite ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "patient_access_onsite::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM patient_access_onsite";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$patient_access_onsites = $this->database->GetAll($sql);

		return $patient_access_onsites;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM patient_access_onsite WHERE id = '$id'";

		$patient_access_onsiteRecord = $this->database->GetRow($sql);

		return $patient_access_onsiteRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $portal_username, $portal_pwd, $portal_pwd_status, $portal_salt)
	{
		$this->debug->Show(Debug::DEBUG, "patient_access_onsite::Insert");

		$sql = "INSERT INTO patient_access_onsite (pid, portal_username, portal_pwd, portal_pwd_status, portal_salt)".
			" VALUES ('$pid', '" + "'$portal_username', '" + "'$portal_pwd', '" + "'$portal_pwd_status', '" + "'$portal_salt')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "patient_access_onsite::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $pid, $portal_username, $portal_pwd, $portal_pwd_status, $portal_salt)
	{
		$this->debug->Show(Debug::DEBUG, "patient_access_onsite::Update");

		$sql = "UPDATE patient_access_onsite SET ".
				@"pid='$pid'," + 
				@"portal_username='$portal_username'," + 
				@"portal_pwd='$portal_pwd'," + 
				@"portal_pwd_status='$portal_pwd_status'," + 
				@"portal_salt='$portal_salt'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "patient_access_onsite::Update return: $result");

		return $result;
	}
}
?>
