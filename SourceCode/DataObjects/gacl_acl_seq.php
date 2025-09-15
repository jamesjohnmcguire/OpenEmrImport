<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_acl_seq Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_acl_seq
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
		$this->debug->Show(Debug::DEBUG, "gacl_acl_seq::Delete");

		$query = "DELETE FROM gacl_acl_seq ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_acl_seq::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_acl_seq";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_acl_seqs = $this->database->GetAll($sql);

		return $gacl_acl_seqs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM gacl_acl_seq WHERE id = '$id'";

		$gacl_acl_seqRecord = $this->database->GetRow($sql);

		return $gacl_acl_seqRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert()
	{
		$this->debug->Show(Debug::DEBUG, "gacl_acl_seq::Insert");

		$sql = "INSERT INTO gacl_acl_seq ()".
			" VALUES ()";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_acl_seq::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, )
	{
		$this->debug->Show(Debug::DEBUG, "gacl_acl_seq::Update");

		$sql = "UPDATE gacl_acl_seq SET ".
				" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_acl_seq::Update return: $result");

		return $result;
	}
}
?>
