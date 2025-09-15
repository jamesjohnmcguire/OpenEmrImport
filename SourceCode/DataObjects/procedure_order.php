<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a procedure_order Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class procedure_order
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
	function Delete($procedure_order_id)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_order::Delete");

		$query = "DELETE FROM procedure_order ".
			"WHERE procedure_order_id = '$procedure_order_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "procedure_order::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM procedure_order";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$procedure_orders = $this->database->GetAll($sql);

		return $procedure_orders;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($procedure_order_id)
	{
		$sql = "SELECT * FROM procedure_order WHERE procedure_order_id = '$procedure_order_id'";

		$procedure_orderRecord = $this->database->GetRow($sql);

		return $procedure_orderRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($provider_id, $patient_id, $encounter_id, $date_collected, $date_ordered, $order_priority, $order_status, $patient_instructions, $activity, $control_id, $lab_id, $specimen_type, $specimen_location, $specimen_volume, $date_transmitted, $clinical_hx, $external_id, $history_order)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_order::Insert");

		$sql = "INSERT INTO procedure_order (provider_id, patient_id, encounter_id, date_collected, date_ordered, order_priority, order_status, patient_instructions, activity, control_id, lab_id, specimen_type, specimen_location, specimen_volume, date_transmitted, clinical_hx, external_id, history_order)".
			" VALUES ('$provider_id', '" + "'$patient_id', '" + "'$encounter_id', '" + "'$date_collected', '" + "'$date_ordered', '" + "'$order_priority', '" + "'$order_status', '" + "'$patient_instructions', '" + "'$activity', '" + "'$control_id', '" + "'$lab_id', '" + "'$specimen_type', '" + "'$specimen_location', '" + "'$specimen_volume', '" + "'$date_transmitted', '" + "'$clinical_hx', '" + "'$external_id', '" + "'$history_order')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_order::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($procedure_order_id, $provider_id, $patient_id, $encounter_id, $date_collected, $date_ordered, $order_priority, $order_status, $patient_instructions, $activity, $control_id, $lab_id, $specimen_type, $specimen_location, $specimen_volume, $date_transmitted, $clinical_hx, $external_id, $history_order)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_order::Update");

		$sql = "UPDATE procedure_order SET ".
				@"provider_id='$provider_id'," + 
				@"patient_id='$patient_id'," + 
				@"encounter_id='$encounter_id'," + 
				@"date_collected='$date_collected'," + 
				@"date_ordered='$date_ordered'," + 
				@"order_priority='$order_priority'," + 
				@"order_status='$order_status'," + 
				@"patient_instructions='$patient_instructions'," + 
				@"activity='$activity'," + 
				@"control_id='$control_id'," + 
				@"lab_id='$lab_id'," + 
				@"specimen_type='$specimen_type'," + 
				@"specimen_location='$specimen_location'," + 
				@"specimen_volume='$specimen_volume'," + 
				@"date_transmitted='$date_transmitted'," + 
				@"clinical_hx='$clinical_hx'," + 
				@"external_id='$external_id'," + 
				@"history_order='$history_order'" + 
				
				"WHERE procedure_order_id = '$procedure_order_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_order::Update return: $result");

		return $result;
	}
}
?>
