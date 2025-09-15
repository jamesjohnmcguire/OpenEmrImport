<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_taskman Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_taskman
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
	function Delete($ID)
	{
		$this->debug->Show(Debug::DEBUG, "form_taskman::Delete");

		$query = "DELETE FROM form_taskman ".
			"WHERE ID = '$ID'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_taskman::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_taskman";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_taskmans = $this->database->GetAll($sql);

		return $form_taskmans;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($ID)
	{
		$sql = "SELECT * FROM form_taskman WHERE ID = '$ID'";

		$form_taskmanRecord = $this->database->GetRow($sql);

		return $form_taskmanRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($REQ_DATE, $FROM_ID, $TO_ID, $PATIENT_ID, $DOC_TYPE, $DOC_ID, $ENC_ID, $METHOD, $COMPLETED, $COMPLETED_DATE, $COMMENT, $USERFIELD_1)
	{
		$this->debug->Show(Debug::DEBUG, "form_taskman::Insert");

		$sql = "INSERT INTO form_taskman (REQ_DATE, FROM_ID, TO_ID, PATIENT_ID, DOC_TYPE, DOC_ID, ENC_ID, METHOD, COMPLETED, COMPLETED_DATE, COMMENT, USERFIELD_1)".
			" VALUES ('$REQ_DATE', '" + "'$FROM_ID', '" + "'$TO_ID', '" + "'$PATIENT_ID', '" + "'$DOC_TYPE', '" + "'$DOC_ID', '" + "'$ENC_ID', '" + "'$METHOD', '" + "'$COMPLETED', '" + "'$COMPLETED_DATE', '" + "'$COMMENT', '" + "'$USERFIELD_1')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_taskman::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($ID, $REQ_DATE, $FROM_ID, $TO_ID, $PATIENT_ID, $DOC_TYPE, $DOC_ID, $ENC_ID, $METHOD, $COMPLETED, $COMPLETED_DATE, $COMMENT, $USERFIELD_1)
	{
		$this->debug->Show(Debug::DEBUG, "form_taskman::Update");

		$sql = "UPDATE form_taskman SET ".
				@"REQ_DATE='$REQ_DATE'," + 
				@"FROM_ID='$FROM_ID'," + 
				@"TO_ID='$TO_ID'," + 
				@"PATIENT_ID='$PATIENT_ID'," + 
				@"DOC_TYPE='$DOC_TYPE'," + 
				@"DOC_ID='$DOC_ID'," + 
				@"ENC_ID='$ENC_ID'," + 
				@"METHOD='$METHOD'," + 
				@"COMPLETED='$COMPLETED'," + 
				@"COMPLETED_DATE='$COMPLETED_DATE'," + 
				@"COMMENT='$COMMENT'," + 
				@"USERFIELD_1='$USERFIELD_1'" + 
				
				"WHERE ID = '$ID'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_taskman::Update return: $result");

		return $result;
	}
}
?>
