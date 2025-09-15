<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a payment_gateway_details Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class payment_gateway_details
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
		$this->debug->Show(Debug::DEBUG, "payment_gateway_details::Delete");

		$query = "DELETE FROM payment_gateway_details ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "payment_gateway_details::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM payment_gateway_details";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$payment_gateway_detailss = $this->database->GetAll($sql);

		return $payment_gateway_detailss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM payment_gateway_details WHERE id = '$id'";

		$payment_gateway_detailsRecord = $this->database->GetRow($sql);

		return $payment_gateway_detailsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($service_name, $login_id, $transaction_key, $md5)
	{
		$this->debug->Show(Debug::DEBUG, "payment_gateway_details::Insert");

		$sql = "INSERT INTO payment_gateway_details (service_name, login_id, transaction_key, md5)".
			" VALUES ('$service_name', '" + "'$login_id', '" + "'$transaction_key', '" + "'$md5')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "payment_gateway_details::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $service_name, $login_id, $transaction_key, $md5)
	{
		$this->debug->Show(Debug::DEBUG, "payment_gateway_details::Update");

		$sql = "UPDATE payment_gateway_details SET ".
				@"service_name='$service_name'," + 
				@"login_id='$login_id'," + 
				@"transaction_key='$transaction_key'," + 
				@"md5='$md5'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "payment_gateway_details::Update return: $result");

		return $result;
	}
}
?>
