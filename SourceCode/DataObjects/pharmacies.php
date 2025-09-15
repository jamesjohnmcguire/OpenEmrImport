<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a pharmacies Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class pharmacies
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
		$this->debug->Show(Debug::DEBUG, "pharmacies::Delete");

		$query = "DELETE FROM pharmacies ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "pharmacies::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM pharmacies";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$pharmaciess = $this->database->GetAll($sql);

		return $pharmaciess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM pharmacies WHERE id = '$id'";

		$pharmaciesRecord = $this->database->GetRow($sql);

		return $pharmaciesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($name, $transmit_method, $email, $ncpdp, $npi)
	{
		$this->debug->Show(Debug::DEBUG, "pharmacies::Insert");

		$sql = "INSERT INTO pharmacies (name, transmit_method, email, ncpdp, npi)".
			" VALUES ('$name', '" + "'$transmit_method', '" + "'$email', '" + "'$ncpdp', '" + "'$npi')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "pharmacies::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $name, $transmit_method, $email, $ncpdp, $npi)
	{
		$this->debug->Show(Debug::DEBUG, "pharmacies::Update");

		$sql = "UPDATE pharmacies SET ".
				@"name='$name'," + 
				@"transmit_method='$transmit_method'," + 
				@"email='$email'," + 
				@"ncpdp='$ncpdp'," + 
				@"npi='$npi'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "pharmacies::Update return: $result");

		return $result;
	}
}
?>
