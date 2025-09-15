<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a code_types Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class code_types
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
	function Delete($ct_key)
	{
		$this->debug->Show(Debug::DEBUG, "code_types::Delete");

		$query = "DELETE FROM code_types ".
			"WHERE ct_key = '$ct_key'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "code_types::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM code_types";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$code_typess = $this->database->GetAll($sql);

		return $code_typess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($ct_key)
	{
		$sql = "SELECT * FROM code_types WHERE ct_key = '$ct_key'";

		$code_typesRecord = $this->database->GetRow($sql);

		return $code_typesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($ct_id, $ct_seq, $ct_mod, $ct_just, $ct_mask, $ct_fee, $ct_rel, $ct_nofs, $ct_diag, $ct_active, $ct_label, $ct_external, $ct_claim, $ct_proc, $ct_term, $ct_problem, $ct_drug)
	{
		$this->debug->Show(Debug::DEBUG, "code_types::Insert");

		$sql = "INSERT INTO code_types (ct_id, ct_seq, ct_mod, ct_just, ct_mask, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem, ct_drug)".
			" VALUES ('$ct_id', '" + "'$ct_seq', '" + "'$ct_mod', '" + "'$ct_just', '" + "'$ct_mask', '" + "'$ct_fee', '" + "'$ct_rel', '" + "'$ct_nofs', '" + "'$ct_diag', '" + "'$ct_active', '" + "'$ct_label', '" + "'$ct_external', '" + "'$ct_claim', '" + "'$ct_proc', '" + "'$ct_term', '" + "'$ct_problem', '" + "'$ct_drug')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "code_types::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($ct_key, $ct_id, $ct_seq, $ct_mod, $ct_just, $ct_mask, $ct_fee, $ct_rel, $ct_nofs, $ct_diag, $ct_active, $ct_label, $ct_external, $ct_claim, $ct_proc, $ct_term, $ct_problem, $ct_drug)
	{
		$this->debug->Show(Debug::DEBUG, "code_types::Update");

		$sql = "UPDATE code_types SET ".
				@"ct_id='$ct_id'," + 
				@"ct_seq='$ct_seq'," + 
				@"ct_mod='$ct_mod'," + 
				@"ct_just='$ct_just'," + 
				@"ct_mask='$ct_mask'," + 
				@"ct_fee='$ct_fee'," + 
				@"ct_rel='$ct_rel'," + 
				@"ct_nofs='$ct_nofs'," + 
				@"ct_diag='$ct_diag'," + 
				@"ct_active='$ct_active'," + 
				@"ct_label='$ct_label'," + 
				@"ct_external='$ct_external'," + 
				@"ct_claim='$ct_claim'," + 
				@"ct_proc='$ct_proc'," + 
				@"ct_term='$ct_term'," + 
				@"ct_problem='$ct_problem'," + 
				@"ct_drug='$ct_drug'" + 
				
				"WHERE ct_key = '$ct_key'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "code_types::Update return: $result");

		return $result;
	}
}
?>
