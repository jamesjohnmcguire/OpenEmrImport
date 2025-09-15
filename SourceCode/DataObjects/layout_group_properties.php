<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a layout_group_properties Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class layout_group_properties
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
	function Delete($grp_form_id)
	{
		$this->debug->Show(Debug::DEBUG, "layout_group_properties::Delete");

		$query = "DELETE FROM layout_group_properties ".
			"WHERE grp_form_id = '$grp_form_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "layout_group_properties::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM layout_group_properties";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$layout_group_propertiess = $this->database->GetAll($sql);

		return $layout_group_propertiess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($grp_form_id)
	{
		$sql = "SELECT * FROM layout_group_properties WHERE grp_form_id = '$grp_form_id'";

		$layout_group_propertiesRecord = $this->database->GetRow($sql);

		return $layout_group_propertiesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($grp_group_id, $grp_title, $grp_subtitle, $grp_mapping, $grp_seq, $grp_activity, $grp_repeats, $grp_columns, $grp_size, $grp_issue_type, $grp_aco_spec, $grp_services, $grp_products, $grp_diags)
	{
		$this->debug->Show(Debug::DEBUG, "layout_group_properties::Insert");

		$sql = "INSERT INTO layout_group_properties (grp_group_id, grp_title, grp_subtitle, grp_mapping, grp_seq, grp_activity, grp_repeats, grp_columns, grp_size, grp_issue_type, grp_aco_spec, grp_services, grp_products, grp_diags)".
			" VALUES ('$grp_group_id', '" + "'$grp_title', '" + "'$grp_subtitle', '" + "'$grp_mapping', '" + "'$grp_seq', '" + "'$grp_activity', '" + "'$grp_repeats', '" + "'$grp_columns', '" + "'$grp_size', '" + "'$grp_issue_type', '" + "'$grp_aco_spec', '" + "'$grp_services', '" + "'$grp_products', '" + "'$grp_diags')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "layout_group_properties::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($grp_form_id, $grp_group_id, $grp_title, $grp_subtitle, $grp_mapping, $grp_seq, $grp_activity, $grp_repeats, $grp_columns, $grp_size, $grp_issue_type, $grp_aco_spec, $grp_services, $grp_products, $grp_diags)
	{
		$this->debug->Show(Debug::DEBUG, "layout_group_properties::Update");

		$sql = "UPDATE layout_group_properties SET ".
				@"grp_group_id='$grp_group_id'," + 
				@"grp_title='$grp_title'," + 
				@"grp_subtitle='$grp_subtitle'," + 
				@"grp_mapping='$grp_mapping'," + 
				@"grp_seq='$grp_seq'," + 
				@"grp_activity='$grp_activity'," + 
				@"grp_repeats='$grp_repeats'," + 
				@"grp_columns='$grp_columns'," + 
				@"grp_size='$grp_size'," + 
				@"grp_issue_type='$grp_issue_type'," + 
				@"grp_aco_spec='$grp_aco_spec'," + 
				@"grp_services='$grp_services'," + 
				@"grp_products='$grp_products'," + 
				@"grp_diags='$grp_diags'" + 
				
				"WHERE grp_form_id = '$grp_form_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "layout_group_properties::Update return: $result");

		return $result;
	}
}
?>
