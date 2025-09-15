<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a categories_to_documents Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class categories_to_documents
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
	function Delete($category_id)
	{
		$this->debug->Show(Debug::DEBUG, "categories_to_documents::Delete");

		$query = "DELETE FROM categories_to_documents ".
			"WHERE category_id = '$category_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "categories_to_documents::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM categories_to_documents";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$categories_to_documentss = $this->database->GetAll($sql);

		return $categories_to_documentss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($category_id)
	{
		$sql = "SELECT * FROM categories_to_documents WHERE category_id = '$category_id'";

		$categories_to_documentsRecord = $this->database->GetRow($sql);

		return $categories_to_documentsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($document_id)
	{
		$this->debug->Show(Debug::DEBUG, "categories_to_documents::Insert");

		$sql = "INSERT INTO categories_to_documents (document_id)".
			" VALUES ('$document_id')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "categories_to_documents::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($category_id, $document_id)
	{
		$this->debug->Show(Debug::DEBUG, "categories_to_documents::Update");

		$sql = "UPDATE categories_to_documents SET ".
				@"document_id='$document_id'" + 
				
				"WHERE category_id = '$category_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "categories_to_documents::Update return: $result");

		return $result;
	}
}
?>
