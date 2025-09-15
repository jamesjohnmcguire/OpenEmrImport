<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_acl_sections Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_acl_sections
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
		$this->debug->Show(Debug::DEBUG, "gacl_acl_sections::Delete");

		$query = "DELETE FROM gacl_acl_sections ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_acl_sections::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_acl_sections";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_acl_sectionss = $this->database->GetAll($sql);

		return $gacl_acl_sectionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM gacl_acl_sections WHERE id = '$id'";

		$gacl_acl_sectionsRecord = $this->database->GetRow($sql);

		return $gacl_acl_sectionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($value, $order_value, $name, $hidden)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_acl_sections::Insert");

		$sql = "INSERT INTO gacl_acl_sections (value, order_value, name, hidden)".
			" VALUES ('$value', '" + "'$order_value', '" + "'$name', '" + "'$hidden')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_acl_sections::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $value, $order_value, $name, $hidden)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_acl_sections::Update");

		$sql = "UPDATE gacl_acl_sections SET ".
				@"value='$value'," + 
				@"order_value='$order_value'," + 
				@"name='$name'," + 
				@"hidden='$hidden'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_acl_sections::Update return: $result");

		return $result;
	}
}
?>
