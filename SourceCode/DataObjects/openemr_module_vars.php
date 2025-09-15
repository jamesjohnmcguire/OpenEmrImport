<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a openemr_module_vars Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class openemr_module_vars
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
	function Delete($pn_id)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_module_vars::Delete");

		$query = "DELETE FROM openemr_module_vars ".
			"WHERE pn_id = '$pn_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "openemr_module_vars::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM openemr_module_vars";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$openemr_module_varss = $this->database->GetAll($sql);

		return $openemr_module_varss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pn_id)
	{
		$sql = "SELECT * FROM openemr_module_vars WHERE pn_id = '$pn_id'";

		$openemr_module_varsRecord = $this->database->GetRow($sql);

		return $openemr_module_varsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pn_modname, $pn_name, $pn_value)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_module_vars::Insert");

		$sql = "INSERT INTO openemr_module_vars (pn_modname, pn_name, pn_value)".
			" VALUES ('$pn_modname', '" + "'$pn_name', '" + "'$pn_value')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_module_vars::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pn_id, $pn_modname, $pn_name, $pn_value)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_module_vars::Update");

		$sql = "UPDATE openemr_module_vars SET ".
				@"pn_modname='$pn_modname'," + 
				@"pn_name='$pn_name'," + 
				@"pn_value='$pn_value'" + 
				
				"WHERE pn_id = '$pn_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_module_vars::Update return: $result");

		return $result;
	}
}
?>
