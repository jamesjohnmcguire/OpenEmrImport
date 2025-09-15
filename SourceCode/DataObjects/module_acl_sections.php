<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a module_acl_sections Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class module_acl_sections
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
	function Delete($section_id)
	{
		$this->debug->Show(Debug::DEBUG, "module_acl_sections::Delete");

		$query = "DELETE FROM module_acl_sections ".
			"WHERE section_id = '$section_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "module_acl_sections::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM module_acl_sections";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$module_acl_sectionss = $this->database->GetAll($sql);

		return $module_acl_sectionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($section_id)
	{
		$sql = "SELECT * FROM module_acl_sections WHERE section_id = '$section_id'";

		$module_acl_sectionsRecord = $this->database->GetRow($sql);

		return $module_acl_sectionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($section_name, $parent_section, $section_identifier, $module_id)
	{
		$this->debug->Show(Debug::DEBUG, "module_acl_sections::Insert");

		$sql = "INSERT INTO module_acl_sections (section_name, parent_section, section_identifier, module_id)".
			" VALUES ('$section_name', '" + "'$parent_section', '" + "'$section_identifier', '" + "'$module_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "module_acl_sections::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($section_id, $section_name, $parent_section, $section_identifier, $module_id)
	{
		$this->debug->Show(Debug::DEBUG, "module_acl_sections::Update");

		$sql = "UPDATE module_acl_sections SET ".
				@"section_name='$section_name'," + 
				@"parent_section='$parent_section'," + 
				@"section_identifier='$section_identifier'," + 
				@"module_id='$module_id'" + 
				
				"WHERE section_id = '$section_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "module_acl_sections::Update return: $result");

		return $result;
	}
}
?>
