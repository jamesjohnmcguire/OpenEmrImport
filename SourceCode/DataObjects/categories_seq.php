<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a categories_seq Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class categories_seq
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
		$this->debug->Show(Debug::DEBUG, "categories_seq::Delete");

		$query = "DELETE FROM categories_seq ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "categories_seq::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM categories_seq";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$categories_seqs = $this->database->GetAll($sql);

		return $categories_seqs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM categories_seq WHERE id = '$id'";

		$categories_seqRecord = $this->database->GetRow($sql);

		return $categories_seqRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert()
	{
		$this->debug->Show(Debug::DEBUG, "categories_seq::Insert");

		$sql = "INSERT INTO categories_seq ()".
			" VALUES ()";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "categories_seq::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, )
	{
		$this->debug->Show(Debug::DEBUG, "categories_seq::Update");

		$sql = "UPDATE categories_seq SET ".
				" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "categories_seq::Update return: $result");

		return $result;
	}
}
?>
