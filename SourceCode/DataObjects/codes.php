<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a codes Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class codes
{
	var	$database;
	var $debug;
	var $lastQuery;

	/////////////////////////////////////////////////////////////////////////
	// constructor
	/////////////////////////////////////////////////////////////////////////
	function __construct($database, $debug, &$lastQuery)
	{
		$this->database	= $database;
		$this->debug = $debug;
		$this->lastQuery = & $lastQuery;
	}

	/////////////////////////////////////////////////////////////////////////
	// Delete
	/////////////////////////////////////////////////////////////////////////
	function Delete($id)
	{
		$this->debug->Show(Debug::DEBUG, "codes::Delete");

		$query = "DELETE FROM codes ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "codes::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = array(), $types = array())
	{
		$sql = "SELECT * FROM codes";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$this->debug->Show(Debug::DEBUG, "codes: $sql");
		$codes = $this->database->GetAll($sql, $values, $types);

		return $codes;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM codes WHERE id = '$id'";

		$codesRecord = $this->database->GetRow($sql);

		return $codesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($code_text, $code_text_short, $code, $code_type,
		$modifier, $units, $fee, $superbill, $related_code, $taxrates,
		$cyp_factor, $active, $reportable, $financial_reporting,
		$revenue_code)
	{
		$this->debug->Show(Debug::INFO, "codes::Insert");

		$statement = 'INSERT INTO codes (code_text, code_text_short, code, '.
			'code_type, modifier, units, fee, superbill, related_code, '.
			'taxrates, cyp_factor, active, reportable, financial_reporting, '.
			'revenue_code) VALUES '.
			'(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

		$values = array($code_text, $code_text_short, $code, $code_type,
			$modifier, $units, $fee, $superbill, $related_code, $taxrates,
			$cyp_factor, $active, $reportable, $financial_reporting,
			$revenue_code);

		$types = array('s', 's', 's', 'i', 's', 'i', 'i', 's', 's', 's', 'i',
			'i', 'i', 'i', 's');

		$result	= $this->database->Insert($statement, $values, $types);
		$this->debug->Show(Debug::INFO, "codes::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $code_text, $code_text_short, $code, $code_type, $modifier, $units, $fee, $superbill, $related_code, $taxrates, $cyp_factor, $active, $reportable, $financial_reporting, $revenue_code)
	{
		$this->debug->Show(Debug::DEBUG, "codes::Update");

		$sql = "UPDATE codes SET ".
				@"code_text='$code_text'," + 
				@"code_text_short='$code_text_short'," + 
				@"code='$code'," + 
				@"code_type='$code_type'," + 
				@"modifier='$modifier'," + 
				@"units='$units'," + 
				@"fee='$fee'," + 
				@"superbill='$superbill'," + 
				@"related_code='$related_code'," + 
				@"taxrates='$taxrates'," + 
				@"cyp_factor='$cyp_factor'," + 
				@"active='$active'," + 
				@"reportable='$reportable'," + 
				@"financial_reporting='$financial_reporting'," + 
				@"revenue_code='$revenue_code'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "codes::Update return: $result");

		return $result;
	}
}
?>
