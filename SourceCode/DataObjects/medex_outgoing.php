<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a medex_outgoing Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class medex_outgoing
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
	function Delete($msg_uid)
	{
		$this->debug->Show(Debug::DEBUG, "medex_outgoing::Delete");

		$query = "DELETE FROM medex_outgoing ".
			"WHERE msg_uid = '$msg_uid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "medex_outgoing::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM medex_outgoing";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$medex_outgoings = $this->database->GetAll($sql);

		return $medex_outgoings;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($msg_uid)
	{
		$sql = "SELECT * FROM medex_outgoing WHERE msg_uid = '$msg_uid'";

		$medex_outgoingRecord = $this->database->GetRow($sql);

		return $medex_outgoingRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($msg_pid, $msg_pc_eid, $campaign_uid, $msg_date, $msg_type, $msg_reply, $msg_extra_text, $medex_uid)
	{
		$this->debug->Show(Debug::DEBUG, "medex_outgoing::Insert");

		$sql = "INSERT INTO medex_outgoing (msg_pid, msg_pc_eid, campaign_uid, msg_date, msg_type, msg_reply, msg_extra_text, medex_uid)".
			" VALUES ('$msg_pid', '" + "'$msg_pc_eid', '" + "'$campaign_uid', '" + "'$msg_date', '" + "'$msg_type', '" + "'$msg_reply', '" + "'$msg_extra_text', '" + "'$medex_uid')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "medex_outgoing::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($msg_uid, $msg_pid, $msg_pc_eid, $campaign_uid, $msg_date, $msg_type, $msg_reply, $msg_extra_text, $medex_uid)
	{
		$this->debug->Show(Debug::DEBUG, "medex_outgoing::Update");

		$sql = "UPDATE medex_outgoing SET ".
				@"msg_pid='$msg_pid'," + 
				@"msg_pc_eid='$msg_pc_eid'," + 
				@"campaign_uid='$campaign_uid'," + 
				@"msg_date='$msg_date'," + 
				@"msg_type='$msg_type'," + 
				@"msg_reply='$msg_reply'," + 
				@"msg_extra_text='$msg_extra_text'," + 
				@"medex_uid='$medex_uid'" + 
				
				"WHERE msg_uid = '$msg_uid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "medex_outgoing::Update return: $result");

		return $result;
	}
}
?>
