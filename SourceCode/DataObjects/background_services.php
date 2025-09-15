<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a background_services Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class background_services
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
	function Delete($name)
	{
		$this->debug->Show(Debug::DEBUG, "background_services::Delete");

		$query = "DELETE FROM background_services ".
			"WHERE name = '$name'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "background_services::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM background_services";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$background_servicess = $this->database->GetAll($sql);

		return $background_servicess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($name)
	{
		$sql = "SELECT * FROM background_services WHERE name = '$name'";

		$background_servicesRecord = $this->database->GetRow($sql);

		return $background_servicesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($title, $active, $running, $next_run, $execute_interval, $function, $require_once, $sort_order)
	{
		$this->debug->Show(Debug::DEBUG, "background_services::Insert");

		$sql = "INSERT INTO background_services (title, active, running, next_run, execute_interval, function, require_once, sort_order)".
			" VALUES ('$title', '" + "'$active', '" + "'$running', '" + "'$next_run', '" + "'$execute_interval', '" + "'$function', '" + "'$require_once', '" + "'$sort_order')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "background_services::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($name, $title, $active, $running, $next_run, $execute_interval, $function, $require_once, $sort_order)
	{
		$this->debug->Show(Debug::DEBUG, "background_services::Update");

		$sql = "UPDATE background_services SET ".
				@"title='$title'," + 
				@"active='$active'," + 
				@"running='$running'," + 
				@"next_run='$next_run'," + 
				@"execute_interval='$execute_interval'," + 
				@"function='$function'," + 
				@"require_once='$require_once'," + 
				@"sort_order='$sort_order'" + 
				
				"WHERE name = '$name'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "background_services::Update return: $result");

		return $result;
	}
}
?>
