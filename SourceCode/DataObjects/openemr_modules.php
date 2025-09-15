<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a openemr_modules Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class openemr_modules
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
		$this->debug->Show(Debug::DEBUG, "openemr_modules::Delete");

		$query = "DELETE FROM openemr_modules ".
			"WHERE pn_id = '$pn_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "openemr_modules::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM openemr_modules";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$openemr_moduless = $this->database->GetAll($sql);

		return $openemr_moduless;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pn_id)
	{
		$sql = "SELECT * FROM openemr_modules WHERE pn_id = '$pn_id'";

		$openemr_modulesRecord = $this->database->GetRow($sql);

		return $openemr_modulesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pn_name, $pn_type, $pn_displayname, $pn_description, $pn_regid, $pn_directory, $pn_version, $pn_admin_capable, $pn_user_capable, $pn_state)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_modules::Insert");

		$sql = "INSERT INTO openemr_modules (pn_name, pn_type, pn_displayname, pn_description, pn_regid, pn_directory, pn_version, pn_admin_capable, pn_user_capable, pn_state)".
			" VALUES ('$pn_name', '" + "'$pn_type', '" + "'$pn_displayname', '" + "'$pn_description', '" + "'$pn_regid', '" + "'$pn_directory', '" + "'$pn_version', '" + "'$pn_admin_capable', '" + "'$pn_user_capable', '" + "'$pn_state')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_modules::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pn_id, $pn_name, $pn_type, $pn_displayname, $pn_description, $pn_regid, $pn_directory, $pn_version, $pn_admin_capable, $pn_user_capable, $pn_state)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_modules::Update");

		$sql = "UPDATE openemr_modules SET ".
				@"pn_name='$pn_name'," + 
				@"pn_type='$pn_type'," + 
				@"pn_displayname='$pn_displayname'," + 
				@"pn_description='$pn_description'," + 
				@"pn_regid='$pn_regid'," + 
				@"pn_directory='$pn_directory'," + 
				@"pn_version='$pn_version'," + 
				@"pn_admin_capable='$pn_admin_capable'," + 
				@"pn_user_capable='$pn_user_capable'," + 
				@"pn_state='$pn_state'" + 
				
				"WHERE pn_id = '$pn_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_modules::Update return: $result");

		return $result;
	}
}
?>
