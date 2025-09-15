<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a form_vitals Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class form_vitals
{
	var	$database;
	var $debug;
	var $lastQuery;

	/////////////////////////////////////////////////////////////////////////
	// constructor
	/////////////////////////////////////////////////////////////////////////
	function __construct($database, $debug, &$lastQuery)
	{
		$this->database	= $database;
		$this->debug = $debug;
		$this->lastQuery = & $lastQuery;
	}

	/////////////////////////////////////////////////////////////////////////
	// Delete
	/////////////////////////////////////////////////////////////////////////
	function Delete($id)
	{
		$this->debug->Show(Debug::DEBUG, "form_vitals::Delete");

		$query = "DELETE FROM form_vitals ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_vitals::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = null, $types = null)
	{
		$sql = "SELECT * FROM form_vitals";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_vitalss = $this->database->GetAll($sql, $values, $types);

		return $form_vitalss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_vitals WHERE id = '$id'";

		$form_vitalsRecord = $this->database->GetRow($sql);

		return $form_vitalsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $pid, $user, $groupname, $authorized, $activity,
		$bps, $bpd, $weight, $height, $temperature, $temp_method, $pulse,
		$respiration, $note, $BMI, $BMI_status, $waist_circ, $head_circ,
		$oxygen_saturation, $external_id)
	{
		$this->debug->Show(Debug::DEBUG, "form_vitals::Insert");

		$statement = 'INSERT INTO form_vitals (date, pid, user, groupname, '.
			'authorized, activity, bps, bpd, weight, height, temperature, '.
			'temp_method, pulse, respiration, note, BMI, BMI_status, '.
			'waist_circ, head_circ, oxygen_saturation, external_id) VALUES '.
			'(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

		$values = array($date, $pid, $user, $groupname, $authorized,
			$activity, $bps, $bpd, $weight, $height, $temperature,
			$temp_method, $pulse, $respiration, $note, $BMI, $BMI_status,
			$waist_circ, $head_circ, $oxygen_saturation, $external_id);

		$types = array('s', 'i', 's', 's', 'i', 'i', 's', 's', 'd', 'd', 'd',
			's', 'd', 'd', 's', 'd', 's', 'd', 'd', 'd', 's');

		$result	= $this->database->Insert($statement, $values, $types);
		$this->debug->Show(
			Debug::INFO, "form_vitals::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $fields, $values, $types)
	{
		$this->debug->Show(Debug::DEBUG, "form_vitals::Update");

		$columns = '';
		$begin = true;
		foreach($fields as $field)
		{
			if (false == $begin)
			{
				$columns .= ', ';
				$begin = false;
			}

			$columns .= "`$field` = ?";
		}

		$sql = "UPDATE form_vitals SET $columns WHERE id = $id";

		$result = $this->database->Update($sql, $values, $types);
		$this->debug->Show(Debug::DEBUG, "form_vitals::Update return: $result");

		return $result;
	}
}
?>
