<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a codes_history Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class codes_history
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
	function Delete($log_id)
	{
		$this->debug->Show(Debug::DEBUG, "codes_history::Delete");

		$query = "DELETE FROM codes_history ".
			"WHERE log_id = '$log_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "codes_history::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM codes_history";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$codes_historys = $this->database->GetAll($sql);

		return $codes_historys;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($log_id)
	{
		$sql = "SELECT * FROM codes_history WHERE log_id = '$log_id'";

		$codes_historyRecord = $this->database->GetRow($sql);

		return $codes_historyRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $code, $modifier, $active, $diagnosis_reporting, $financial_reporting, $category, $code_type_name, $code_text, $code_text_short, $prices, $action_type, $update_by)
	{
		$this->debug->Show(Debug::DEBUG, "codes_history::Insert");

		$sql = "INSERT INTO codes_history (date, code, modifier, active, diagnosis_reporting, financial_reporting, category, code_type_name, code_text, code_text_short, prices, action_type, update_by)".
			" VALUES ('$date', '" + "'$code', '" + "'$modifier', '" + "'$active', '" + "'$diagnosis_reporting', '" + "'$financial_reporting', '" + "'$category', '" + "'$code_type_name', '" + "'$code_text', '" + "'$code_text_short', '" + "'$prices', '" + "'$action_type', '" + "'$update_by')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "codes_history::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($log_id, $date, $code, $modifier, $active, $diagnosis_reporting, $financial_reporting, $category, $code_type_name, $code_text, $code_text_short, $prices, $action_type, $update_by)
	{
		$this->debug->Show(Debug::DEBUG, "codes_history::Update");

		$sql = "UPDATE codes_history SET ".
				@"date='$date'," + 
				@"code='$code'," + 
				@"modifier='$modifier'," + 
				@"active='$active'," + 
				@"diagnosis_reporting='$diagnosis_reporting'," + 
				@"financial_reporting='$financial_reporting'," + 
				@"category='$category'," + 
				@"code_type_name='$code_type_name'," + 
				@"code_text='$code_text'," + 
				@"code_text_short='$code_text_short'," + 
				@"prices='$prices'," + 
				@"action_type='$action_type'," + 
				@"update_by='$update_by'" + 
				
				"WHERE log_id = '$log_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "codes_history::Update return: $result");

		return $result;
	}
}
?>
