<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a erx_rx_log Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class erx_rx_log
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
	function Delete($id)
	{
		$this->debug->Show(Debug::DEBUG, "erx_rx_log::Delete");

		$query = "DELETE FROM erx_rx_log ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "erx_rx_log::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM erx_rx_log";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$erx_rx_logs = $this->database->GetAll($sql);

		return $erx_rx_logs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM erx_rx_log WHERE id = '$id'";

		$erx_rx_logRecord = $this->database->GetRow($sql);

		return $erx_rx_logRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($prescription_id, $date, $time, $code, $status, $message_id, $read)
	{
		$this->debug->Show(Debug::DEBUG, "erx_rx_log::Insert");

		$sql = "INSERT INTO erx_rx_log (prescription_id, date, time, code, status, message_id, read)".
			" VALUES ('$prescription_id', '" + "'$date', '" + "'$time', '" + "'$code', '" + "'$status', '" + "'$message_id', '" + "'$read')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "erx_rx_log::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $prescription_id, $date, $time, $code, $status, $message_id, $read)
	{
		$this->debug->Show(Debug::DEBUG, "erx_rx_log::Update");

		$sql = "UPDATE erx_rx_log SET ".
				@"prescription_id='$prescription_id'," + 
				@"date='$date'," + 
				@"time='$time'," + 
				@"code='$code'," + 
				@"status='$status'," + 
				@"message_id='$message_id'," + 
				@"read='$read'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "erx_rx_log::Update return: $result");

		return $result;
	}
}
?>
