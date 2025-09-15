<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a shared_attributes Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class shared_attributes
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
	function Delete($pid)
	{
		$this->debug->Show(Debug::DEBUG, "shared_attributes::Delete");

		$query = "DELETE FROM shared_attributes ".
			"WHERE pid = '$pid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "shared_attributes::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM shared_attributes";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$shared_attributess = $this->database->GetAll($sql);

		return $shared_attributess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pid)
	{
		$sql = "SELECT * FROM shared_attributes WHERE pid = '$pid'";

		$shared_attributesRecord = $this->database->GetRow($sql);

		return $shared_attributesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($encounter, $field_id, $last_update, $user_id, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "shared_attributes::Insert");

		$sql = "INSERT INTO shared_attributes (encounter, field_id, last_update, user_id, field_value)".
			" VALUES ('$encounter', '" + "'$field_id', '" + "'$last_update', '" + "'$user_id', '" + "'$field_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "shared_attributes::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pid, $encounter, $field_id, $last_update, $user_id, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "shared_attributes::Update");

		$sql = "UPDATE shared_attributes SET ".
				@"encounter='$encounter'," + 
				@"field_id='$field_id'," + 
				@"last_update='$last_update'," + 
				@"user_id='$user_id'," + 
				@"field_value='$field_value'" + 
				
				"WHERE pid = '$pid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "shared_attributes::Update return: $result");

		return $result;
	}
}
?>
