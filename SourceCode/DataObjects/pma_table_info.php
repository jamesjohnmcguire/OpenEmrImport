<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a pma_table_info Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class pma_table_info
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
	function Delete($db_name)
	{
		$this->debug->Show(Debug::DEBUG, "pma_table_info::Delete");

		$query = "DELETE FROM pma_table_info ".
			"WHERE db_name = '$db_name'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "pma_table_info::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM pma_table_info";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$pma_table_infos = $this->database->GetAll($sql);

		return $pma_table_infos;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($db_name)
	{
		$sql = "SELECT * FROM pma_table_info WHERE db_name = '$db_name'";

		$pma_table_infoRecord = $this->database->GetRow($sql);

		return $pma_table_infoRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($table_name, $display_field)
	{
		$this->debug->Show(Debug::DEBUG, "pma_table_info::Insert");

		$sql = "INSERT INTO pma_table_info (table_name, display_field)".
			" VALUES ('$table_name', '" + "'$display_field')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "pma_table_info::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($db_name, $table_name, $display_field)
	{
		$this->debug->Show(Debug::DEBUG, "pma_table_info::Update");

		$sql = "UPDATE pma_table_info SET ".
				@"table_name='$table_name'," + 
				@"display_field='$display_field'" + 
				
				"WHERE db_name = '$db_name'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "pma_table_info::Update return: $result");

		return $result;
	}
}
?>
