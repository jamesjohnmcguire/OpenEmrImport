<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_aco Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_aco
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
		$this->debug->Show(Debug::DEBUG, "gacl_aco::Delete");

		$query = "DELETE FROM gacl_aco ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_aco::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_aco";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_acos = $this->database->GetAll($sql);

		return $gacl_acos;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM gacl_aco WHERE id = '$id'";

		$gacl_acoRecord = $this->database->GetRow($sql);

		return $gacl_acoRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($section_value, $value, $order_value, $name, $hidden)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aco::Insert");

		$sql = "INSERT INTO gacl_aco (section_value, value, order_value, name, hidden)".
			" VALUES ('$section_value', '" + "'$value', '" + "'$order_value', '" + "'$name', '" + "'$hidden')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_aco::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $section_value, $value, $order_value, $name, $hidden)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aco::Update");

		$sql = "UPDATE gacl_aco SET ".
				@"section_value='$section_value'," + 
				@"value='$value'," + 
				@"order_value='$order_value'," + 
				@"name='$name'," + 
				@"hidden='$hidden'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_aco::Update return: $result");

		return $result;
	}
}
?>
