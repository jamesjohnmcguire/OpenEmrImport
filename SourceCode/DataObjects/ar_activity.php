<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a ar_activity Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class ar_activity
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
		$this->debug->Show(Debug::DEBUG, "ar_activity::Delete");

		$query = "DELETE FROM ar_activity ".
			"WHERE pid = '$pid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "ar_activity::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM ar_activity";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$ar_activitys = $this->database->GetAll($sql);

		return $ar_activitys;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pid)
	{
		$sql = "SELECT * FROM ar_activity WHERE pid = '$pid'";

		$ar_activityRecord = $this->database->GetRow($sql);

		return $ar_activityRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($encounter, $sequence_no, $code_type, $code, $modifier, $payer_type, $post_time, $post_user, $session_id, $memo, $pay_amount, $adj_amount, $modified_time, $follow_up, $follow_up_note, $account_code, $reason_code)
	{
		$this->debug->Show(Debug::DEBUG, "ar_activity::Insert");

		$sql = "INSERT INTO ar_activity (encounter, sequence_no, code_type, code, modifier, payer_type, post_time, post_user, session_id, memo, pay_amount, adj_amount, modified_time, follow_up, follow_up_note, account_code, reason_code)".
			" VALUES ('$encounter', '" + "'$sequence_no', '" + "'$code_type', '" + "'$code', '" + "'$modifier', '" + "'$payer_type', '" + "'$post_time', '" + "'$post_user', '" + "'$session_id', '" + "'$memo', '" + "'$pay_amount', '" + "'$adj_amount', '" + "'$modified_time', '" + "'$follow_up', '" + "'$follow_up_note', '" + "'$account_code', '" + "'$reason_code')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "ar_activity::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pid, $encounter, $sequence_no, $code_type, $code, $modifier, $payer_type, $post_time, $post_user, $session_id, $memo, $pay_amount, $adj_amount, $modified_time, $follow_up, $follow_up_note, $account_code, $reason_code)
	{
		$this->debug->Show(Debug::DEBUG, "ar_activity::Update");

		$sql = "UPDATE ar_activity SET ".
				@"encounter='$encounter'," + 
				@"sequence_no='$sequence_no'," + 
				@"code_type='$code_type'," + 
				@"code='$code'," + 
				@"modifier='$modifier'," + 
				@"payer_type='$payer_type'," + 
				@"post_time='$post_time'," + 
				@"post_user='$post_user'," + 
				@"session_id='$session_id'," + 
				@"memo='$memo'," + 
				@"pay_amount='$pay_amount'," + 
				@"adj_amount='$adj_amount'," + 
				@"modified_time='$modified_time'," + 
				@"follow_up='$follow_up'," + 
				@"follow_up_note='$follow_up_note'," + 
				@"account_code='$account_code'," + 
				@"reason_code='$reason_code'" + 
				
				"WHERE pid = '$pid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "ar_activity::Update return: $result");

		return $result;
	}
}
?>
