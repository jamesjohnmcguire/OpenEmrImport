<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a ccda Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class ccda
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
		$this->debug->Show(Debug::DEBUG, "ccda::Delete");

		$query = "DELETE FROM ccda ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "ccda::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM ccda";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$ccdas = $this->database->GetAll($sql);

		return $ccdas;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM ccda WHERE id = '$id'";

		$ccdaRecord = $this->database->GetRow($sql);

		return $ccdaRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $encounter, $ccda_data, $time, $status, $updated_date, $user_id, $couch_docid, $couch_revid, $view, $transfer, $emr_transfer)
	{
		$this->debug->Show(Debug::DEBUG, "ccda::Insert");

		$sql = "INSERT INTO ccda (pid, encounter, ccda_data, time, status, updated_date, user_id, couch_docid, couch_revid, view, transfer, emr_transfer)".
			" VALUES ('$pid', '" + "'$encounter', '" + "'$ccda_data', '" + "'$time', '" + "'$status', '" + "'$updated_date', '" + "'$user_id', '" + "'$couch_docid', '" + "'$couch_revid', '" + "'$view', '" + "'$transfer', '" + "'$emr_transfer')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "ccda::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $pid, $encounter, $ccda_data, $time, $status, $updated_date, $user_id, $couch_docid, $couch_revid, $view, $transfer, $emr_transfer)
	{
		$this->debug->Show(Debug::DEBUG, "ccda::Update");

		$sql = "UPDATE ccda SET ".
				@"pid='$pid'," + 
				@"encounter='$encounter'," + 
				@"ccda_data='$ccda_data'," + 
				@"time='$time'," + 
				@"status='$status'," + 
				@"updated_date='$updated_date'," + 
				@"user_id='$user_id'," + 
				@"couch_docid='$couch_docid'," + 
				@"couch_revid='$couch_revid'," + 
				@"view='$view'," + 
				@"transfer='$transfer'," + 
				@"emr_transfer='$emr_transfer'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "ccda::Update return: $result");

		return $result;
	}
}
?>
