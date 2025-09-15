<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a openemr_session_info Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class openemr_session_info
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
	function Delete($pn_sessid)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_session_info::Delete");

		$query = "DELETE FROM openemr_session_info ".
			"WHERE pn_sessid = '$pn_sessid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "openemr_session_info::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM openemr_session_info";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$openemr_session_infos = $this->database->GetAll($sql);

		return $openemr_session_infos;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pn_sessid)
	{
		$sql = "SELECT * FROM openemr_session_info WHERE pn_sessid = '$pn_sessid'";

		$openemr_session_infoRecord = $this->database->GetRow($sql);

		return $openemr_session_infoRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pn_ipaddr, $pn_firstused, $pn_lastused, $pn_uid, $pn_vars)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_session_info::Insert");

		$sql = "INSERT INTO openemr_session_info (pn_ipaddr, pn_firstused, pn_lastused, pn_uid, pn_vars)".
			" VALUES ('$pn_ipaddr', '" + "'$pn_firstused', '" + "'$pn_lastused', '" + "'$pn_uid', '" + "'$pn_vars')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_session_info::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pn_sessid, $pn_ipaddr, $pn_firstused, $pn_lastused, $pn_uid, $pn_vars)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_session_info::Update");

		$sql = "UPDATE openemr_session_info SET ".
				@"pn_ipaddr='$pn_ipaddr'," + 
				@"pn_firstused='$pn_firstused'," + 
				@"pn_lastused='$pn_lastused'," + 
				@"pn_uid='$pn_uid'," + 
				@"pn_vars='$pn_vars'" + 
				
				"WHERE pn_sessid = '$pn_sessid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_session_info::Update return: $result");

		return $result;
	}
}
?>
