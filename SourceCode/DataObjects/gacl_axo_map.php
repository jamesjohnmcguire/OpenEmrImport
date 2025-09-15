<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_axo_map Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_axo_map
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
		$this->debug->Show(Debug::DEBUG, "gacl_axo_map::Delete");

		$query = "DELETE FROM gacl_axo_map ".
			"WHERE acl_id = '$acl_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_axo_map::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_axo_map";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_axo_maps = $this->database->GetAll($sql);

		return $gacl_axo_maps;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($acl_id)
	{
		$sql = "SELECT * FROM gacl_axo_map WHERE acl_id = '$acl_id'";

		$gacl_axo_mapRecord = $this->database->GetRow($sql);

		return $gacl_axo_mapRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($section_value, $value)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_axo_map::Insert");

		$sql = "INSERT INTO gacl_axo_map (section_value, value)".
			" VALUES ('$section_value', '" + "'$value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_axo_map::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($acl_id, $section_value, $value)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_axo_map::Update");

		$sql = "UPDATE gacl_axo_map SET ".
				@"section_value='$section_value'," + 
				@"value='$value'" + 
				
				"WHERE acl_id = '$acl_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_axo_map::Update return: $result");

		return $result;
	}
}
?>
