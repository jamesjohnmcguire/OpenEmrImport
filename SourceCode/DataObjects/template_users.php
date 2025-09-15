<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a template_users Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class template_users
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
	function Delete($tu_id)
	{
		$this->debug->Show(Debug::DEBUG, "template_users::Delete");

		$query = "DELETE FROM template_users ".
			"WHERE tu_id = '$tu_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "template_users::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM template_users";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$template_userss = $this->database->GetAll($sql);

		return $template_userss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($tu_id)
	{
		$sql = "SELECT * FROM template_users WHERE tu_id = '$tu_id'";

		$template_usersRecord = $this->database->GetRow($sql);

		return $template_usersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($tu_user_id, $tu_facility_id, $tu_template_id, $tu_template_order)
	{
		$this->debug->Show(Debug::DEBUG, "template_users::Insert");

		$sql = "INSERT INTO template_users (tu_user_id, tu_facility_id, tu_template_id, tu_template_order)".
			" VALUES ('$tu_user_id', '" + "'$tu_facility_id', '" + "'$tu_template_id', '" + "'$tu_template_order')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "template_users::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($tu_id, $tu_user_id, $tu_facility_id, $tu_template_id, $tu_template_order)
	{
		$this->debug->Show(Debug::DEBUG, "template_users::Update");

		$sql = "UPDATE template_users SET ".
				@"tu_user_id='$tu_user_id'," + 
				@"tu_facility_id='$tu_facility_id'," + 
				@"tu_template_id='$tu_template_id'," + 
				@"tu_template_order='$tu_template_order'" + 
				
				"WHERE tu_id = '$tu_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "template_users::Update return: $result");

		return $result;
	}
}
?>
