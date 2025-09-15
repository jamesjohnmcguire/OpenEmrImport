<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a procedure_providers Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class procedure_providers
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
	function Delete($ppid)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_providers::Delete");

		$query = "DELETE FROM procedure_providers ".
			"WHERE ppid = '$ppid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "procedure_providers::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM procedure_providers";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$procedure_providerss = $this->database->GetAll($sql);

		return $procedure_providerss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($ppid)
	{
		$sql = "SELECT * FROM procedure_providers WHERE ppid = '$ppid'";

		$procedure_providersRecord = $this->database->GetRow($sql);

		return $procedure_providersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert(
		$name,
		$npi,
		$send_app_id,
		$send_fac_id,
		$recv_app_id,
		$recv_fac_id,
		$DorP,
		$direction,
		$protocol,
		$remote_host,
		$login,
		$password,
		$orders_path,
		$results_path,
		$notes,
		$lab_director)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_providers::Insert");

		$sql = "INSERT INTO procedure_providers (name, npi, send_app_id, send_fac_id, recv_app_id, recv_fac_id, DorP, direction, protocol, remote_host, login, password, orders_path, results_path, notes, lab_director)".
			" VALUES ('$name', '" + "'$npi', '" + "'$send_app_id', '" + "'$send_fac_id', '" + "'$recv_app_id', '" + "'$recv_fac_id', '" + "'$DorP', '" + "'$direction', '" + "'$protocol', '" + "'$remote_host', '" + "'$login', '" + "'$password', '" + "'$orders_path', '" + "'$results_path', '" + "'$notes', '" + "'$lab_director')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_providers::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($ppid, $name, $npi, $send_app_id, $send_fac_id, $recv_app_id, $recv_fac_id, $DorP, $direction, $protocol, $remote_host, $login, $password, $orders_path, $results_path, $notes, $lab_director)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_providers::Update");

		$sql = "UPDATE procedure_providers SET ".
				@"name='$name'," + 
				@"npi='$npi'," + 
				@"send_app_id='$send_app_id'," + 
				@"send_fac_id='$send_fac_id'," + 
				@"recv_app_id='$recv_app_id'," + 
				@"recv_fac_id='$recv_fac_id'," + 
				@"DorP='$DorP'," + 
				@"direction='$direction'," + 
				@"protocol='$protocol'," + 
				@"remote_host='$remote_host'," + 
				@"login='$login'," + 
				@"password='$password'," + 
				@"orders_path='$orders_path'," + 
				@"results_path='$results_path'," + 
				@"notes='$notes'," + 
				@"lab_director='$lab_director'" + 
				
				"WHERE ppid = '$ppid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_providers::Update return: $result");

		return $result;
	}
}
?>
