<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a ccda_components Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class ccda_components
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
	function Delete($ccda_components_id)
	{
		$this->debug->Show(Debug::DEBUG, "ccda_components::Delete");

		$query = "DELETE FROM ccda_components ".
			"WHERE ccda_components_id = '$ccda_components_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "ccda_components::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM ccda_components";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$ccda_componentss = $this->database->GetAll($sql);

		return $ccda_componentss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($ccda_components_id)
	{
		$sql = "SELECT * FROM ccda_components WHERE ccda_components_id = '$ccda_components_id'";

		$ccda_componentsRecord = $this->database->GetRow($sql);

		return $ccda_componentsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ccda_components_field, $ccda_components_name, $ccda_type)
	{
		$this->debug->Show(Debug::DEBUG, "ccda_components::Insert");

		$sql = "INSERT INTO ccda_components (ccda_components_field, ccda_components_name, ccda_type)".
			" VALUES ('$ccda_components_field', '" + "'$ccda_components_name', '" + "'$ccda_type')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "ccda_components::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($ccda_components_id, $ccda_components_field, $ccda_components_name, $ccda_type)
	{
		$this->debug->Show(Debug::DEBUG, "ccda_components::Update");

		$sql = "UPDATE ccda_components SET ".
				@"ccda_components_field='$ccda_components_field'," + 
				@"ccda_components_name='$ccda_components_name'," + 
				@"ccda_type='$ccda_type'" + 
				
				"WHERE ccda_components_id = '$ccda_components_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "ccda_components::Update return: $result");

		return $result;
	}
}
?>
