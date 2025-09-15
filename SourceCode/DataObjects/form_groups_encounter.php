<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_groups_encounter Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_groups_encounter
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
		$this->debug->Show(Debug::DEBUG, "form_groups_encounter::Delete");

		$query = "DELETE FROM form_groups_encounter ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_groups_encounter::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_groups_encounter";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_groups_encounters = $this->database->GetAll($sql);

		return $form_groups_encounters;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_groups_encounter WHERE id = '$id'";

		$form_groups_encounterRecord = $this->database->GetRow($sql);

		return $form_groups_encounterRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $reason, $facility, $facility_id, $group_id, $encounter, $onset_date, $sensitivity, $billing_note, $pc_catid, $last_level_billed, $last_level_closed, $last_stmt_date, $stmt_count, $provider_id, $supervisor_id, $invoice_refno, $referral_source, $billing_facility, $external_id, $pos_code, $counselors, $appt_id)
	{
		$this->debug->Show(Debug::DEBUG, "form_groups_encounter::Insert");

		$sql = "INSERT INTO form_groups_encounter (date, reason, facility, facility_id, group_id, encounter, onset_date, sensitivity, billing_note, pc_catid, last_level_billed, last_level_closed, last_stmt_date, stmt_count, provider_id, supervisor_id, invoice_refno, referral_source, billing_facility, external_id, pos_code, counselors, appt_id)".
			" VALUES ('$date', '" + "'$reason', '" + "'$facility', '" + "'$facility_id', '" + "'$group_id', '" + "'$encounter', '" + "'$onset_date', '" + "'$sensitivity', '" + "'$billing_note', '" + "'$pc_catid', '" + "'$last_level_billed', '" + "'$last_level_closed', '" + "'$last_stmt_date', '" + "'$stmt_count', '" + "'$provider_id', '" + "'$supervisor_id', '" + "'$invoice_refno', '" + "'$referral_source', '" + "'$billing_facility', '" + "'$external_id', '" + "'$pos_code', '" + "'$counselors', '" + "'$appt_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_groups_encounter::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $reason, $facility, $facility_id, $group_id, $encounter, $onset_date, $sensitivity, $billing_note, $pc_catid, $last_level_billed, $last_level_closed, $last_stmt_date, $stmt_count, $provider_id, $supervisor_id, $invoice_refno, $referral_source, $billing_facility, $external_id, $pos_code, $counselors, $appt_id)
	{
		$this->debug->Show(Debug::DEBUG, "form_groups_encounter::Update");

		$sql = "UPDATE form_groups_encounter SET ".
				@"date='$date'," + 
				@"reason='$reason'," + 
				@"facility='$facility'," + 
				@"facility_id='$facility_id'," + 
				@"group_id='$group_id'," + 
				@"encounter='$encounter'," + 
				@"onset_date='$onset_date'," + 
				@"sensitivity='$sensitivity'," + 
				@"billing_note='$billing_note'," + 
				@"pc_catid='$pc_catid'," + 
				@"last_level_billed='$last_level_billed'," + 
				@"last_level_closed='$last_level_closed'," + 
				@"last_stmt_date='$last_stmt_date'," + 
				@"stmt_count='$stmt_count'," + 
				@"provider_id='$provider_id'," + 
				@"supervisor_id='$supervisor_id'," + 
				@"invoice_refno='$invoice_refno'," + 
				@"referral_source='$referral_source'," + 
				@"billing_facility='$billing_facility'," + 
				@"external_id='$external_id'," + 
				@"pos_code='$pos_code'," + 
				@"counselors='$counselors'," + 
				@"appt_id='$appt_id'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_groups_encounter::Update return: $result");

		return $result;
	}
}
?>
