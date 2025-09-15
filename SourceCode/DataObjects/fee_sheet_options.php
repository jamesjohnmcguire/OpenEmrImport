<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a fee_sheet_options Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class fee_sheet_options
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
	function Delete($fs_category)
	{
		$this->debug->Show(Debug::DEBUG, "fee_sheet_options::Delete");

		$query = "DELETE FROM fee_sheet_options ".
			"WHERE fs_category = '$fs_category'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "fee_sheet_options::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM fee_sheet_options";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$fee_sheet_optionss = $this->database->GetAll($sql);

		return $fee_sheet_optionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($fs_category)
	{
		$sql = "SELECT * FROM fee_sheet_options WHERE fs_category = '$fs_category'";

		$fee_sheet_optionsRecord = $this->database->GetRow($sql);

		return $fee_sheet_optionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($fs_option, $fs_codes)
	{
		$this->debug->Show(Debug::DEBUG, "fee_sheet_options::Insert");

		$sql = "INSERT INTO fee_sheet_options (fs_option, fs_codes)".
			" VALUES ('$fs_option', '" + "'$fs_codes')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "fee_sheet_options::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($fs_category, $fs_option, $fs_codes)
	{
		$this->debug->Show(Debug::DEBUG, "fee_sheet_options::Update");

		$sql = "UPDATE fee_sheet_options SET ".
				@"fs_option='$fs_option'," + 
				@"fs_codes='$fs_codes'" + 
				
				"WHERE fs_category = '$fs_category'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "fee_sheet_options::Update return: $result");

		return $result;
	}
}
?>
