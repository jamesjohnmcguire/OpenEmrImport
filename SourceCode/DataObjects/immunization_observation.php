<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a immunization_observation Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class immunization_observation
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
	function Delete($imo_id)
	{
		$this->debug->Show(Debug::DEBUG, "immunization_observation::Delete");

		$query = "DELETE FROM immunization_observation ".
			"WHERE imo_id = '$imo_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "immunization_observation::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM immunization_observation";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$immunization_observations = $this->database->GetAll($sql);

		return $immunization_observations;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($imo_id)
	{
		$sql = "SELECT * FROM immunization_observation WHERE imo_id = '$imo_id'";

		$immunization_observationRecord = $this->database->GetRow($sql);

		return $immunization_observationRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($imo_im_id, $imo_pid, $imo_criteria, $imo_criteria_value, $imo_user, $imo_code, $imo_codetext, $imo_codetype, $imo_vis_date_published, $imo_vis_date_presented, $imo_date_observation)
	{
		$this->debug->Show(Debug::DEBUG, "immunization_observation::Insert");

		$sql = "INSERT INTO immunization_observation (imo_im_id, imo_pid, imo_criteria, imo_criteria_value, imo_user, imo_code, imo_codetext, imo_codetype, imo_vis_date_published, imo_vis_date_presented, imo_date_observation)".
			" VALUES ('$imo_im_id', '" + "'$imo_pid', '" + "'$imo_criteria', '" + "'$imo_criteria_value', '" + "'$imo_user', '" + "'$imo_code', '" + "'$imo_codetext', '" + "'$imo_codetype', '" + "'$imo_vis_date_published', '" + "'$imo_vis_date_presented', '" + "'$imo_date_observation')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "immunization_observation::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($imo_id, $imo_im_id, $imo_pid, $imo_criteria, $imo_criteria_value, $imo_user, $imo_code, $imo_codetext, $imo_codetype, $imo_vis_date_published, $imo_vis_date_presented, $imo_date_observation)
	{
		$this->debug->Show(Debug::DEBUG, "immunization_observation::Update");

		$sql = "UPDATE immunization_observation SET ".
				@"imo_im_id='$imo_im_id'," + 
				@"imo_pid='$imo_pid'," + 
				@"imo_criteria='$imo_criteria'," + 
				@"imo_criteria_value='$imo_criteria_value'," + 
				@"imo_user='$imo_user'," + 
				@"imo_code='$imo_code'," + 
				@"imo_codetext='$imo_codetext'," + 
				@"imo_codetype='$imo_codetype'," + 
				@"imo_vis_date_published='$imo_vis_date_published'," + 
				@"imo_vis_date_presented='$imo_vis_date_presented'," + 
				@"imo_date_observation='$imo_date_observation'" + 
				
				"WHERE imo_id = '$imo_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "immunization_observation::Update return: $result");

		return $result;
	}
}
?>
