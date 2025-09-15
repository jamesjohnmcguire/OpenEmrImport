<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a documents_legal_detail Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class documents_legal_detail
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
	function Delete($dld_id)
	{
		$this->debug->Show(Debug::DEBUG, "documents_legal_detail::Delete");

		$query = "DELETE FROM documents_legal_detail ".
			"WHERE dld_id = '$dld_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "documents_legal_detail::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM documents_legal_detail";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$documents_legal_details = $this->database->GetAll($sql);

		return $documents_legal_details;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($dld_id)
	{
		$sql = "SELECT * FROM documents_legal_detail WHERE dld_id = '$dld_id'";

		$documents_legal_detailRecord = $this->database->GetRow($sql);

		return $documents_legal_detailRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($dld_pid, $dld_facility, $dld_provider, $dld_encounter, $dld_master_docid, $dld_signed, $dld_signed_time, $dld_filepath, $dld_filename, $dld_signing_person, $dld_sign_level, $dld_content, $dld_file_for_pdf_generation, $dld_denial_reason, $dld_moved, $dld_patient_comments)
	{
		$this->debug->Show(Debug::DEBUG, "documents_legal_detail::Insert");

		$sql = "INSERT INTO documents_legal_detail (dld_pid, dld_facility, dld_provider, dld_encounter, dld_master_docid, dld_signed, dld_signed_time, dld_filepath, dld_filename, dld_signing_person, dld_sign_level, dld_content, dld_file_for_pdf_generation, dld_denial_reason, dld_moved, dld_patient_comments)".
			" VALUES ('$dld_pid', '" + "'$dld_facility', '" + "'$dld_provider', '" + "'$dld_encounter', '" + "'$dld_master_docid', '" + "'$dld_signed', '" + "'$dld_signed_time', '" + "'$dld_filepath', '" + "'$dld_filename', '" + "'$dld_signing_person', '" + "'$dld_sign_level', '" + "'$dld_content', '" + "'$dld_file_for_pdf_generation', '" + "'$dld_denial_reason', '" + "'$dld_moved', '" + "'$dld_patient_comments')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "documents_legal_detail::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($dld_id, $dld_pid, $dld_facility, $dld_provider, $dld_encounter, $dld_master_docid, $dld_signed, $dld_signed_time, $dld_filepath, $dld_filename, $dld_signing_person, $dld_sign_level, $dld_content, $dld_file_for_pdf_generation, $dld_denial_reason, $dld_moved, $dld_patient_comments)
	{
		$this->debug->Show(Debug::DEBUG, "documents_legal_detail::Update");

		$sql = "UPDATE documents_legal_detail SET ".
				@"dld_pid='$dld_pid'," + 
				@"dld_facility='$dld_facility'," + 
				@"dld_provider='$dld_provider'," + 
				@"dld_encounter='$dld_encounter'," + 
				@"dld_master_docid='$dld_master_docid'," + 
				@"dld_signed='$dld_signed'," + 
				@"dld_signed_time='$dld_signed_time'," + 
				@"dld_filepath='$dld_filepath'," + 
				@"dld_filename='$dld_filename'," + 
				@"dld_signing_person='$dld_signing_person'," + 
				@"dld_sign_level='$dld_sign_level'," + 
				@"dld_content='$dld_content'," + 
				@"dld_file_for_pdf_generation='$dld_file_for_pdf_generation'," + 
				@"dld_denial_reason='$dld_denial_reason'," + 
				@"dld_moved='$dld_moved'," + 
				@"dld_patient_comments='$dld_patient_comments'" + 
				
				"WHERE dld_id = '$dld_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "documents_legal_detail::Update return: $result");

		return $result;
	}
}
?>
