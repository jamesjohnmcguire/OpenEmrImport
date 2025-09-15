<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_eye_mag_wearing Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_eye_mag_wearing
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
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_wearing::Delete");

		$query = "DELETE FROM form_eye_mag_wearing ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_wearing::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_eye_mag_wearing";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_eye_mag_wearings = $this->database->GetAll($sql);

		return $form_eye_mag_wearings;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_eye_mag_wearing WHERE id = '$id'";

		$form_eye_mag_wearingRecord = $this->database->GetRow($sql);

		return $form_eye_mag_wearingRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ENCOUNTER, $FORM_ID, $PID, $RX_NUMBER, $ODSPH, $ODCYL, $ODAXIS, $OSSPH, $OSCYL, $OSAXIS, $ODMIDADD, $OSMIDADD, $ODADD, $OSADD, $ODVA, $OSVA, $ODNEARVA, $OSNEARVA, $ODHPD, $ODHBASE, $ODVPD, $ODVBASE, $ODSLABOFF, $ODVERTEXDIST, $OSHPD, $OSHBASE, $OSVPD, $OSVBASE, $OSSLABOFF, $OSVERTEXDIST, $ODMPDD, $ODMPDN, $OSMPDD, $OSMPDN, $BPDD, $BPDN, $LENS_MATERIAL, $LENS_TREATMENTS, $RX_TYPE, $COMMENTS)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_wearing::Insert");

		$sql = "INSERT INTO form_eye_mag_wearing (ENCOUNTER, FORM_ID, PID, RX_NUMBER, ODSPH, ODCYL, ODAXIS, OSSPH, OSCYL, OSAXIS, ODMIDADD, OSMIDADD, ODADD, OSADD, ODVA, OSVA, ODNEARVA, OSNEARVA, ODHPD, ODHBASE, ODVPD, ODVBASE, ODSLABOFF, ODVERTEXDIST, OSHPD, OSHBASE, OSVPD, OSVBASE, OSSLABOFF, OSVERTEXDIST, ODMPDD, ODMPDN, OSMPDD, OSMPDN, BPDD, BPDN, LENS_MATERIAL, LENS_TREATMENTS, RX_TYPE, COMMENTS)".
			" VALUES ('$ENCOUNTER', '" + "'$FORM_ID', '" + "'$PID', '" + "'$RX_NUMBER', '" + "'$ODSPH', '" + "'$ODCYL', '" + "'$ODAXIS', '" + "'$OSSPH', '" + "'$OSCYL', '" + "'$OSAXIS', '" + "'$ODMIDADD', '" + "'$OSMIDADD', '" + "'$ODADD', '" + "'$OSADD', '" + "'$ODVA', '" + "'$OSVA', '" + "'$ODNEARVA', '" + "'$OSNEARVA', '" + "'$ODHPD', '" + "'$ODHBASE', '" + "'$ODVPD', '" + "'$ODVBASE', '" + "'$ODSLABOFF', '" + "'$ODVERTEXDIST', '" + "'$OSHPD', '" + "'$OSHBASE', '" + "'$OSVPD', '" + "'$OSVBASE', '" + "'$OSSLABOFF', '" + "'$OSVERTEXDIST', '" + "'$ODMPDD', '" + "'$ODMPDN', '" + "'$OSMPDD', '" + "'$OSMPDN', '" + "'$BPDD', '" + "'$BPDN', '" + "'$LENS_MATERIAL', '" + "'$LENS_TREATMENTS', '" + "'$RX_TYPE', '" + "'$COMMENTS')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_wearing::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $ENCOUNTER, $FORM_ID, $PID, $RX_NUMBER, $ODSPH, $ODCYL, $ODAXIS, $OSSPH, $OSCYL, $OSAXIS, $ODMIDADD, $OSMIDADD, $ODADD, $OSADD, $ODVA, $OSVA, $ODNEARVA, $OSNEARVA, $ODHPD, $ODHBASE, $ODVPD, $ODVBASE, $ODSLABOFF, $ODVERTEXDIST, $OSHPD, $OSHBASE, $OSVPD, $OSVBASE, $OSSLABOFF, $OSVERTEXDIST, $ODMPDD, $ODMPDN, $OSMPDD, $OSMPDN, $BPDD, $BPDN, $LENS_MATERIAL, $LENS_TREATMENTS, $RX_TYPE, $COMMENTS)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_wearing::Update");

		$sql = "UPDATE form_eye_mag_wearing SET ".
				@"ENCOUNTER='$ENCOUNTER'," + 
				@"FORM_ID='$FORM_ID'," + 
				@"PID='$PID'," + 
				@"RX_NUMBER='$RX_NUMBER'," + 
				@"ODSPH='$ODSPH'," + 
				@"ODCYL='$ODCYL'," + 
				@"ODAXIS='$ODAXIS'," + 
				@"OSSPH='$OSSPH'," + 
				@"OSCYL='$OSCYL'," + 
				@"OSAXIS='$OSAXIS'," + 
				@"ODMIDADD='$ODMIDADD'," + 
				@"OSMIDADD='$OSMIDADD'," + 
				@"ODADD='$ODADD'," + 
				@"OSADD='$OSADD'," + 
				@"ODVA='$ODVA'," + 
				@"OSVA='$OSVA'," + 
				@"ODNEARVA='$ODNEARVA'," + 
				@"OSNEARVA='$OSNEARVA'," + 
				@"ODHPD='$ODHPD'," + 
				@"ODHBASE='$ODHBASE'," + 
				@"ODVPD='$ODVPD'," + 
				@"ODVBASE='$ODVBASE'," + 
				@"ODSLABOFF='$ODSLABOFF'," + 
				@"ODVERTEXDIST='$ODVERTEXDIST'," + 
				@"OSHPD='$OSHPD'," + 
				@"OSHBASE='$OSHBASE'," + 
				@"OSVPD='$OSVPD'," + 
				@"OSVBASE='$OSVBASE'," + 
				@"OSSLABOFF='$OSSLABOFF'," + 
				@"OSVERTEXDIST='$OSVERTEXDIST'," + 
				@"ODMPDD='$ODMPDD'," + 
				@"ODMPDN='$ODMPDN'," + 
				@"OSMPDD='$OSMPDD'," + 
				@"OSMPDN='$OSMPDN'," + 
				@"BPDD='$BPDD'," + 
				@"BPDN='$BPDN'," + 
				@"LENS_MATERIAL='$LENS_MATERIAL'," + 
				@"LENS_TREATMENTS='$LENS_TREATMENTS'," + 
				@"RX_TYPE='$RX_TYPE'," + 
				@"COMMENTS='$COMMENTS'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_wearing::Update return: $result");

		return $result;
	}
}
?>
