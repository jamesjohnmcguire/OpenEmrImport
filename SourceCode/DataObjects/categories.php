<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a categories Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class categories
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
		$this->debug->Show(Debug::DEBUG, "categories::Delete");

		$query = "DELETE FROM categories ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "categories::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM categories";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$categoriess = $this->database->GetAll($sql);

		return $categoriess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM categories WHERE id = '$id'";

		$categoriesRecord = $this->database->GetRow($sql);

		return $categoriesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($name, $value, $parent, $lft, $rght, $aco_spec)
	{
		$this->debug->Show(Debug::DEBUG, "categories::Insert");

		$sql = "INSERT INTO categories (name, value, parent, lft, rght, aco_spec)".
			" VALUES ('$name', '" + "'$value', '" + "'$parent', '" + "'$lft', '" + "'$rght', '" + "'$aco_spec')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "categories::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $name, $value, $parent, $lft, $rght, $aco_spec)
	{
		$this->debug->Show(Debug::DEBUG, "categories::Update");

		$sql = "UPDATE categories SET ".
				@"name='$name'," + 
				@"value='$value'," + 
				@"parent='$parent'," + 
				@"lft='$lft'," + 
				@"rght='$rght'," + 
				@"aco_spec='$aco_spec'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "categories::Update return: $result");

		return $result;
	}
}
?>
