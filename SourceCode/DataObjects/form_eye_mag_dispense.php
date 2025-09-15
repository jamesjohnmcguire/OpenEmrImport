<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_eye_mag_dispense Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_eye_mag_dispense
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
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_dispense::Delete");

		$query = "DELETE FROM form_eye_mag_dispense ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_dispense::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_eye_mag_dispense";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_eye_mag_dispenses = $this->database->GetAll($sql);

		return $form_eye_mag_dispenses;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_eye_mag_dispense WHERE id = '$id'";

		$form_eye_mag_dispenseRecord = $this->database->GetRow($sql);

		return $form_eye_mag_dispenseRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $encounter, $pid, $user, $groupname, $authorized, $activity, $REFDATE, $REFTYPE, $RXTYPE, $ODSPH, $ODCYL, $ODAXIS, $OSSPH, $OSCYL, $OSAXIS, $ODMIDADD, $OSMIDADD, $ODADD, $OSADD, $ODHPD, $ODHBASE, $ODVPD, $ODVBASE, $ODSLABOFF, $ODVERTEXDIST, $OSHPD, $OSHBASE, $OSVPD, $OSVBASE, $OSSLABOFF, $OSVERTEXDIST, $ODMPDD, $ODMPDN, $OSMPDD, $OSMPDN, $BPDD, $BPDN, $LENS_MATERIAL, $LENS_TREATMENTS, $CTLMANUFACTUREROD, $CTLMANUFACTUREROS, $CTLSUPPLIEROD, $CTLSUPPLIEROS, $CTLBRANDOD, $CTLBRANDOS, $ODDIAM, $ODBC, $OSDIAM, $OSBC, $RXCOMMENTS, $COMMENTS)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_dispense::Insert");

		$sql = "INSERT INTO form_eye_mag_dispense (date, encounter, pid, user, groupname, authorized, activity, REFDATE, REFTYPE, RXTYPE, ODSPH, ODCYL, ODAXIS, OSSPH, OSCYL, OSAXIS, ODMIDADD, OSMIDADD, ODADD, OSADD, ODHPD, ODHBASE, ODVPD, ODVBASE, ODSLABOFF, ODVERTEXDIST, OSHPD, OSHBASE, OSVPD, OSVBASE, OSSLABOFF, OSVERTEXDIST, ODMPDD, ODMPDN, OSMPDD, OSMPDN, BPDD, BPDN, LENS_MATERIAL, LENS_TREATMENTS, CTLMANUFACTUREROD, CTLMANUFACTUREROS, CTLSUPPLIEROD, CTLSUPPLIEROS, CTLBRANDOD, CTLBRANDOS, ODDIAM, ODBC, OSDIAM, OSBC, RXCOMMENTS, COMMENTS)".
			" VALUES ('$date', '" + "'$encounter', '" + "'$pid', '" + "'$user', '" + "'$groupname', '" + "'$authorized', '" + "'$activity', '" + "'$REFDATE', '" + "'$REFTYPE', '" + "'$RXTYPE', '" + "'$ODSPH', '" + "'$ODCYL', '" + "'$ODAXIS', '" + "'$OSSPH', '" + "'$OSCYL', '" + "'$OSAXIS', '" + "'$ODMIDADD', '" + "'$OSMIDADD', '" + "'$ODADD', '" + "'$OSADD', '" + "'$ODHPD', '" + "'$ODHBASE', '" + "'$ODVPD', '" + "'$ODVBASE', '" + "'$ODSLABOFF', '" + "'$ODVERTEXDIST', '" + "'$OSHPD', '" + "'$OSHBASE', '" + "'$OSVPD', '" + "'$OSVBASE', '" + "'$OSSLABOFF', '" + "'$OSVERTEXDIST', '" + "'$ODMPDD', '" + "'$ODMPDN', '" + "'$OSMPDD', '" + "'$OSMPDN', '" + "'$BPDD', '" + "'$BPDN', '" + "'$LENS_MATERIAL', '" + "'$LENS_TREATMENTS', '" + "'$CTLMANUFACTUREROD', '" + "'$CTLMANUFACTUREROS', '" + "'$CTLSUPPLIEROD', '" + "'$CTLSUPPLIEROS', '" + "'$CTLBRANDOD', '" + "'$CTLBRANDOS', '" + "'$ODDIAM', '" + "'$ODBC', '" + "'$OSDIAM', '" + "'$OSBC', '" + "'$RXCOMMENTS', '" + "'$COMMENTS')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_dispense::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $encounter, $pid, $user, $groupname, $authorized, $activity, $REFDATE, $REFTYPE, $RXTYPE, $ODSPH, $ODCYL, $ODAXIS, $OSSPH, $OSCYL, $OSAXIS, $ODMIDADD, $OSMIDADD, $ODADD, $OSADD, $ODHPD, $ODHBASE, $ODVPD, $ODVBASE, $ODSLABOFF, $ODVERTEXDIST, $OSHPD, $OSHBASE, $OSVPD, $OSVBASE, $OSSLABOFF, $OSVERTEXDIST, $ODMPDD, $ODMPDN, $OSMPDD, $OSMPDN, $BPDD, $BPDN, $LENS_MATERIAL, $LENS_TREATMENTS, $CTLMANUFACTUREROD, $CTLMANUFACTUREROS, $CTLSUPPLIEROD, $CTLSUPPLIEROS, $CTLBRANDOD, $CTLBRANDOS, $ODDIAM, $ODBC, $OSDIAM, $OSBC, $RXCOMMENTS, $COMMENTS)
	{
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_dispense::Update");

		$sql = "UPDATE form_eye_mag_dispense SET ".
				@"date='$date'," + 
				@"encounter='$encounter'," + 
				@"pid='$pid'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'," + 
				@"activity='$activity'," + 
				@"REFDATE='$REFDATE'," + 
				@"REFTYPE='$REFTYPE'," + 
				@"RXTYPE='$RXTYPE'," + 
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
				@"CTLMANUFACTUREROD='$CTLMANUFACTUREROD'," + 
				@"CTLMANUFACTUREROS='$CTLMANUFACTUREROS'," + 
				@"CTLSUPPLIEROD='$CTLSUPPLIEROD'," + 
				@"CTLSUPPLIEROS='$CTLSUPPLIEROS'," + 
				@"CTLBRANDOD='$CTLBRANDOD'," + 
				@"CTLBRANDOS='$CTLBRANDOS'," + 
				@"ODDIAM='$ODDIAM'," + 
				@"ODBC='$ODBC'," + 
				@"OSDIAM='$OSDIAM'," + 
				@"OSBC='$OSBC'," + 
				@"RXCOMMENTS='$RXCOMMENTS'," + 
				@"COMMENTS='$COMMENTS'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_eye_mag_dispense::Update return: $result");

		return $result;
	}
}
?>
