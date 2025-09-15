<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a drug_templates Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class drug_templates
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
		$this->debug->Show(Debug::DEBUG, "drug_templates::Delete");

		$query = "DELETE FROM drug_templates ".
			"WHERE drug_id = '$drug_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "drug_templates::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM drug_templates";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$drug_templatess = $this->database->GetAll($sql);

		return $drug_templatess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($drug_id)
	{
		$sql = "SELECT * FROM drug_templates WHERE drug_id = '$drug_id'";

		$drug_templatesRecord = $this->database->GetRow($sql);

		return $drug_templatesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($selector, $dosage, $period, $quantity, $refills, $taxrates)
	{
		$this->debug->Show(Debug::DEBUG, "drug_templates::Insert");

		$sql = "INSERT INTO drug_templates (selector, dosage, period, quantity, refills, taxrates)".
			" VALUES ('$selector', '" + "'$dosage', '" + "'$period', '" + "'$quantity', '" + "'$refills', '" + "'$taxrates')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "drug_templates::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($drug_id, $selector, $dosage, $period, $quantity, $refills, $taxrates)
	{
		$this->debug->Show(Debug::DEBUG, "drug_templates::Update");

		$sql = "UPDATE drug_templates SET ".
				@"selector='$selector'," + 
				@"dosage='$dosage'," + 
				@"period='$period'," + 
				@"quantity='$quantity'," + 
				@"refills='$refills'," + 
				@"taxrates='$taxrates'" + 
				
				"WHERE drug_id = '$drug_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "drug_templates::Update return: $result");

		return $result;
	}
}
?>
