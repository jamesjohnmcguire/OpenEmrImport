<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a supported_external_dataloads Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class supported_external_dataloads
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
	function Delete($load_id)
	{
		$this->debug->Show(Debug::DEBUG, "supported_external_dataloads::Delete");

		$query = "DELETE FROM supported_external_dataloads ".
			"WHERE load_id = '$load_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "supported_external_dataloads::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM supported_external_dataloads";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$supported_external_dataloadss = $this->database->GetAll($sql);

		return $supported_external_dataloadss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($load_id)
	{
		$sql = "SELECT * FROM supported_external_dataloads WHERE load_id = '$load_id'";

		$supported_external_dataloadsRecord = $this->database->GetRow($sql);

		return $supported_external_dataloadsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($load_type, $load_source, $load_release_date, $load_filename, $load_checksum)
	{
		$this->debug->Show(Debug::DEBUG, "supported_external_dataloads::Insert");

		$sql = "INSERT INTO supported_external_dataloads (load_type, load_source, load_release_date, load_filename, load_checksum)".
			" VALUES ('$load_type', '" + "'$load_source', '" + "'$load_release_date', '" + "'$load_filename', '" + "'$load_checksum')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "supported_external_dataloads::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($load_id, $load_type, $load_source, $load_release_date, $load_filename, $load_checksum)
	{
		$this->debug->Show(Debug::DEBUG, "supported_external_dataloads::Update");

		$sql = "UPDATE supported_external_dataloads SET ".
				@"load_type='$load_type'," + 
				@"load_source='$load_source'," + 
				@"load_release_date='$load_release_date'," + 
				@"load_filename='$load_filename'," + 
				@"load_checksum='$load_checksum'" + 
				
				"WHERE load_id = '$load_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "supported_external_dataloads::Update return: $result");

		return $result;
	}
}
?>
