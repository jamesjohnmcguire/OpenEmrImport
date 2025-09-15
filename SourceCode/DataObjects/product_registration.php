<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a product_registration Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class product_registration
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
	function Delete($registration_id)
	{
		$this->debug->Show(Debug::DEBUG, "product_registration::Delete");

		$query = "DELETE FROM product_registration ".
			"WHERE registration_id = '$registration_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "product_registration::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM product_registration";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$product_registrations = $this->database->GetAll($sql);

		return $product_registrations;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($registration_id)
	{
		$sql = "SELECT * FROM product_registration WHERE registration_id = '$registration_id'";

		$product_registrationRecord = $this->database->GetRow($sql);

		return $product_registrationRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($email, $opt_out)
	{
		$this->debug->Show(Debug::DEBUG, "product_registration::Insert");

		$sql = "INSERT INTO product_registration (email, opt_out)".
			" VALUES ('$email', '" + "'$opt_out')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "product_registration::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($registration_id, $email, $opt_out)
	{
		$this->debug->Show(Debug::DEBUG, "product_registration::Update");

		$sql = "UPDATE product_registration SET ".
				@"email='$email'," + 
				@"opt_out='$opt_out'" + 
				
				"WHERE registration_id = '$registration_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "product_registration::Update return: $result");

		return $result;
	}
}
?>
