<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a batchcom Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class batchcom
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
		$this->debug->Show(Debug::DEBUG, "batchcom::Delete");

		$query = "DELETE FROM batchcom ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "batchcom::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM batchcom";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$batchcoms = $this->database->GetAll($sql);

		return $batchcoms;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM batchcom WHERE id = '$id'";

		$batchcomRecord = $this->database->GetRow($sql);

		return $batchcomRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($patient_id, $sent_by, $msg_type, $msg_subject, $msg_text, $msg_date_sent)
	{
		$this->debug->Show(Debug::DEBUG, "batchcom::Insert");

		$sql = "INSERT INTO batchcom (patient_id, sent_by, msg_type, msg_subject, msg_text, msg_date_sent)".
			" VALUES ('$patient_id', '" + "'$sent_by', '" + "'$msg_type', '" + "'$msg_subject', '" + "'$msg_text', '" + "'$msg_date_sent')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "batchcom::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $patient_id, $sent_by, $msg_type, $msg_subject, $msg_text, $msg_date_sent)
	{
		$this->debug->Show(Debug::DEBUG, "batchcom::Update");

		$sql = "UPDATE batchcom SET ".
				@"patient_id='$patient_id'," + 
				@"sent_by='$sent_by'," + 
				@"msg_type='$msg_type'," + 
				@"msg_subject='$msg_subject'," + 
				@"msg_text='$msg_text'," + 
				@"msg_date_sent='$msg_date_sent'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "batchcom::Update return: $result");

		return $result;
	}
}
?>
