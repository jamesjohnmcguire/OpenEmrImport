<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a ccda_sections Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class ccda_sections
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
	function Delete($ccda_sections_id)
	{
		$this->debug->Show(Debug::DEBUG, "ccda_sections::Delete");

		$query = "DELETE FROM ccda_sections ".
			"WHERE ccda_sections_id = '$ccda_sections_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "ccda_sections::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM ccda_sections";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$ccda_sectionss = $this->database->GetAll($sql);

		return $ccda_sectionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($ccda_sections_id)
	{
		$sql = "SELECT * FROM ccda_sections WHERE ccda_sections_id = '$ccda_sections_id'";

		$ccda_sectionsRecord = $this->database->GetRow($sql);

		return $ccda_sectionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ccda_components_id, $ccda_sections_field, $ccda_sections_name, $ccda_sections_req_mapping)
	{
		$this->debug->Show(Debug::DEBUG, "ccda_sections::Insert");

		$sql = "INSERT INTO ccda_sections (ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping)".
			" VALUES ('$ccda_components_id', '" + "'$ccda_sections_field', '" + "'$ccda_sections_name', '" + "'$ccda_sections_req_mapping')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "ccda_sections::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($ccda_sections_id, $ccda_components_id, $ccda_sections_field, $ccda_sections_name, $ccda_sections_req_mapping)
	{
		$this->debug->Show(Debug::DEBUG, "ccda_sections::Update");

		$sql = "UPDATE ccda_sections SET ".
				@"ccda_components_id='$ccda_components_id'," + 
				@"ccda_sections_field='$ccda_sections_field'," + 
				@"ccda_sections_name='$ccda_sections_name'," + 
				@"ccda_sections_req_mapping='$ccda_sections_req_mapping'" + 
				
				"WHERE ccda_sections_id = '$ccda_sections_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "ccda_sections::Update return: $result");

		return $result;
	}
}
?>
