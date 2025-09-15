<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a drugs Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class drugs
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
	function Delete($drug_id)
	{
		$this->debug->Show(Debug::DEBUG, "drugs::Delete");

		$query = "DELETE FROM drugs ".
			"WHERE drug_id = '$drug_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "drugs::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM drugs";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$drugss = $this->database->GetAll($sql);

		return $drugss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($drug_id)
	{
		$sql = "SELECT * FROM drugs WHERE drug_id = '$drug_id'";

		$drugsRecord = $this->database->GetRow($sql);

		return $drugsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($name, $ndc_number, $on_order, $reorder_point, $max_level, $last_notify, $reactions, $form, $size, $unit, $route, $substitute, $related_code, $cyp_factor, $active, $allow_combining, $allow_multiple, $drug_code, $consumable, $dispensable)
	{
		$this->debug->Show(Debug::DEBUG, "drugs::Insert");

		$sql = "INSERT INTO drugs (name, ndc_number, on_order, reorder_point, max_level, last_notify, reactions, form, size, unit, route, substitute, related_code, cyp_factor, active, allow_combining, allow_multiple, drug_code, consumable, dispensable)".
			" VALUES ('$name', '" + "'$ndc_number', '" + "'$on_order', '" + "'$reorder_point', '" + "'$max_level', '" + "'$last_notify', '" + "'$reactions', '" + "'$form', '" + "'$size', '" + "'$unit', '" + "'$route', '" + "'$substitute', '" + "'$related_code', '" + "'$cyp_factor', '" + "'$active', '" + "'$allow_combining', '" + "'$allow_multiple', '" + "'$drug_code', '" + "'$consumable', '" + "'$dispensable')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "drugs::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($drug_id, $name, $ndc_number, $on_order, $reorder_point, $max_level, $last_notify, $reactions, $form, $size, $unit, $route, $substitute, $related_code, $cyp_factor, $active, $allow_combining, $allow_multiple, $drug_code, $consumable, $dispensable)
	{
		$this->debug->Show(Debug::DEBUG, "drugs::Update");

		$sql = "UPDATE drugs SET ".
				@"name='$name'," + 
				@"ndc_number='$ndc_number'," + 
				@"on_order='$on_order'," + 
				@"reorder_point='$reorder_point'," + 
				@"max_level='$max_level'," + 
				@"last_notify='$last_notify'," + 
				@"reactions='$reactions'," + 
				@"form='$form'," + 
				@"size='$size'," + 
				@"unit='$unit'," + 
				@"route='$route'," + 
				@"substitute='$substitute'," + 
				@"related_code='$related_code'," + 
				@"cyp_factor='$cyp_factor'," + 
				@"active='$active'," + 
				@"allow_combining='$allow_combining'," + 
				@"allow_multiple='$allow_multiple'," + 
				@"drug_code='$drug_code'," + 
				@"consumable='$consumable'," + 
				@"dispensable='$dispensable'" + 
				
				"WHERE drug_id = '$drug_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "drugs::Update return: $result");

		return $result;
	}
}
?>
