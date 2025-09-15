<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a pma_column_info Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class pma_column_info
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
		$this->debug->Show(Debug::DEBUG, "pma_column_info::Delete");

		$query = "DELETE FROM pma_column_info ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "pma_column_info::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM pma_column_info";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$pma_column_infos = $this->database->GetAll($sql);

		return $pma_column_infos;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM pma_column_info WHERE id = '$id'";

		$pma_column_infoRecord = $this->database->GetRow($sql);

		return $pma_column_infoRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($db_name, $table_name, $column_name, $comment, $mimetype, $transformation, $transformation_options)
	{
		$this->debug->Show(Debug::DEBUG, "pma_column_info::Insert");

		$sql = "INSERT INTO pma_column_info (db_name, table_name, column_name, comment, mimetype, transformation, transformation_options)".
			" VALUES ('$db_name', '" + "'$table_name', '" + "'$column_name', '" + "'$comment', '" + "'$mimetype', '" + "'$transformation', '" + "'$transformation_options')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "pma_column_info::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $db_name, $table_name, $column_name, $comment, $mimetype, $transformation, $transformation_options)
	{
		$this->debug->Show(Debug::DEBUG, "pma_column_info::Update");

		$sql = "UPDATE pma_column_info SET ".
				@"db_name='$db_name'," + 
				@"table_name='$table_name'," + 
				@"column_name='$column_name'," + 
				@"comment='$comment'," + 
				@"mimetype='$mimetype'," + 
				@"transformation='$transformation'," + 
				@"transformation_options='$transformation_options'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "pma_column_info::Update return: $result");

		return $result;
	}
}
?>
