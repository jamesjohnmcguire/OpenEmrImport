<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a payments Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class payments
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
		$this->debug->Show(Debug::DEBUG, "payments::Delete");

		$query = "DELETE FROM payments ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "payments::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM payments";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$paymentss = $this->database->GetAll($sql);

		return $paymentss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM payments WHERE id = '$id'";

		$paymentsRecord = $this->database->GetRow($sql);

		return $paymentsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $dtime, $encounter, $user, $method, $source, $amount1, $amount2, $posted1, $posted2)
	{
		$this->debug->Show(Debug::DEBUG, "payments::Insert");

		$sql = "INSERT INTO payments (pid, dtime, encounter, user, method, source, amount1, amount2, posted1, posted2)".
			" VALUES ('$pid', '" + "'$dtime', '" + "'$encounter', '" + "'$user', '" + "'$method', '" + "'$source', '" + "'$amount1', '" + "'$amount2', '" + "'$posted1', '" + "'$posted2')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "payments::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $pid, $dtime, $encounter, $user, $method, $source, $amount1, $amount2, $posted1, $posted2)
	{
		$this->debug->Show(Debug::DEBUG, "payments::Update");

		$sql = "UPDATE payments SET ".
				@"pid='$pid'," + 
				@"dtime='$dtime'," + 
				@"encounter='$encounter'," + 
				@"user='$user'," + 
				@"method='$method'," + 
				@"source='$source'," + 
				@"amount1='$amount1'," + 
				@"amount2='$amount2'," + 
				@"posted1='$posted1'," + 
				@"posted2='$posted2'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "payments::Update return: $result");

		return $result;
	}
}
?>
