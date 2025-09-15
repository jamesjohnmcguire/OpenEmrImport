<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a valueset Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class valueset
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
	function Delete($nqf_code)
	{
		$this->debug->Show(Debug::DEBUG, "valueset::Delete");

		$query = "DELETE FROM valueset ".
			"WHERE nqf_code = '$nqf_code'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "valueset::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM valueset";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$valuesets = $this->database->GetAll($sql);

		return $valuesets;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($nqf_code)
	{
		$sql = "SELECT * FROM valueset WHERE nqf_code = '$nqf_code'";

		$valuesetRecord = $this->database->GetRow($sql);

		return $valuesetRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($code, $code_system, $code_type, $valueset, $description, $valueset_name)
	{
		$this->debug->Show(Debug::DEBUG, "valueset::Insert");

		$sql = "INSERT INTO valueset (code, code_system, code_type, valueset, description, valueset_name)".
			" VALUES ('$code', '" + "'$code_system', '" + "'$code_type', '" + "'$valueset', '" + "'$description', '" + "'$valueset_name')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "valueset::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($nqf_code, $code, $code_system, $code_type, $valueset, $description, $valueset_name)
	{
		$this->debug->Show(Debug::DEBUG, "valueset::Update");

		$sql = "UPDATE valueset SET ".
				@"code='$code'," + 
				@"code_system='$code_system'," + 
				@"code_type='$code_type'," + 
				@"valueset='$valueset'," + 
				@"description='$description'," + 
				@"valueset_name='$valueset_name'" + 
				
				"WHERE nqf_code = '$nqf_code'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "valueset::Update return: $result");

		return $result;
	}
}
?>
