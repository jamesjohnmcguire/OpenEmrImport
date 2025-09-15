<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a icd10_gem_dx_10_9 Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class icd10_gem_dx_10_9
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
	function Delete($map_id)
	{
		$this->debug->Show(Debug::DEBUG, "icd10_gem_dx_10_9::Delete");

		$query = "DELETE FROM icd10_gem_dx_10_9 ".
			"WHERE map_id = '$map_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "icd10_gem_dx_10_9::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM icd10_gem_dx_10_9";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$icd10_gem_dx_10_9s = $this->database->GetAll($sql);

		return $icd10_gem_dx_10_9s;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($map_id)
	{
		$sql = "SELECT * FROM icd10_gem_dx_10_9 WHERE map_id = '$map_id'";

		$icd10_gem_dx_10_9Record = $this->database->GetRow($sql);

		return $icd10_gem_dx_10_9Record;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($dx_icd10_source, $dx_icd9_target, $flags, $active, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "icd10_gem_dx_10_9::Insert");

		$sql = "INSERT INTO icd10_gem_dx_10_9 (dx_icd10_source, dx_icd9_target, flags, active, revision)".
			" VALUES ('$dx_icd10_source', '" + "'$dx_icd9_target', '" + "'$flags', '" + "'$active', '" + "'$revision')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "icd10_gem_dx_10_9::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($map_id, $dx_icd10_source, $dx_icd9_target, $flags, $active, $revision)
	{
		$this->debug->Show(Debug::DEBUG, "icd10_gem_dx_10_9::Update");

		$sql = "UPDATE icd10_gem_dx_10_9 SET ".
				@"dx_icd10_source='$dx_icd10_source'," + 
				@"dx_icd9_target='$dx_icd9_target'," + 
				@"flags='$flags'," + 
				@"active='$active'," + 
				@"revision='$revision'" + 
				
				"WHERE map_id = '$map_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "icd10_gem_dx_10_9::Update return: $result");

		return $result;
	}
}
?>
