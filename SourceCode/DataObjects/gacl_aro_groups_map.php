<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_aro_groups_map Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_aro_groups_map
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
	function Delete($acl_id)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_map::Delete");

		$query = "DELETE FROM gacl_aro_groups_map ".
			"WHERE acl_id = '$acl_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_map::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_aro_groups_map";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_aro_groups_maps = $this->database->GetAll($sql);

		return $gacl_aro_groups_maps;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($acl_id)
	{
		$sql = "SELECT * FROM gacl_aro_groups_map WHERE acl_id = '$acl_id'";

		$gacl_aro_groups_mapRecord = $this->database->GetRow($sql);

		return $gacl_aro_groups_mapRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($group_id)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_map::Insert");

		$sql = "INSERT INTO gacl_aro_groups_map (group_id)".
			" VALUES ('$group_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_map::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($acl_id, $group_id)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_map::Update");

		$sql = "UPDATE gacl_aro_groups_map SET ".
				@"group_id='$group_id'" + 
				
				"WHERE acl_id = '$acl_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_map::Update return: $result");

		return $result;
	}
}
?>
