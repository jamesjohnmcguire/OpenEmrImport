<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a patient_portal_menu Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class patient_portal_menu
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
	function Delete($patient_portal_menu_id)
	{
		$this->debug->Show(Debug::DEBUG, "patient_portal_menu::Delete");

		$query = "DELETE FROM patient_portal_menu ".
			"WHERE patient_portal_menu_id = '$patient_portal_menu_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "patient_portal_menu::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM patient_portal_menu";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$patient_portal_menus = $this->database->GetAll($sql);

		return $patient_portal_menus;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($patient_portal_menu_id)
	{
		$sql = "SELECT * FROM patient_portal_menu WHERE patient_portal_menu_id = '$patient_portal_menu_id'";

		$patient_portal_menuRecord = $this->database->GetRow($sql);

		return $patient_portal_menuRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($patient_portal_menu_group_id, $menu_name, $menu_order, $menu_status)
	{
		$this->debug->Show(Debug::DEBUG, "patient_portal_menu::Insert");

		$sql = "INSERT INTO patient_portal_menu (patient_portal_menu_group_id, menu_name, menu_order, menu_status)".
			" VALUES ('$patient_portal_menu_group_id', '" + "'$menu_name', '" + "'$menu_order', '" + "'$menu_status')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "patient_portal_menu::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($patient_portal_menu_id, $patient_portal_menu_group_id, $menu_name, $menu_order, $menu_status)
	{
		$this->debug->Show(Debug::DEBUG, "patient_portal_menu::Update");

		$sql = "UPDATE patient_portal_menu SET ".
				@"patient_portal_menu_group_id='$patient_portal_menu_group_id'," + 
				@"menu_name='$menu_name'," + 
				@"menu_order='$menu_order'," + 
				@"menu_status='$menu_status'" + 
				
				"WHERE patient_portal_menu_id = '$patient_portal_menu_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "patient_portal_menu::Update return: $result");

		return $result;
	}
}
?>
