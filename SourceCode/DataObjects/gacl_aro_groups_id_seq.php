<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a gacl_aro_groups_id_seq Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class gacl_aro_groups_id_seq
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
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_id_seq::Delete");

		$query = "DELETE FROM gacl_aro_groups_id_seq ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_id_seq::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM gacl_aro_groups_id_seq";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$gacl_aro_groups_id_seqs = $this->database->GetAll($sql);

		return $gacl_aro_groups_id_seqs;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM gacl_aro_groups_id_seq WHERE id = '$id'";

		$gacl_aro_groups_id_seqRecord = $this->database->GetRow($sql);

		return $gacl_aro_groups_id_seqRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert()
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_id_seq::Insert");

		$sql = "INSERT INTO gacl_aro_groups_id_seq ()".
			" VALUES ()";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_id_seq::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, )
	{
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_id_seq::Update");

		$sql = "UPDATE gacl_aro_groups_id_seq SET ".
				" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "gacl_aro_groups_id_seq::Update return: $result");

		return $result;
	}
}
?>
