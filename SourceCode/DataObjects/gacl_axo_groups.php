<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_axo_groups Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_axo_groups
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
		$this->debug->Show(Debug::DEBUG, "gacl_axo_groups::Delete");

		$query = "DELETE FROM gacl_axo_groups ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_axo_groups::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_axo_groups";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_axo_groupss = $this->database->GetAll($sql);

		return $gacl_axo_groupss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM gacl_axo_groups WHERE id = '$id'";

		$gacl_axo_groupsRecord = $this->database->GetRow($sql);

		return $gacl_axo_groupsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($parent_id, $lft, $rgt, $name, $value)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_axo_groups::Insert");

		$sql = "INSERT INTO gacl_axo_groups (parent_id, lft, rgt, name, value)".
			" VALUES ('$parent_id', '" + "'$lft', '" + "'$rgt', '" + "'$name', '" + "'$value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_axo_groups::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $parent_id, $lft, $rgt, $name, $value)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_axo_groups::Update");

		$sql = "UPDATE gacl_axo_groups SET ".
				@"parent_id='$parent_id'," + 
				@"lft='$lft'," + 
				@"rgt='$rgt'," + 
				@"name='$name'," + 
				@"value='$value'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_axo_groups::Update return: $result");

		return $result;
	}
}
?>
