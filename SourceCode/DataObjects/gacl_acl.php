<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_acl Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_acl
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
		$this->debug->Show(Debug::DEBUG, "gacl_acl::Delete");

		$query = "DELETE FROM gacl_acl ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_acl::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_acl";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_acls = $this->database->GetAll($sql);

		return $gacl_acls;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM gacl_acl WHERE id = '$id'";

		$gacl_aclRecord = $this->database->GetRow($sql);

		return $gacl_aclRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($section_value, $allow, $enabled, $return_value, $note, $updated_date)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_acl::Insert");

		$sql = "INSERT INTO gacl_acl (section_value, allow, enabled, return_value, note, updated_date)".
			" VALUES ('$section_value', '" + "'$allow', '" + "'$enabled', '" + "'$return_value', '" + "'$note', '" + "'$updated_date')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_acl::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $section_value, $allow, $enabled, $return_value, $note, $updated_date)
	{
		$this->debug->Show(Debug::DEBUG, "gacl_acl::Update");

		$sql = "UPDATE gacl_acl SET ".
				@"section_value='$section_value'," + 
				@"allow='$allow'," + 
				@"enabled='$enabled'," + 
				@"return_value='$return_value'," + 
				@"note='$note'," + 
				@"updated_date='$updated_date'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_acl::Update return: $result");

		return $result;
	}
}
?>
