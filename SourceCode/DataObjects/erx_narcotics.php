<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a erx_narcotics Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class erx_narcotics
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
		$this->debug->Show(Debug::DEBUG, "erx_narcotics::Delete");

		$query = "DELETE FROM erx_narcotics ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "erx_narcotics::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM erx_narcotics";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$erx_narcoticss = $this->database->GetAll($sql);

		return $erx_narcoticss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM erx_narcotics WHERE id = '$id'";

		$erx_narcoticsRecord = $this->database->GetRow($sql);

		return $erx_narcoticsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($drug, $dea_number, $csa_sch, $narc, $other_names)
	{
		$this->debug->Show(Debug::DEBUG, "erx_narcotics::Insert");

		$sql = "INSERT INTO erx_narcotics (drug, dea_number, csa_sch, narc, other_names)".
			" VALUES ('$drug', '" + "'$dea_number', '" + "'$csa_sch', '" + "'$narc', '" + "'$other_names')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "erx_narcotics::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $drug, $dea_number, $csa_sch, $narc, $other_names)
	{
		$this->debug->Show(Debug::DEBUG, "erx_narcotics::Update");

		$sql = "UPDATE erx_narcotics SET ".
				@"drug='$drug'," + 
				@"dea_number='$dea_number'," + 
				@"csa_sch='$csa_sch'," + 
				@"narc='$narc'," + 
				@"other_names='$other_names'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "erx_narcotics::Update return: $result");

		return $result;
	}
}
?>
