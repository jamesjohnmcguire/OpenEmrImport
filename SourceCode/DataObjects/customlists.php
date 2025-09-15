<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a customlists Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class customlists
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
	function Delete($cl_list_slno)
	{
		$this->debug->Show(Debug::DEBUG, "customlists::Delete");

		$query = "DELETE FROM customlists ".
			"WHERE cl_list_slno = '$cl_list_slno'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "customlists::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM customlists";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$customlistss = $this->database->GetAll($sql);

		return $customlistss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($cl_list_slno)
	{
		$sql = "SELECT * FROM customlists WHERE cl_list_slno = '$cl_list_slno'";

		$customlistsRecord = $this->database->GetRow($sql);

		return $customlistsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($cl_list_id, $cl_list_item_id, $cl_list_type, $cl_list_item_short, $cl_list_item_long, $cl_list_item_level, $cl_order, $cl_deleted, $cl_creator)
	{
		$this->debug->Show(Debug::DEBUG, "customlists::Insert");

		$sql = "INSERT INTO customlists (cl_list_id, cl_list_item_id, cl_list_type, cl_list_item_short, cl_list_item_long, cl_list_item_level, cl_order, cl_deleted, cl_creator)".
			" VALUES ('$cl_list_id', '" + "'$cl_list_item_id', '" + "'$cl_list_type', '" + "'$cl_list_item_short', '" + "'$cl_list_item_long', '" + "'$cl_list_item_level', '" + "'$cl_order', '" + "'$cl_deleted', '" + "'$cl_creator')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "customlists::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($cl_list_slno, $cl_list_id, $cl_list_item_id, $cl_list_type, $cl_list_item_short, $cl_list_item_long, $cl_list_item_level, $cl_order, $cl_deleted, $cl_creator)
	{
		$this->debug->Show(Debug::DEBUG, "customlists::Update");

		$sql = "UPDATE customlists SET ".
				@"cl_list_id='$cl_list_id'," + 
				@"cl_list_item_id='$cl_list_item_id'," + 
				@"cl_list_type='$cl_list_type'," + 
				@"cl_list_item_short='$cl_list_item_short'," + 
				@"cl_list_item_long='$cl_list_item_long'," + 
				@"cl_list_item_level='$cl_list_item_level'," + 
				@"cl_order='$cl_order'," + 
				@"cl_deleted='$cl_deleted'," + 
				@"cl_creator='$cl_creator'" + 
				
				"WHERE cl_list_slno = '$cl_list_slno'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "customlists::Update return: $result");

		return $result;
	}
}
?>
