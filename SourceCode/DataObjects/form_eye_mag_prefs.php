<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_eye_mag_prefs Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_eye_mag_prefs
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
	function Delete($PEZONE)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_prefs::Delete");

		$query = "DELETE FROM form_eye_mag_prefs ".
			"WHERE PEZONE = '$PEZONE'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_prefs::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_eye_mag_prefs";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_eye_mag_prefss = $this->database->GetAll($sql);

		return $form_eye_mag_prefss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($PEZONE)
	{
		$sql = "SELECT * FROM form_eye_mag_prefs WHERE PEZONE = '$PEZONE'";

		$form_eye_mag_prefsRecord = $this->database->GetRow($sql);

		return $form_eye_mag_prefsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($LOCATION, $LOCATION_text, $id, $selection, $ZONE_ORDER, $GOVALUE, $ordering, $FILL_ACTION, $GORIGHT, $GOLEFT, $UNSPEC)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_prefs::Insert");

		$sql = "INSERT INTO form_eye_mag_prefs (LOCATION, LOCATION_text, id, selection, ZONE_ORDER, GOVALUE, ordering, FILL_ACTION, GORIGHT, GOLEFT, UNSPEC)".
			" VALUES ('$LOCATION', '" + "'$LOCATION_text', '" + "'$id', '" + "'$selection', '" + "'$ZONE_ORDER', '" + "'$GOVALUE', '" + "'$ordering', '" + "'$FILL_ACTION', '" + "'$GORIGHT', '" + "'$GOLEFT', '" + "'$UNSPEC')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_prefs::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($PEZONE, $LOCATION, $LOCATION_text, $id, $selection, $ZONE_ORDER, $GOVALUE, $ordering, $FILL_ACTION, $GORIGHT, $GOLEFT, $UNSPEC)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_prefs::Update");

		$sql = "UPDATE form_eye_mag_prefs SET ".
				@"LOCATION='$LOCATION'," + 
				@"LOCATION_text='$LOCATION_text'," + 
				@"id='$id'," + 
				@"selection='$selection'," + 
				@"ZONE_ORDER='$ZONE_ORDER'," + 
				@"GOVALUE='$GOVALUE'," + 
				@"ordering='$ordering'," + 
				@"FILL_ACTION='$FILL_ACTION'," + 
				@"GORIGHT='$GORIGHT'," + 
				@"GOLEFT='$GOLEFT'," + 
				@"UNSPEC='$UNSPEC'" + 
				
				"WHERE PEZONE = '$PEZONE'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_prefs::Update return: $result");

		return $result;
	}
}
?>
