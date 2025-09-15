<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a billing Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class billing
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
		$this->debug->Show(Debug::DEBUG, "billing::Delete");

		$query = "DELETE FROM billing ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "billing::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM billing";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$billings = $this->database->GetAll($sql);

		return $billings;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM billing WHERE id = '$id'";

		$billingRecord = $this->database->GetRow($sql);

		return $billingRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $code_type, $code, $pid, $provider_id, $user, $groupname, $authorized, $encounter, $code_text, $billed, $activity, $payer_id, $bill_process, $bill_date, $process_date, $process_file, $modifier, $units, $fee, $justify, $target, $x12_partner_id, $ndc_info, $notecodes, $external_id, $pricelevel, $revenue_code)
	{
		$this->debug->Show(Debug::DEBUG, "billing::Insert");

		$sql = "INSERT INTO billing (date, code_type, code, pid, provider_id, user, groupname, authorized, encounter, code_text, billed, activity, payer_id, bill_process, bill_date, process_date, process_file, modifier, units, fee, justify, target, x12_partner_id, ndc_info, notecodes, external_id, pricelevel, revenue_code)".
			" VALUES ('$date', '" + "'$code_type', '" + "'$code', '" + "'$pid', '" + "'$provider_id', '" + "'$user', '" + "'$groupname', '" + "'$authorized', '" + "'$encounter', '" + "'$code_text', '" + "'$billed', '" + "'$activity', '" + "'$payer_id', '" + "'$bill_process', '" + "'$bill_date', '" + "'$process_date', '" + "'$process_file', '" + "'$modifier', '" + "'$units', '" + "'$fee', '" + "'$justify', '" + "'$target', '" + "'$x12_partner_id', '" + "'$ndc_info', '" + "'$notecodes', '" + "'$external_id', '" + "'$pricelevel', '" + "'$revenue_code')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "billing::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $code_type, $code, $pid, $provider_id, $user, $groupname, $authorized, $encounter, $code_text, $billed, $activity, $payer_id, $bill_process, $bill_date, $process_date, $process_file, $modifier, $units, $fee, $justify, $target, $x12_partner_id, $ndc_info, $notecodes, $external_id, $pricelevel, $revenue_code)
	{
		$this->debug->Show(Debug::DEBUG, "billing::Update");

		$sql = "UPDATE billing SET ".
				@"date='$date'," + 
				@"code_type='$code_type'," + 
				@"code='$code'," + 
				@"pid='$pid'," + 
				@"provider_id='$provider_id'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'," + 
				@"encounter='$encounter'," + 
				@"code_text='$code_text'," + 
				@"billed='$billed'," + 
				@"activity='$activity'," + 
				@"payer_id='$payer_id'," + 
				@"bill_process='$bill_process'," + 
				@"bill_date='$bill_date'," + 
				@"process_date='$process_date'," + 
				@"process_file='$process_file'," + 
				@"modifier='$modifier'," + 
				@"units='$units'," + 
				@"fee='$fee'," + 
				@"justify='$justify'," + 
				@"target='$target'," + 
				@"x12_partner_id='$x12_partner_id'," + 
				@"ndc_info='$ndc_info'," + 
				@"notecodes='$notecodes'," + 
				@"external_id='$external_id'," + 
				@"pricelevel='$pricelevel'," + 
				@"revenue_code='$revenue_code'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "billing::Update return: $result");

		return $result;
	}
}
?>
