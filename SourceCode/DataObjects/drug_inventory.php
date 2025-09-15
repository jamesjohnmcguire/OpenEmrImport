<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a drug_inventory Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class drug_inventory
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
	function Delete($inventory_id)
	{
		$this->debug->Show(Debug::DEBUG, "drug_inventory::Delete");

		$query = "DELETE FROM drug_inventory ".
			"WHERE inventory_id = '$inventory_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "drug_inventory::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM drug_inventory";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$drug_inventorys = $this->database->GetAll($sql);

		return $drug_inventorys;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($inventory_id)
	{
		$sql = "SELECT * FROM drug_inventory WHERE inventory_id = '$inventory_id'";

		$drug_inventoryRecord = $this->database->GetRow($sql);

		return $drug_inventoryRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($drug_id, $lot_number, $expiration, $manufacturer, $on_hand, $warehouse_id, $vendor_id, $last_notify, $destroy_date, $destroy_method, $destroy_witness, $destroy_notes)
	{
		$this->debug->Show(Debug::DEBUG, "drug_inventory::Insert");

		$sql = "INSERT INTO drug_inventory (drug_id, lot_number, expiration, manufacturer, on_hand, warehouse_id, vendor_id, last_notify, destroy_date, destroy_method, destroy_witness, destroy_notes)".
			" VALUES ('$drug_id', '" + "'$lot_number', '" + "'$expiration', '" + "'$manufacturer', '" + "'$on_hand', '" + "'$warehouse_id', '" + "'$vendor_id', '" + "'$last_notify', '" + "'$destroy_date', '" + "'$destroy_method', '" + "'$destroy_witness', '" + "'$destroy_notes')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "drug_inventory::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($inventory_id, $drug_id, $lot_number, $expiration, $manufacturer, $on_hand, $warehouse_id, $vendor_id, $last_notify, $destroy_date, $destroy_method, $destroy_witness, $destroy_notes)
	{
		$this->debug->Show(Debug::DEBUG, "drug_inventory::Update");

		$sql = "UPDATE drug_inventory SET ".
				@"drug_id='$drug_id'," + 
				@"lot_number='$lot_number'," + 
				@"expiration='$expiration'," + 
				@"manufacturer='$manufacturer'," + 
				@"on_hand='$on_hand'," + 
				@"warehouse_id='$warehouse_id'," + 
				@"vendor_id='$vendor_id'," + 
				@"last_notify='$last_notify'," + 
				@"destroy_date='$destroy_date'," + 
				@"destroy_method='$destroy_method'," + 
				@"destroy_witness='$destroy_witness'," + 
				@"destroy_notes='$destroy_notes'" + 
				
				"WHERE inventory_id = '$inventory_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "drug_inventory::Update return: $result");

		return $result;
	}
}
?>
