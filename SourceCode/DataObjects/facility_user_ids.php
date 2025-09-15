<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a facility_user_ids Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class facility_user_ids
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
		$this->debug->Show(Debug::DEBUG, "facility_user_ids::Delete");

		$query = "DELETE FROM facility_user_ids ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "facility_user_ids::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM facility_user_ids";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$facility_user_idss = $this->database->GetAll($sql);

		return $facility_user_idss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM facility_user_ids WHERE id = '$id'";

		$facility_user_idsRecord = $this->database->GetRow($sql);

		return $facility_user_idsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($uid, $facility_id, $field_id, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "facility_user_ids::Insert");

		$sql = "INSERT INTO facility_user_ids (uid, facility_id, field_id, field_value)".
			" VALUES ('$uid', '" + "'$facility_id', '" + "'$field_id', '" + "'$field_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "facility_user_ids::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $uid, $facility_id, $field_id, $field_value)
	{
		$this->debug->Show(Debug::DEBUG, "facility_user_ids::Update");

		$sql = "UPDATE facility_user_ids SET ".
				@"uid='$uid'," + 
				@"facility_id='$facility_id'," + 
				@"field_id='$field_id'," + 
				@"field_value='$field_value'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "facility_user_ids::Update return: $result");

		return $result;
	}
}
?>
