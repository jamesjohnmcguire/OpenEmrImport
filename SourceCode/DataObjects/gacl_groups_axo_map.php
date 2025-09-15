<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_groups_axo_map Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_groups_axo_map
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
	function Delete($group_id)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_groups_axo_map::Delete");

		$query = "DELETE FROM gacl_groups_axo_map ".
			"WHERE group_id = '$group_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_groups_axo_map::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_groups_axo_map";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_groups_axo_maps = $this->database->GetAll($sql);

		return $gacl_groups_axo_maps;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($group_id)
	{
		$sql = "SELECT * FROM gacl_groups_axo_map WHERE group_id = '$group_id'";

		$gacl_groups_axo_mapRecord = $this->database->GetRow($sql);

		return $gacl_groups_axo_mapRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($axo_id)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_groups_axo_map::Insert");

		$sql = "INSERT INTO gacl_groups_axo_map (axo_id)".
			" VALUES ('$axo_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_groups_axo_map::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($group_id, $axo_id)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_groups_axo_map::Update");

		$sql = "UPDATE gacl_groups_axo_map SET ".
				@"axo_id='$axo_id'" + 
				
				"WHERE group_id = '$group_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_groups_axo_map::Update return: $result");

		return $result;
	}
}
?>
