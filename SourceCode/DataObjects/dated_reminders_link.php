<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a dated_reminders_link Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class dated_reminders_link
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
	function Delete($dr_link_id)
	{
		$this->debug->Show(Debug::DEBUG, "dated_reminders_link::Delete");

		$query = "DELETE FROM dated_reminders_link ".
			"WHERE dr_link_id = '$dr_link_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "dated_reminders_link::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM dated_reminders_link";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$dated_reminders_links = $this->database->GetAll($sql);

		return $dated_reminders_links;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($dr_link_id)
	{
		$sql = "SELECT * FROM dated_reminders_link WHERE dr_link_id = '$dr_link_id'";

		$dated_reminders_linkRecord = $this->database->GetRow($sql);

		return $dated_reminders_linkRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($dr_id, $to_id)
	{
		$this->debug->Show(Debug::DEBUG, "dated_reminders_link::Insert");

		$sql = "INSERT INTO dated_reminders_link (dr_id, to_id)".
			" VALUES ('$dr_id', '" + "'$to_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "dated_reminders_link::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($dr_link_id, $dr_id, $to_id)
	{
		$this->debug->Show(Debug::DEBUG, "dated_reminders_link::Update");

		$sql = "UPDATE dated_reminders_link SET ".
				@"dr_id='$dr_id'," + 
				@"to_id='$to_id'" + 
				
				"WHERE dr_link_id = '$dr_link_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "dated_reminders_link::Update return: $result");

		return $result;
	}
}
?>
