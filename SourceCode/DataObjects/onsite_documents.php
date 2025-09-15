<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a onsite_documents Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class onsite_documents
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
		$this->debug->Show(Debug::DEBUG, "onsite_documents::Delete");

		$query = "DELETE FROM onsite_documents ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "onsite_documents::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM onsite_documents";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$onsite_documentss = $this->database->GetAll($sql);

		return $onsite_documentss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM onsite_documents WHERE id = '$id'";

		$onsite_documentsRecord = $this->database->GetRow($sql);

		return $onsite_documentsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $facility, $provider, $encounter, $create_date, $doc_type, $patient_signed_status, $patient_signed_time, $authorize_signed_time, $accept_signed_status, $authorizing_signator, $review_date, $denial_reason, $authorized_signature, $patient_signature, $full_document, $file_name, $file_path)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_documents::Insert");

		$sql = "INSERT INTO onsite_documents (pid, facility, provider, encounter, create_date, doc_type, patient_signed_status, patient_signed_time, authorize_signed_time, accept_signed_status, authorizing_signator, review_date, denial_reason, authorized_signature, patient_signature, full_document, file_name, file_path)".
			" VALUES ('$pid', '" + "'$facility', '" + "'$provider', '" + "'$encounter', '" + "'$create_date', '" + "'$doc_type', '" + "'$patient_signed_status', '" + "'$patient_signed_time', '" + "'$authorize_signed_time', '" + "'$accept_signed_status', '" + "'$authorizing_signator', '" + "'$review_date', '" + "'$denial_reason', '" + "'$authorized_signature', '" + "'$patient_signature', '" + "'$full_document', '" + "'$file_name', '" + "'$file_path')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_documents::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $pid, $facility, $provider, $encounter, $create_date, $doc_type, $patient_signed_status, $patient_signed_time, $authorize_signed_time, $accept_signed_status, $authorizing_signator, $review_date, $denial_reason, $authorized_signature, $patient_signature, $full_document, $file_name, $file_path)
	{
		$this->debug->Show(Debug::DEBUG, "onsite_documents::Update");

		$sql = "UPDATE onsite_documents SET ".
				@"pid='$pid'," + 
				@"facility='$facility'," + 
				@"provider='$provider'," + 
				@"encounter='$encounter'," + 
				@"create_date='$create_date'," + 
				@"doc_type='$doc_type'," + 
				@"patient_signed_status='$patient_signed_status'," + 
				@"patient_signed_time='$patient_signed_time'," + 
				@"authorize_signed_time='$authorize_signed_time'," + 
				@"accept_signed_status='$accept_signed_status'," + 
				@"authorizing_signator='$authorizing_signator'," + 
				@"review_date='$review_date'," + 
				@"denial_reason='$denial_reason'," + 
				@"authorized_signature='$authorized_signature'," + 
				@"patient_signature='$patient_signature'," + 
				@"full_document='$full_document'," + 
				@"file_name='$file_name'," + 
				@"file_path='$file_path'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "onsite_documents::Update return: $result");

		return $result;
	}
}
?>
