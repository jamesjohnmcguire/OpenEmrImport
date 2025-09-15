<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a users_facility Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class users_facility
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
	function Delete($tablename)
	{
		$this->debug->Show(Debug::DEBUG, "users_facility::Delete");

		$query = "DELETE FROM users_facility ".
			"WHERE tablename = '$tablename'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "users_facility::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM users_facility";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$users_facilitys = $this->database->GetAll($sql);

		return $users_facilitys;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($tablename)
	{
		$sql = "SELECT * FROM users_facility WHERE tablename = '$tablename'";

		$users_facilityRecord = $this->database->GetRow($sql);

		return $users_facilityRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($table_id, $facility_id)
	{
		$this->debug->Show(Debug::DEBUG, "users_facility::Insert");

		$sql = "INSERT INTO users_facility (table_id, facility_id)".
			" VALUES ('$table_id', '" + "'$facility_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "users_facility::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($tablename, $table_id, $facility_id)
	{
		$this->debug->Show(Debug::DEBUG, "users_facility::Update");

		$sql = "UPDATE users_facility SET ".
				@"table_id='$table_id'," + 
				@"facility_id='$facility_id'" + 
				
				"WHERE tablename = '$tablename'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "users_facility::Update return: $result");

		return $result;
	}
}
?>
