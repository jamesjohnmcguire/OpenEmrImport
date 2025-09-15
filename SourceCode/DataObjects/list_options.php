<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a list_options Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class list_options
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
	function Delete($list_id)
	{
		$this->debug->Show(Debug::DEBUG, "list_options::Delete");

		$query = "DELETE FROM list_options ".
			"WHERE list_id = '$list_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "list_options::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM list_options";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$list_optionss = $this->database->GetAll($sql);

		return $list_optionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($list_id)
	{
		$sql = "SELECT * FROM list_options WHERE list_id = '$list_id'";

		$list_optionsRecord = $this->database->GetRow($sql);

		return $list_optionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($option_id, $title, $seq, $is_default, $option_value, $mapping, $notes, $codes, $toggle_setting_1, $toggle_setting_2, $activity, $subtype, $edit_options, $timestamp)
	{
		$this->debug->Show(Debug::DEBUG, "list_options::Insert");

		$sql = "INSERT INTO list_options (option_id, title, seq, is_default, option_value, mapping, notes, codes, toggle_setting_1, toggle_setting_2, activity, subtype, edit_options, timestamp)".
			" VALUES ('$option_id', '" + "'$title', '" + "'$seq', '" + "'$is_default', '" + "'$option_value', '" + "'$mapping', '" + "'$notes', '" + "'$codes', '" + "'$toggle_setting_1', '" + "'$toggle_setting_2', '" + "'$activity', '" + "'$subtype', '" + "'$edit_options', '" + "'$timestamp')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "list_options::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($list_id, $option_id, $title, $seq, $is_default, $option_value, $mapping, $notes, $codes, $toggle_setting_1, $toggle_setting_2, $activity, $subtype, $edit_options, $timestamp)
	{
		$this->debug->Show(Debug::DEBUG, "list_options::Update");

		$sql = "UPDATE list_options SET ".
				@"option_id='$option_id'," + 
				@"title='$title'," + 
				@"seq='$seq'," + 
				@"is_default='$is_default'," + 
				@"option_value='$option_value'," + 
				@"mapping='$mapping'," + 
				@"notes='$notes'," + 
				@"codes='$codes'," + 
				@"toggle_setting_1='$toggle_setting_1'," + 
				@"toggle_setting_2='$toggle_setting_2'," + 
				@"activity='$activity'," + 
				@"subtype='$subtype'," + 
				@"edit_options='$edit_options'," + 
				@"timestamp='$timestamp'" + 
				
				"WHERE list_id = '$list_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "list_options::Update return: $result");

		return $result;
	}
}
?>
