<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a medex_prefs Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class medex_prefs
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
	function Delete($MedEx_id)
	{
		$this->debug->Show(Debug::DEBUG, "medex_prefs::Delete");

		$query = "DELETE FROM medex_prefs ".
			"WHERE MedEx_id = '$MedEx_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "medex_prefs::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM medex_prefs";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$medex_prefss = $this->database->GetAll($sql);

		return $medex_prefss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($MedEx_id)
	{
		$sql = "SELECT * FROM medex_prefs WHERE MedEx_id = '$MedEx_id'";

		$medex_prefsRecord = $this->database->GetRow($sql);

		return $medex_prefsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ME_username, $ME_api_key, $ME_facilities, $ME_providers, $ME_hipaa_default_override, $PHONE_country_code, $MSGS_default_yes, $POSTCARDS_local, $POSTCARDS_remote, $LABELS_local, $LABELS_choice, $combine_time, $postcard_top, $MedEx_lastupdated)
	{
		$this->debug->Show(Debug::DEBUG, "medex_prefs::Insert");

		$sql = "INSERT INTO medex_prefs (ME_username, ME_api_key, ME_facilities, ME_providers, ME_hipaa_default_override, PHONE_country_code, MSGS_default_yes, POSTCARDS_local, POSTCARDS_remote, LABELS_local, LABELS_choice, combine_time, postcard_top, MedEx_lastupdated)".
			" VALUES ('$ME_username', '" + "'$ME_api_key', '" + "'$ME_facilities', '" + "'$ME_providers', '" + "'$ME_hipaa_default_override', '" + "'$PHONE_country_code', '" + "'$MSGS_default_yes', '" + "'$POSTCARDS_local', '" + "'$POSTCARDS_remote', '" + "'$LABELS_local', '" + "'$LABELS_choice', '" + "'$combine_time', '" + "'$postcard_top', '" + "'$MedEx_lastupdated')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "medex_prefs::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($MedEx_id, $ME_username, $ME_api_key, $ME_facilities, $ME_providers, $ME_hipaa_default_override, $PHONE_country_code, $MSGS_default_yes, $POSTCARDS_local, $POSTCARDS_remote, $LABELS_local, $LABELS_choice, $combine_time, $postcard_top, $MedEx_lastupdated)
	{
		$this->debug->Show(Debug::DEBUG, "medex_prefs::Update");

		$sql = "UPDATE medex_prefs SET ".
				@"ME_username='$ME_username'," + 
				@"ME_api_key='$ME_api_key'," + 
				@"ME_facilities='$ME_facilities'," + 
				@"ME_providers='$ME_providers'," + 
				@"ME_hipaa_default_override='$ME_hipaa_default_override'," + 
				@"PHONE_country_code='$PHONE_country_code'," + 
				@"MSGS_default_yes='$MSGS_default_yes'," + 
				@"POSTCARDS_local='$POSTCARDS_local'," + 
				@"POSTCARDS_remote='$POSTCARDS_remote'," + 
				@"LABELS_local='$LABELS_local'," + 
				@"LABELS_choice='$LABELS_choice'," + 
				@"combine_time='$combine_time'," + 
				@"postcard_top='$postcard_top'," + 
				@"MedEx_lastupdated='$MedEx_lastupdated'" + 
				
				"WHERE MedEx_id = '$MedEx_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "medex_prefs::Update return: $result");

		return $result;
	}
}
?>
