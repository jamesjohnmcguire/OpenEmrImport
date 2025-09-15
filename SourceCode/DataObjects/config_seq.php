<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a config_seq Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class config_seq
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
		$this->debug->Show(Debug::DEBUG, "config_seq::Delete");

		$query = "DELETE FROM config_seq ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "config_seq::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM config_seq";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$config_seqs = $this->database->GetAll($sql);

		return $config_seqs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM config_seq WHERE id = '$id'";

		$config_seqRecord = $this->database->GetRow($sql);

		return $config_seqRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert()
	{
		$this->debug->Show(Debug::DEBUG, "config_seq::Insert");

		$sql = "INSERT INTO config_seq ()".
			" VALUES ()";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "config_seq::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, )
	{
		$this->debug->Show(Debug::DEBUG, "config_seq::Update");

		$sql = "UPDATE config_seq SET ".
				" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "config_seq::Update return: $result");

		return $result;
	}
}
?>
