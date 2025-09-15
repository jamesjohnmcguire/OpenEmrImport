<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_aro_map Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_aro_map
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
		$this->debug->Show(Debug::DEBUG, "gacl_aro_map::Delete");

		$query = "DELETE FROM gacl_aro_map ".
			"WHERE acl_id = '$acl_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_aro_map::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_aro_map";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_aro_maps = $this->database->GetAll($sql);

		return $gacl_aro_maps;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($acl_id)
	{
		$sql = "SELECT * FROM gacl_aro_map WHERE acl_id = '$acl_id'";

		$gacl_aro_mapRecord = $this->database->GetRow($sql);

		return $gacl_aro_mapRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($section_value, $value)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aro_map::Insert");

		$sql = "INSERT INTO gacl_aro_map (section_value, value)".
			" VALUES ('$section_value', '" + "'$value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_aro_map::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($acl_id, $section_value, $value)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aro_map::Update");

		$sql = "UPDATE gacl_aro_map SET ".
				@"section_value='$section_value'," + 
				@"value='$value'" + 
				
				"WHERE acl_id = '$acl_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_aro_map::Update return: $result");

		return $result;
	}
}
?>
