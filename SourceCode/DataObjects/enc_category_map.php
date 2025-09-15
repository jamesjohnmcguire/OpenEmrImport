<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a enc_category_map Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class enc_category_map
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
	function Delete($rule_enc_id)
	{
		$this->debug->Show(Debug::DEBUG, "enc_category_map::Delete");

		$query = "DELETE FROM enc_category_map ".
			"WHERE rule_enc_id = '$rule_enc_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "enc_category_map::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM enc_category_map";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$enc_category_maps = $this->database->GetAll($sql);

		return $enc_category_maps;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($rule_enc_id)
	{
		$sql = "SELECT * FROM enc_category_map WHERE rule_enc_id = '$rule_enc_id'";

		$enc_category_mapRecord = $this->database->GetRow($sql);

		return $enc_category_mapRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($main_cat_id)
	{
		$this->debug->Show(Debug::DEBUG, "enc_category_map::Insert");

		$sql = "INSERT INTO enc_category_map (main_cat_id)".
			" VALUES ('$main_cat_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "enc_category_map::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($rule_enc_id, $main_cat_id)
	{
		$this->debug->Show(Debug::DEBUG, "enc_category_map::Update");

		$sql = "UPDATE enc_category_map SET ".
				@"main_cat_id='$main_cat_id'" + 
				
				"WHERE rule_enc_id = '$rule_enc_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "enc_category_map::Update return: $result");

		return $result;
	}
}
?>
