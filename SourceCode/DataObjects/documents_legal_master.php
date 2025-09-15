<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a documents_legal_master Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class documents_legal_master
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
	function Delete($dlm_category)
	{
		$this->debug->Show(Debug::DEBUG, "documents_legal_master::Delete");

		$query = "DELETE FROM documents_legal_master ".
			"WHERE dlm_category = '$dlm_category'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "documents_legal_master::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM documents_legal_master";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$documents_legal_masters = $this->database->GetAll($sql);

		return $documents_legal_masters;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($dlm_category)
	{
		$sql = "SELECT * FROM documents_legal_master WHERE dlm_category = '$dlm_category'";

		$documents_legal_masterRecord = $this->database->GetRow($sql);

		return $documents_legal_masterRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($dlm_subcategory, $dlm_document_id, $dlm_document_name, $dlm_filepath, $dlm_facility, $dlm_provider, $dlm_sign_height, $dlm_sign_width, $dlm_filename, $dlm_effective_date, $dlm_version, $content, $dlm_savedsign, $dlm_review, $dlm_upload_type)
	{
		$this->debug->Show(Debug::DEBUG, "documents_legal_master::Insert");

		$sql = "INSERT INTO documents_legal_master (dlm_subcategory, dlm_document_id, dlm_document_name, dlm_filepath, dlm_facility, dlm_provider, dlm_sign_height, dlm_sign_width, dlm_filename, dlm_effective_date, dlm_version, content, dlm_savedsign, dlm_review, dlm_upload_type)".
			" VALUES ('$dlm_subcategory', '" + "'$dlm_document_id', '" + "'$dlm_document_name', '" + "'$dlm_filepath', '" + "'$dlm_facility', '" + "'$dlm_provider', '" + "'$dlm_sign_height', '" + "'$dlm_sign_width', '" + "'$dlm_filename', '" + "'$dlm_effective_date', '" + "'$dlm_version', '" + "'$content', '" + "'$dlm_savedsign', '" + "'$dlm_review', '" + "'$dlm_upload_type')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "documents_legal_master::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($dlm_category, $dlm_subcategory, $dlm_document_id, $dlm_document_name, $dlm_filepath, $dlm_facility, $dlm_provider, $dlm_sign_height, $dlm_sign_width, $dlm_filename, $dlm_effective_date, $dlm_version, $content, $dlm_savedsign, $dlm_review, $dlm_upload_type)
	{
		$this->debug->Show(Debug::DEBUG, "documents_legal_master::Update");

		$sql = "UPDATE documents_legal_master SET ".
				@"dlm_subcategory='$dlm_subcategory'," + 
				@"dlm_document_id='$dlm_document_id'," + 
				@"dlm_document_name='$dlm_document_name'," + 
				@"dlm_filepath='$dlm_filepath'," + 
				@"dlm_facility='$dlm_facility'," + 
				@"dlm_provider='$dlm_provider'," + 
				@"dlm_sign_height='$dlm_sign_height'," + 
				@"dlm_sign_width='$dlm_sign_width'," + 
				@"dlm_filename='$dlm_filename'," + 
				@"dlm_effective_date='$dlm_effective_date'," + 
				@"dlm_version='$dlm_version'," + 
				@"content='$content'," + 
				@"dlm_savedsign='$dlm_savedsign'," + 
				@"dlm_review='$dlm_review'," + 
				@"dlm_upload_type='$dlm_upload_type'" + 
				
				"WHERE dlm_category = '$dlm_category'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "documents_legal_master::Update return: $result");

		return $result;
	}
}
?>
