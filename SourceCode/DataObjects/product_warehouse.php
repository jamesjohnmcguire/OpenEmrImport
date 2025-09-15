<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a product_warehouse Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class product_warehouse
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
	function Delete($pw_drug_id)
	{
		$this->debug->Show(Debug::DEBUG, "product_warehouse::Delete");

		$query = "DELETE FROM product_warehouse ".
			"WHERE pw_drug_id = '$pw_drug_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "product_warehouse::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM product_warehouse";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$product_warehouses = $this->database->GetAll($sql);

		return $product_warehouses;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pw_drug_id)
	{
		$sql = "SELECT * FROM product_warehouse WHERE pw_drug_id = '$pw_drug_id'";

		$product_warehouseRecord = $this->database->GetRow($sql);

		return $product_warehouseRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pw_warehouse, $pw_min_level, $pw_max_level)
	{
		$this->debug->Show(Debug::DEBUG, "product_warehouse::Insert");

		$sql = "INSERT INTO product_warehouse (pw_warehouse, pw_min_level, pw_max_level)".
			" VALUES ('$pw_warehouse', '" + "'$pw_min_level', '" + "'$pw_max_level')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "product_warehouse::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pw_drug_id, $pw_warehouse, $pw_min_level, $pw_max_level)
	{
		$this->debug->Show(Debug::DEBUG, "product_warehouse::Update");

		$sql = "UPDATE product_warehouse SET ".
				@"pw_warehouse='$pw_warehouse'," + 
				@"pw_min_level='$pw_min_level'," + 
				@"pw_max_level='$pw_max_level'" + 
				
				"WHERE pw_drug_id = '$pw_drug_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "product_warehouse::Update return: $result");

		return $result;
	}
}
?>
