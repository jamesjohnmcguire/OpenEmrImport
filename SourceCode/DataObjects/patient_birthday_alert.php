<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a patient_birthday_alert Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class patient_birthday_alert
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
	function Delete($pid)
	{
		$this->debug->Show(Debug::DEBUG, "patient_birthday_alert::Delete");

		$query = "DELETE FROM patient_birthday_alert ".
			"WHERE pid = '$pid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "patient_birthday_alert::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM patient_birthday_alert";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$patient_birthday_alerts = $this->database->GetAll($sql);

		return $patient_birthday_alerts;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pid)
	{
		$sql = "SELECT * FROM patient_birthday_alert WHERE pid = '$pid'";

		$patient_birthday_alertRecord = $this->database->GetRow($sql);

		return $patient_birthday_alertRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($user_id, $turned_off_on)
	{
		$this->debug->Show(Debug::DEBUG, "patient_birthday_alert::Insert");

		$sql = "INSERT INTO patient_birthday_alert (user_id, turned_off_on)".
			" VALUES ('$user_id', '" + "'$turned_off_on')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "patient_birthday_alert::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pid, $user_id, $turned_off_on)
	{
		$this->debug->Show(Debug::DEBUG, "patient_birthday_alert::Update");

		$sql = "UPDATE patient_birthday_alert SET ".
				@"user_id='$user_id'," + 
				@"turned_off_on='$turned_off_on'" + 
				
				"WHERE pid = '$pid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "patient_birthday_alert::Update return: $result");

		return $result;
	}
}
?>
