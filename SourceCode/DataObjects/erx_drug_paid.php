<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a erx_drug_paid Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class erx_drug_paid
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
	function Delete($drugid)
	{
		$this->debug->Show(Debug::DEBUG, "erx_drug_paid::Delete");

		$query = "DELETE FROM erx_drug_paid ".
			"WHERE drugid = '$drugid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "erx_drug_paid::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM erx_drug_paid";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$erx_drug_paids = $this->database->GetAll($sql);

		return $erx_drug_paids;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($drugid)
	{
		$sql = "SELECT * FROM erx_drug_paid WHERE drugid = '$drugid'";

		$erx_drug_paidRecord = $this->database->GetRow($sql);

		return $erx_drug_paidRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($drug_label_name, $ahfs_descr, $ndc, $price_per_unit, $avg_price, $avg_price_paid, $avg_savings, $avg_percent)
	{
		$this->debug->Show(Debug::DEBUG, "erx_drug_paid::Insert");

		$sql = "INSERT INTO erx_drug_paid (drug_label_name, ahfs_descr, ndc, price_per_unit, avg_price, avg_price_paid, avg_savings, avg_percent)".
			" VALUES ('$drug_label_name', '" + "'$ahfs_descr', '" + "'$ndc', '" + "'$price_per_unit', '" + "'$avg_price', '" + "'$avg_price_paid', '" + "'$avg_savings', '" + "'$avg_percent')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "erx_drug_paid::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($drugid, $drug_label_name, $ahfs_descr, $ndc, $price_per_unit, $avg_price, $avg_price_paid, $avg_savings, $avg_percent)
	{
		$this->debug->Show(Debug::DEBUG, "erx_drug_paid::Update");

		$sql = "UPDATE erx_drug_paid SET ".
				@"drug_label_name='$drug_label_name'," + 
				@"ahfs_descr='$ahfs_descr'," + 
				@"ndc='$ndc'," + 
				@"price_per_unit='$price_per_unit'," + 
				@"avg_price='$avg_price'," + 
				@"avg_price_paid='$avg_price_paid'," + 
				@"avg_savings='$avg_savings'," + 
				@"avg_percent='$avg_percent'" + 
				
				"WHERE drugid = '$drugid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "erx_drug_paid::Update return: $result");

		return $result;
	}
}
?>
