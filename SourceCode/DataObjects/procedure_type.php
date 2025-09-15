<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a procedure_type Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class procedure_type
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
	function Delete($procedure_type_id)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_type::Delete");

		$query = "DELETE FROM procedure_type ".
			"WHERE procedure_type_id = '$procedure_type_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "procedure_type::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM procedure_type";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$procedure_types = $this->database->GetAll($sql);

		return $procedure_types;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($procedure_type_id)
	{
		$sql = "SELECT * FROM procedure_type WHERE procedure_type_id = '$procedure_type_id'";

		$procedure_typeRecord = $this->database->GetRow($sql);

		return $procedure_typeRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($parent, $name, $lab_id, $procedure_code, $procedure_type, $body_site, $specimen, $route_admin, $laterality, $description, $standard_code, $related_code, $units, $range, $seq, $activity, $notes)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_type::Insert");

		$sql = "INSERT INTO procedure_type (parent, name, lab_id, procedure_code, procedure_type, body_site, specimen, route_admin, laterality, description, standard_code, related_code, units, range, seq, activity, notes)".
			" VALUES ('$parent', '" + "'$name', '" + "'$lab_id', '" + "'$procedure_code', '" + "'$procedure_type', '" + "'$body_site', '" + "'$specimen', '" + "'$route_admin', '" + "'$laterality', '" + "'$description', '" + "'$standard_code', '" + "'$related_code', '" + "'$units', '" + "'$range', '" + "'$seq', '" + "'$activity', '" + "'$notes')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_type::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($procedure_type_id, $parent, $name, $lab_id, $procedure_code, $procedure_type, $body_site, $specimen, $route_admin, $laterality, $description, $standard_code, $related_code, $units, $range, $seq, $activity, $notes)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_type::Update");

		$sql = "UPDATE procedure_type SET ".
				@"parent='$parent'," + 
				@"name='$name'," + 
				@"lab_id='$lab_id'," + 
				@"procedure_code='$procedure_code'," + 
				@"procedure_type='$procedure_type'," + 
				@"body_site='$body_site'," + 
				@"specimen='$specimen'," + 
				@"route_admin='$route_admin'," + 
				@"laterality='$laterality'," + 
				@"description='$description'," + 
				@"standard_code='$standard_code'," + 
				@"related_code='$related_code'," + 
				@"units='$units'," + 
				@"range='$range'," + 
				@"seq='$seq'," + 
				@"activity='$activity'," + 
				@"notes='$notes'" + 
				
				"WHERE procedure_type_id = '$procedure_type_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_type::Update return: $result");

		return $result;
	}
}
?>
