<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_eye_mag_orders Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_eye_mag_orders
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
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_orders::Delete");

		$query = "DELETE FROM form_eye_mag_orders ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_orders::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_eye_mag_orders";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_eye_mag_orderss = $this->database->GetAll($sql);

		return $form_eye_mag_orderss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_eye_mag_orders WHERE id = '$id'";

		$form_eye_mag_ordersRecord = $this->database->GetRow($sql);

		return $form_eye_mag_ordersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ORDER_PID, $ORDER_DETAILS, $ORDER_STATUS, $ORDER_PRIORITY, $ORDER_DATE_PLACED, $ORDER_PLACED_BYWHOM, $ORDER_DATE_COMPLETED, $ORDER_COMPLETED_BYWHOM)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_orders::Insert");

		$sql = "INSERT INTO form_eye_mag_orders (ORDER_PID, ORDER_DETAILS, ORDER_STATUS, ORDER_PRIORITY, ORDER_DATE_PLACED, ORDER_PLACED_BYWHOM, ORDER_DATE_COMPLETED, ORDER_COMPLETED_BYWHOM)".
			" VALUES ('$ORDER_PID', '" + "'$ORDER_DETAILS', '" + "'$ORDER_STATUS', '" + "'$ORDER_PRIORITY', '" + "'$ORDER_DATE_PLACED', '" + "'$ORDER_PLACED_BYWHOM', '" + "'$ORDER_DATE_COMPLETED', '" + "'$ORDER_COMPLETED_BYWHOM')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_orders::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $ORDER_PID, $ORDER_DETAILS, $ORDER_STATUS, $ORDER_PRIORITY, $ORDER_DATE_PLACED, $ORDER_PLACED_BYWHOM, $ORDER_DATE_COMPLETED, $ORDER_COMPLETED_BYWHOM)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_orders::Update");

		$sql = "UPDATE form_eye_mag_orders SET ".
				@"ORDER_PID='$ORDER_PID'," + 
				@"ORDER_DETAILS='$ORDER_DETAILS'," + 
				@"ORDER_STATUS='$ORDER_STATUS'," + 
				@"ORDER_PRIORITY='$ORDER_PRIORITY'," + 
				@"ORDER_DATE_PLACED='$ORDER_DATE_PLACED'," + 
				@"ORDER_PLACED_BYWHOM='$ORDER_PLACED_BYWHOM'," + 
				@"ORDER_DATE_COMPLETED='$ORDER_DATE_COMPLETED'," + 
				@"ORDER_COMPLETED_BYWHOM='$ORDER_COMPLETED_BYWHOM'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_orders::Update return: $result");

		return $result;
	}
}
?>
