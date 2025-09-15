<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a pma_pdf_pages Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class pma_pdf_pages
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
	function Delete($db_name)
	{
		$this->debug->Show(Debug::DEBUG, "pma_pdf_pages::Delete");

		$query = "DELETE FROM pma_pdf_pages ".
			"WHERE db_name = '$db_name'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "pma_pdf_pages::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM pma_pdf_pages";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$pma_pdf_pagess = $this->database->GetAll($sql);

		return $pma_pdf_pagess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($db_name)
	{
		$sql = "SELECT * FROM pma_pdf_pages WHERE db_name = '$db_name'";

		$pma_pdf_pagesRecord = $this->database->GetRow($sql);

		return $pma_pdf_pagesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($page_nr, $page_descr)
	{
		$this->debug->Show(Debug::DEBUG, "pma_pdf_pages::Insert");

		$sql = "INSERT INTO pma_pdf_pages (page_nr, page_descr)".
			" VALUES ('$page_nr', '" + "'$page_descr')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "pma_pdf_pages::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($db_name, $page_nr, $page_descr)
	{
		$this->debug->Show(Debug::DEBUG, "pma_pdf_pages::Update");

		$sql = "UPDATE pma_pdf_pages SET ".
				@"page_nr='$page_nr'," + 
				@"page_descr='$page_descr'" + 
				
				"WHERE db_name = '$db_name'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "pma_pdf_pages::Update return: $result");

		return $result;
	}
}
?>
