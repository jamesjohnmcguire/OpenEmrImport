<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_aco_sections Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_aco_sections
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
		$this->debug->Show(Debug::DEBUG, "gacl_aco_sections::Delete");

		$query = "DELETE FROM gacl_aco_sections ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_aco_sections::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_aco_sections";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_aco_sectionss = $this->database->GetAll($sql);

		return $gacl_aco_sectionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM gacl_aco_sections WHERE id = '$id'";

		$gacl_aco_sectionsRecord = $this->database->GetRow($sql);

		return $gacl_aco_sectionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($value, $order_value, $name, $hidden)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aco_sections::Insert");

		$sql = "INSERT INTO gacl_aco_sections (value, order_value, name, hidden)".
			" VALUES ('$value', '" + "'$order_value', '" + "'$name', '" + "'$hidden')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_aco_sections::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $value, $order_value, $name, $hidden)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aco_sections::Update");

		$sql = "UPDATE gacl_aco_sections SET ".
				@"value='$value'," + 
				@"order_value='$order_value'," + 
				@"name='$name'," + 
				@"hidden='$hidden'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_aco_sections::Update return: $result");

		return $result;
	}
}
?>
