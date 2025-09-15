<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a drug_sales Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class drug_sales
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
	function Delete($sale_id)
	{
		$this->debug->Show(Debug::DEBUG, "drug_sales::Delete");

		$query = "DELETE FROM drug_sales ".
			"WHERE sale_id = '$sale_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "drug_sales::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM drug_sales";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$drug_saless = $this->database->GetAll($sql);

		return $drug_saless;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($sale_id)
	{
		$sql = "SELECT * FROM drug_sales WHERE sale_id = '$sale_id'";

		$drug_salesRecord = $this->database->GetRow($sql);

		return $drug_salesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($drug_id, $inventory_id, $prescription_id, $pid, $encounter, $user, $sale_date, $quantity, $fee, $billed, $xfer_inventory_id, $distributor_id, $notes, $bill_date, $pricelevel, $selector)
	{
		$this->debug->Show(Debug::DEBUG, "drug_sales::Insert");

		$sql = "INSERT INTO drug_sales (drug_id, inventory_id, prescription_id, pid, encounter, user, sale_date, quantity, fee, billed, xfer_inventory_id, distributor_id, notes, bill_date, pricelevel, selector)".
			" VALUES ('$drug_id', '" + "'$inventory_id', '" + "'$prescription_id', '" + "'$pid', '" + "'$encounter', '" + "'$user', '" + "'$sale_date', '" + "'$quantity', '" + "'$fee', '" + "'$billed', '" + "'$xfer_inventory_id', '" + "'$distributor_id', '" + "'$notes', '" + "'$bill_date', '" + "'$pricelevel', '" + "'$selector')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "drug_sales::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($sale_id, $drug_id, $inventory_id, $prescription_id, $pid, $encounter, $user, $sale_date, $quantity, $fee, $billed, $xfer_inventory_id, $distributor_id, $notes, $bill_date, $pricelevel, $selector)
	{
		$this->debug->Show(Debug::DEBUG, "drug_sales::Update");

		$sql = "UPDATE drug_sales SET ".
				@"drug_id='$drug_id'," + 
				@"inventory_id='$inventory_id'," + 
				@"prescription_id='$prescription_id'," + 
				@"pid='$pid'," + 
				@"encounter='$encounter'," + 
				@"user='$user'," + 
				@"sale_date='$sale_date'," + 
				@"quantity='$quantity'," + 
				@"fee='$fee'," + 
				@"billed='$billed'," + 
				@"xfer_inventory_id='$xfer_inventory_id'," + 
				@"distributor_id='$distributor_id'," + 
				@"notes='$notes'," + 
				@"bill_date='$bill_date'," + 
				@"pricelevel='$pricelevel'," + 
				@"selector='$selector'" + 
				
				"WHERE sale_id = '$sale_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "drug_sales::Update return: $result");

		return $result;
	}
}
?>
