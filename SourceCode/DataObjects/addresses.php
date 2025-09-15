<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a addresses Collection
//
// NOTES:
//
// 2018 - 2018
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class addresses
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
		$this->debug->Show(Debug::DEBUG, "addresses::Delete");

		$query = "DELETE FROM addresses ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "addresses::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM addresses";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$addressess = $this->database->GetAll($sql);

		return $addressess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM addresses WHERE id = '$id'";

		$addressesRecord = $this->database->GetRow($sql);

		return $addressesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($line1, $line2, $city, $state, $zip, $plus_four, $country, $foreign_id)
	{
		$this->debug->Show(Debug::DEBUG, "addresses::Insert");

		$sql = "INSERT INTO addresses (line1, line2, city, state, zip, plus_four, country, foreign_id)".
			" VALUES ('$line1', '" + "'$line2', '" + "'$city', '" + "'$state', '" + "'$zip', '" + "'$plus_four', '" + "'$country', '" + "'$foreign_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "addresses::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $line1, $line2, $city, $state, $zip, $plus_four, $country, $foreign_id)
	{
		$this->debug->Show(Debug::DEBUG, "addresses::Update");

		$sql = "UPDATE addresses SET ".
				@"line1='$line1'," + 
				@"line2='$line2'," + 
				@"city='$city'," + 
				@"state='$state'," + 
				@"zip='$zip'," + 
				@"plus_four='$plus_four'," + 
				@"country='$country'," + 
				@"foreign_id='$foreign_id'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "addresses::Update return: $result");

		return $result;
	}
}
?>
