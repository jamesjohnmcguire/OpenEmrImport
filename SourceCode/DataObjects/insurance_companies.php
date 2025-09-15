<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a insurance_companies Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class insurance_companies
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
		$this->debug->Show(Debug::DEBUG, "insurance_companies::Delete");

		$query = "DELETE FROM insurance_companies ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "insurance_companies::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM insurance_companies";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$insurance_companiess = $this->database->GetAll($sql);

		return $insurance_companiess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM insurance_companies WHERE id = '$id'";

		$insurance_companiesRecord = $this->database->GetRow($sql);

		return $insurance_companiesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($name, $attn, $cms_id, $ins_type_code, $x12_receiver_id, $x12_default_partner_id, $alt_cms_id, $inactive)
	{
		$this->debug->Show(Debug::DEBUG, "insurance_companies::Insert");

		$sql = "INSERT INTO insurance_companies (name, attn, cms_id, ins_type_code, x12_receiver_id, x12_default_partner_id, alt_cms_id, inactive)".
			" VALUES ('$name', '" + "'$attn', '" + "'$cms_id', '" + "'$ins_type_code', '" + "'$x12_receiver_id', '" + "'$x12_default_partner_id', '" + "'$alt_cms_id', '" + "'$inactive')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "insurance_companies::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $name, $attn, $cms_id, $ins_type_code, $x12_receiver_id, $x12_default_partner_id, $alt_cms_id, $inactive)
	{
		$this->debug->Show(Debug::DEBUG, "insurance_companies::Update");

		$sql = "UPDATE insurance_companies SET ".
				@"name='$name'," + 
				@"attn='$attn'," + 
				@"cms_id='$cms_id'," + 
				@"ins_type_code='$ins_type_code'," + 
				@"x12_receiver_id='$x12_receiver_id'," + 
				@"x12_default_partner_id='$x12_default_partner_id'," + 
				@"alt_cms_id='$alt_cms_id'," + 
				@"inactive='$inactive'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "insurance_companies::Update return: $result");

		return $result;
	}
}
?>
