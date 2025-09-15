<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a geo_zone_reference Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class geo_zone_reference
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
	function Delete($zone_id)
	{
		$this->debug->Show(Debug::DEBUG, "geo_zone_reference::Delete");

		$query = "DELETE FROM geo_zone_reference ".
			"WHERE zone_id = '$zone_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "geo_zone_reference::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM geo_zone_reference";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$geo_zone_references = $this->database->GetAll($sql);

		return $geo_zone_references;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($zone_id)
	{
		$sql = "SELECT * FROM geo_zone_reference WHERE zone_id = '$zone_id'";

		$geo_zone_referenceRecord = $this->database->GetRow($sql);

		return $geo_zone_referenceRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($zone_country_id, $zone_code, $zone_name)
	{
		$this->debug->Show(Debug::DEBUG, "geo_zone_reference::Insert");

		$sql = "INSERT INTO geo_zone_reference (zone_country_id, zone_code, zone_name)".
			" VALUES ('$zone_country_id', '" + "'$zone_code', '" + "'$zone_name')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "geo_zone_reference::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($zone_id, $zone_country_id, $zone_code, $zone_name)
	{
		$this->debug->Show(Debug::DEBUG, "geo_zone_reference::Update");

		$sql = "UPDATE geo_zone_reference SET ".
				@"zone_country_id='$zone_country_id'," + 
				@"zone_code='$zone_code'," + 
				@"zone_name='$zone_name'" + 
				
				"WHERE zone_id = '$zone_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "geo_zone_reference::Update return: $result");

		return $result;
	}
}
?>
