<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a amc_misc_data Collection
//
// NOTES:
//
// 2018 - 2018
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class amc_misc_data
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
	function Delete($amc_id)
	{
		$this->debug->Show(Debug::DEBUG, "amc_misc_data::Delete");

		$query = "DELETE FROM amc_misc_data ".
			"WHERE amc_id = '$amc_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "amc_misc_data::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM amc_misc_data";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$amc_misc_datas = $this->database->GetAll($sql);

		return $amc_misc_datas;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($amc_id)
	{
		$sql = "SELECT * FROM amc_misc_data WHERE amc_id = '$amc_id'";

		$amc_misc_dataRecord = $this->database->GetRow($sql);

		return $amc_misc_dataRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $map_category, $map_id, $date_created, $date_completed, $soc_provided)
	{
		$this->debug->Show(Debug::DEBUG, "amc_misc_data::Insert");

		$sql = "INSERT INTO amc_misc_data (pid, map_category, map_id, date_created, date_completed, soc_provided)".
			" VALUES ('$pid', '" + "'$map_category', '" + "'$map_id', '" + "'$date_created', '" + "'$date_completed', '" + "'$soc_provided')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "amc_misc_data::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($amc_id, $pid, $map_category, $map_id, $date_created, $date_completed, $soc_provided)
	{
		$this->debug->Show(Debug::DEBUG, "amc_misc_data::Update");

		$sql = "UPDATE amc_misc_data SET ".
				@"pid='$pid'," + 
				@"map_category='$map_category'," + 
				@"map_id='$map_id'," + 
				@"date_created='$date_created'," + 
				@"date_completed='$date_completed'," + 
				@"soc_provided='$soc_provided'" + 
				
				"WHERE amc_id = '$amc_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "amc_misc_data::Update return: $result");

		return $result;
	}
}
?>
