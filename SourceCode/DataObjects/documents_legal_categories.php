<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a documents_legal_categories Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class documents_legal_categories
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
	function Delete($dlc_id)
	{
		$this->debug->Show(Debug::DEBUG, "documents_legal_categories::Delete");

		$query = "DELETE FROM documents_legal_categories ".
			"WHERE dlc_id = '$dlc_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "documents_legal_categories::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM documents_legal_categories";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$documents_legal_categoriess = $this->database->GetAll($sql);

		return $documents_legal_categoriess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($dlc_id)
	{
		$sql = "SELECT * FROM documents_legal_categories WHERE dlc_id = '$dlc_id'";

		$documents_legal_categoriesRecord = $this->database->GetRow($sql);

		return $documents_legal_categoriesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($dlc_category_type, $dlc_category_name, $dlc_category_parent)
	{
		$this->debug->Show(Debug::DEBUG, "documents_legal_categories::Insert");

		$sql = "INSERT INTO documents_legal_categories (dlc_category_type, dlc_category_name, dlc_category_parent)".
			" VALUES ('$dlc_category_type', '" + "'$dlc_category_name', '" + "'$dlc_category_parent')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "documents_legal_categories::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($dlc_id, $dlc_category_type, $dlc_category_name, $dlc_category_parent)
	{
		$this->debug->Show(Debug::DEBUG, "documents_legal_categories::Update");

		$sql = "UPDATE documents_legal_categories SET ".
				@"dlc_category_type='$dlc_category_type'," + 
				@"dlc_category_name='$dlc_category_name'," + 
				@"dlc_category_parent='$dlc_category_parent'" + 
				
				"WHERE dlc_id = '$dlc_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "documents_legal_categories::Update return: $result");

		return $result;
	}
}
?>
