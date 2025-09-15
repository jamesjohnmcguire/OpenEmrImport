<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a layout_options Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class layout_options
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
	function Delete($form_id)
	{
		$this->debug->Show(Debug::DEBUG, "layout_options::Delete");

		$query = "DELETE FROM layout_options ".
			"WHERE form_id = '$form_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "layout_options::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM layout_options";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$layout_optionss = $this->database->GetAll($sql);

		return $layout_optionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($form_id)
	{
		$sql = "SELECT * FROM layout_options WHERE form_id = '$form_id'";

		$layout_optionsRecord = $this->database->GetRow($sql);

		return $layout_optionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($field_id, $group_id, $title, $seq, $data_type, $uor, $fld_length, $max_length, $list_id, $titlecols, $datacols, $default_value, $edit_options, $description, $fld_rows, $list_backup_id, $source, $conditions, $validation)
	{
		$this->debug->Show(Debug::DEBUG, "layout_options::Insert");

		$sql = "INSERT INTO layout_options (field_id, group_id, title, seq, data_type, uor, fld_length, max_length, list_id, titlecols, datacols, default_value, edit_options, description, fld_rows, list_backup_id, source, conditions, validation)".
			" VALUES ('$field_id', '" + "'$group_id', '" + "'$title', '" + "'$seq', '" + "'$data_type', '" + "'$uor', '" + "'$fld_length', '" + "'$max_length', '" + "'$list_id', '" + "'$titlecols', '" + "'$datacols', '" + "'$default_value', '" + "'$edit_options', '" + "'$description', '" + "'$fld_rows', '" + "'$list_backup_id', '" + "'$source', '" + "'$conditions', '" + "'$validation')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "layout_options::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($form_id, $field_id, $group_id, $title, $seq, $data_type, $uor, $fld_length, $max_length, $list_id, $titlecols, $datacols, $default_value, $edit_options, $description, $fld_rows, $list_backup_id, $source, $conditions, $validation)
	{
		$this->debug->Show(Debug::DEBUG, "layout_options::Update");

		$sql = "UPDATE layout_options SET ".
				@"field_id='$field_id'," + 
				@"group_id='$group_id'," + 
				@"title='$title'," + 
				@"seq='$seq'," + 
				@"data_type='$data_type'," + 
				@"uor='$uor'," + 
				@"fld_length='$fld_length'," + 
				@"max_length='$max_length'," + 
				@"list_id='$list_id'," + 
				@"titlecols='$titlecols'," + 
				@"datacols='$datacols'," + 
				@"default_value='$default_value'," + 
				@"edit_options='$edit_options'," + 
				@"description='$description'," + 
				@"fld_rows='$fld_rows'," + 
				@"list_backup_id='$list_backup_id'," + 
				@"source='$source'," + 
				@"conditions='$conditions'," + 
				@"validation='$validation'" + 
				
				"WHERE form_id = '$form_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "layout_options::Update return: $result");

		return $result;
	}
}
?>
