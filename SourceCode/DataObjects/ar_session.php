<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a ar_session Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class ar_session
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
	function Delete($session_id)
	{
		$this->debug->Show(Debug::DEBUG, "ar_session::Delete");

		$query = "DELETE FROM ar_session ".
			"WHERE session_id = '$session_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "ar_session::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM ar_session";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$ar_sessions = $this->database->GetAll($sql);

		return $ar_sessions;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($session_id)
	{
		$sql = "SELECT * FROM ar_session WHERE session_id = '$session_id'";

		$ar_sessionRecord = $this->database->GetRow($sql);

		return $ar_sessionRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($payer_id, $user_id, $closed, $reference, $check_date, $deposit_date, $pay_total, $created_time, $modified_time, $global_amount, $payment_type, $description, $adjustment_code, $post_to_date, $patient_id, $payment_method)
	{
		$this->debug->Show(Debug::DEBUG, "ar_session::Insert");

		$sql = "INSERT INTO ar_session (payer_id, user_id, closed, reference, check_date, deposit_date, pay_total, created_time, modified_time, global_amount, payment_type, description, adjustment_code, post_to_date, patient_id, payment_method)".
			" VALUES ('$payer_id', '" + "'$user_id', '" + "'$closed', '" + "'$reference', '" + "'$check_date', '" + "'$deposit_date', '" + "'$pay_total', '" + "'$created_time', '" + "'$modified_time', '" + "'$global_amount', '" + "'$payment_type', '" + "'$description', '" + "'$adjustment_code', '" + "'$post_to_date', '" + "'$patient_id', '" + "'$payment_method')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "ar_session::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($session_id, $payer_id, $user_id, $closed, $reference, $check_date, $deposit_date, $pay_total, $created_time, $modified_time, $global_amount, $payment_type, $description, $adjustment_code, $post_to_date, $patient_id, $payment_method)
	{
		$this->debug->Show(Debug::DEBUG, "ar_session::Update");

		$sql = "UPDATE ar_session SET ".
				@"payer_id='$payer_id'," + 
				@"user_id='$user_id'," + 
				@"closed='$closed'," + 
				@"reference='$reference'," + 
				@"check_date='$check_date'," + 
				@"deposit_date='$deposit_date'," + 
				@"pay_total='$pay_total'," + 
				@"created_time='$created_time'," + 
				@"modified_time='$modified_time'," + 
				@"global_amount='$global_amount'," + 
				@"payment_type='$payment_type'," + 
				@"description='$description'," + 
				@"adjustment_code='$adjustment_code'," + 
				@"post_to_date='$post_to_date'," + 
				@"patient_id='$patient_id'," + 
				@"payment_method='$payment_method'" + 
				
				"WHERE session_id = '$session_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "ar_session::Update return: $result");

		return $result;
	}
}
?>
