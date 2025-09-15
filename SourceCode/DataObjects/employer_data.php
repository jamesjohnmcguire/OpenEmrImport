<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a employer_data Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class employer_data
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
		$this->debug->Show(Debug::DEBUG, "employer_data::Delete");

		$query = "DELETE FROM employer_data ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "employer_data::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM employer_data";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$employer_datas = $this->database->GetAll($sql);

		return $employer_datas;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM employer_data WHERE id = '$id'";

		$employer_dataRecord = $this->database->GetRow($sql);

		return $employer_dataRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($name, $street, $postal_code, $city, $state, $country, $date, $pid)
	{
		$this->debug->Show(Debug::DEBUG, "employer_data::Insert");

		$sql = "INSERT INTO employer_data (name, street, postal_code, city, state, country, date, pid)".
			" VALUES ('$name', '" + "'$street', '" + "'$postal_code', '" + "'$city', '" + "'$state', '" + "'$country', '" + "'$date', '" + "'$pid')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "employer_data::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $name, $street, $postal_code, $city, $state, $country, $date, $pid)
	{
		$this->debug->Show(Debug::DEBUG, "employer_data::Update");

		$sql = "UPDATE employer_data SET ".
				@"name='$name'," + 
				@"street='$street'," + 
				@"postal_code='$postal_code'," + 
				@"city='$city'," + 
				@"state='$state'," + 
				@"country='$country'," + 
				@"date='$date'," + 
				@"pid='$pid'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "employer_data::Update return: $result");

		return $result;
	}
}
?>
