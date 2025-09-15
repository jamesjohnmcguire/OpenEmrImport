<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a pma_table_coords Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class pma_table_coords
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
		$this->debug->Show(Debug::DEBUG, "pma_table_coords::Delete");

		$query = "DELETE FROM pma_table_coords ".
			"WHERE db_name = '$db_name'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "pma_table_coords::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM pma_table_coords";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$pma_table_coordss = $this->database->GetAll($sql);

		return $pma_table_coordss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($db_name)
	{
		$sql = "SELECT * FROM pma_table_coords WHERE db_name = '$db_name'";

		$pma_table_coordsRecord = $this->database->GetRow($sql);

		return $pma_table_coordsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($table_name, $pdf_page_number, $x, $y)
	{
		$this->debug->Show(Debug::DEBUG, "pma_table_coords::Insert");

		$sql = "INSERT INTO pma_table_coords (table_name, pdf_page_number, x, y)".
			" VALUES ('$table_name', '" + "'$pdf_page_number', '" + "'$x', '" + "'$y')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "pma_table_coords::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($db_name, $table_name, $pdf_page_number, $x, $y)
	{
		$this->debug->Show(Debug::DEBUG, "pma_table_coords::Update");

		$sql = "UPDATE pma_table_coords SET ".
				@"table_name='$table_name'," + 
				@"pdf_page_number='$pdf_page_number'," + 
				@"x='$x'," + 
				@"y='$y'" + 
				
				"WHERE db_name = '$db_name'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "pma_table_coords::Update return: $result");

		return $result;
	}
}
?>
