<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a pma_relation Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class pma_relation
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
	function Delete($master_db)
	{
		$this->debug->Show(Debug::DEBUG, "pma_relation::Delete");

		$query = "DELETE FROM pma_relation ".
			"WHERE master_db = '$master_db'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "pma_relation::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM pma_relation";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$pma_relations = $this->database->GetAll($sql);

		return $pma_relations;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($master_db)
	{
		$sql = "SELECT * FROM pma_relation WHERE master_db = '$master_db'";

		$pma_relationRecord = $this->database->GetRow($sql);

		return $pma_relationRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($master_table, $master_field, $foreign_db, $foreign_table, $foreign_field)
	{
		$this->debug->Show(Debug::DEBUG, "pma_relation::Insert");

		$sql = "INSERT INTO pma_relation (master_table, master_field, foreign_db, foreign_table, foreign_field)".
			" VALUES ('$master_table', '" + "'$master_field', '" + "'$foreign_db', '" + "'$foreign_table', '" + "'$foreign_field')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "pma_relation::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($master_db, $master_table, $master_field, $foreign_db, $foreign_table, $foreign_field)
	{
		$this->debug->Show(Debug::DEBUG, "pma_relation::Update");

		$sql = "UPDATE pma_relation SET ".
				@"master_table='$master_table'," + 
				@"master_field='$master_field'," + 
				@"foreign_db='$foreign_db'," + 
				@"foreign_table='$foreign_table'," + 
				@"foreign_field='$foreign_field'" + 
				
				"WHERE master_db = '$master_db'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "pma_relation::Update return: $result");

		return $result;
	}
}
?>
