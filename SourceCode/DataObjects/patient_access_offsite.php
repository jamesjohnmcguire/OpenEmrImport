<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a patient_access_offsite Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class patient_access_offsite
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
		$this->debug->Show(Debug::DEBUG, "patient_access_offsite::Delete");

		$query = "DELETE FROM patient_access_offsite ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "patient_access_offsite::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM patient_access_offsite";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$patient_access_offsites = $this->database->GetAll($sql);

		return $patient_access_offsites;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM patient_access_offsite WHERE id = '$id'";

		$patient_access_offsiteRecord = $this->database->GetRow($sql);

		return $patient_access_offsiteRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $portal_username, $portal_pwd, $portal_pwd_status, $authorize_net_id, $portal_relation)
	{
		$this->debug->Show(Debug::DEBUG, "patient_access_offsite::Insert");

		$sql = "INSERT INTO patient_access_offsite (pid, portal_username, portal_pwd, portal_pwd_status, authorize_net_id, portal_relation)".
			" VALUES ('$pid', '" + "'$portal_username', '" + "'$portal_pwd', '" + "'$portal_pwd_status', '" + "'$authorize_net_id', '" + "'$portal_relation')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "patient_access_offsite::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $pid, $portal_username, $portal_pwd, $portal_pwd_status, $authorize_net_id, $portal_relation)
	{
		$this->debug->Show(Debug::DEBUG, "patient_access_offsite::Update");

		$sql = "UPDATE patient_access_offsite SET ".
				@"pid='$pid'," + 
				@"portal_username='$portal_username'," + 
				@"portal_pwd='$portal_pwd'," + 
				@"portal_pwd_status='$portal_pwd_status'," + 
				@"authorize_net_id='$authorize_net_id'," + 
				@"portal_relation='$portal_relation'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "patient_access_offsite::Update return: $result");

		return $result;
	}
}
?>
