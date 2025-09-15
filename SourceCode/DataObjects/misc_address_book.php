<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a misc_address_book Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class misc_address_book
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
		$this->debug->Show(Debug::DEBUG, "misc_address_book::Delete");

		$query = "DELETE FROM misc_address_book ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "misc_address_book::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM misc_address_book";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$misc_address_books = $this->database->GetAll($sql);

		return $misc_address_books;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM misc_address_book WHERE id = '$id'";

		$misc_address_bookRecord = $this->database->GetRow($sql);

		return $misc_address_bookRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($fname, $mname, $lname, $street, $city, $state, $zip, $phone)
	{
		$this->debug->Show(Debug::DEBUG, "misc_address_book::Insert");

		$sql = "INSERT INTO misc_address_book (fname, mname, lname, street, city, state, zip, phone)".
			" VALUES ('$fname', '" + "'$mname', '" + "'$lname', '" + "'$street', '" + "'$city', '" + "'$state', '" + "'$zip', '" + "'$phone')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "misc_address_book::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $fname, $mname, $lname, $street, $city, $state, $zip, $phone)
	{
		$this->debug->Show(Debug::DEBUG, "misc_address_book::Update");

		$sql = "UPDATE misc_address_book SET ".
				@"fname='$fname'," + 
				@"mname='$mname'," + 
				@"lname='$lname'," + 
				@"street='$street'," + 
				@"city='$city'," + 
				@"state='$state'," + 
				@"zip='$zip'," + 
				@"phone='$phone'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "misc_address_book::Update return: $result");

		return $result;
	}
}
?>
