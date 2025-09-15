<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_eye_mag_impplan Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_eye_mag_impplan
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
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_impplan::Delete");

		$query = "DELETE FROM form_eye_mag_impplan ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_impplan::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_eye_mag_impplan";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_eye_mag_impplans = $this->database->GetAll($sql);

		return $form_eye_mag_impplans;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_eye_mag_impplan WHERE id = '$id'";

		$form_eye_mag_impplanRecord = $this->database->GetRow($sql);

		return $form_eye_mag_impplanRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($form_id, $pid, $title, $code, $codetype, $codedesc, $codetext, $plan, $PMSFH_link, $IMPPLAN_order)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_impplan::Insert");

		$sql = "INSERT INTO form_eye_mag_impplan (form_id, pid, title, code, codetype, codedesc, codetext, plan, PMSFH_link, IMPPLAN_order)".
			" VALUES ('$form_id', '" + "'$pid', '" + "'$title', '" + "'$code', '" + "'$codetype', '" + "'$codedesc', '" + "'$codetext', '" + "'$plan', '" + "'$PMSFH_link', '" + "'$IMPPLAN_order')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_impplan::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $form_id, $pid, $title, $code, $codetype, $codedesc, $codetext, $plan, $PMSFH_link, $IMPPLAN_order)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_impplan::Update");

		$sql = "UPDATE form_eye_mag_impplan SET ".
				@"form_id='$form_id'," + 
				@"pid='$pid'," + 
				@"title='$title'," + 
				@"code='$code'," + 
				@"codetype='$codetype'," + 
				@"codedesc='$codedesc'," + 
				@"codetext='$codetext'," + 
				@"plan='$plan'," + 
				@"PMSFH_link='$PMSFH_link'," + 
				@"IMPPLAN_order='$IMPPLAN_order'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_impplan::Update return: $result");

		return $result;
	}
}
?>
