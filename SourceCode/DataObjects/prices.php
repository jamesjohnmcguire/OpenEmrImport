<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a prices Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class prices
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
	function Delete($pr_id)
	{
		$this->debug->Show(Debug::DEBUG, "prices::Delete");

		$query = "DELETE FROM prices ".
			"WHERE pr_id = '$pr_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "prices::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM prices";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$pricess = $this->database->GetAll($sql);

		return $pricess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pr_id)
	{
		$sql = "SELECT * FROM prices WHERE pr_id = '$pr_id'";

		$pricesRecord = $this->database->GetRow($sql);

		return $pricesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pr_selector, $pr_level, $pr_price)
	{
		$this->debug->Show(Debug::DEBUG, "prices::Insert");

		$sql = "INSERT INTO prices (pr_selector, pr_level, pr_price)".
			" VALUES ('$pr_selector', '" + "'$pr_level', '" + "'$pr_price')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "prices::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pr_id, $pr_selector, $pr_level, $pr_price)
	{
		$this->debug->Show(Debug::DEBUG, "prices::Update");

		$sql = "UPDATE prices SET ".
				@"pr_selector='$pr_selector'," + 
				@"pr_level='$pr_level'," + 
				@"pr_price='$pr_price'" + 
				
				"WHERE pr_id = '$pr_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "prices::Update return: $result");

		return $result;
	}
}
?>
