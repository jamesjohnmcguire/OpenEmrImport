<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a procedure_order_code Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class procedure_order_code
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
	function Delete($procedure_order_id)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_order_code::Delete");

		$query = "DELETE FROM procedure_order_code ".
			"WHERE procedure_order_id = '$procedure_order_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "procedure_order_code::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM procedure_order_code";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$procedure_order_codes = $this->database->GetAll($sql);

		return $procedure_order_codes;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($procedure_order_id)
	{
		$sql = "SELECT * FROM procedure_order_code WHERE procedure_order_id = '$procedure_order_id'";

		$procedure_order_codeRecord = $this->database->GetRow($sql);

		return $procedure_order_codeRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($procedure_order_seq, $procedure_code, $procedure_name, $procedure_source, $diagnoses, $do_not_send, $procedure_order_title)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_order_code::Insert");

		$sql = "INSERT INTO procedure_order_code (procedure_order_seq, procedure_code, procedure_name, procedure_source, diagnoses, do_not_send, procedure_order_title)".
			" VALUES ('$procedure_order_seq', '" + "'$procedure_code', '" + "'$procedure_name', '" + "'$procedure_source', '" + "'$diagnoses', '" + "'$do_not_send', '" + "'$procedure_order_title')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_order_code::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($procedure_order_id, $procedure_order_seq, $procedure_code, $procedure_name, $procedure_source, $diagnoses, $do_not_send, $procedure_order_title)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_order_code::Update");

		$sql = "UPDATE procedure_order_code SET ".
				@"procedure_order_seq='$procedure_order_seq'," + 
				@"procedure_code='$procedure_code'," + 
				@"procedure_name='$procedure_name'," + 
				@"procedure_source='$procedure_source'," + 
				@"diagnoses='$diagnoses'," + 
				@"do_not_send='$do_not_send'," + 
				@"procedure_order_title='$procedure_order_title'" + 
				
				"WHERE procedure_order_id = '$procedure_order_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_order_code::Update return: $result");

		return $result;
	}
}
?>
