<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a medex_icons Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class medex_icons
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
	function Delete($i_UID)
	{
		$this->debug->Show(Debug::DEBUG, "medex_icons::Delete");

		$query = "DELETE FROM medex_icons ".
			"WHERE i_UID = '$i_UID'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "medex_icons::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM medex_icons";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$medex_iconss = $this->database->GetAll($sql);

		return $medex_iconss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($i_UID)
	{
		$sql = "SELECT * FROM medex_icons WHERE i_UID = '$i_UID'";

		$medex_iconsRecord = $this->database->GetRow($sql);

		return $medex_iconsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($msg_type, $msg_status, $i_description, $i_html, $i_blob)
	{
		$this->debug->Show(Debug::DEBUG, "medex_icons::Insert");

		$sql = "INSERT INTO medex_icons (msg_type, msg_status, i_description, i_html, i_blob)".
			" VALUES ('$msg_type', '" + "'$msg_status', '" + "'$i_description', '" + "'$i_html', '" + "'$i_blob')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "medex_icons::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($i_UID, $msg_type, $msg_status, $i_description, $i_html, $i_blob)
	{
		$this->debug->Show(Debug::DEBUG, "medex_icons::Update");

		$sql = "UPDATE medex_icons SET ".
				@"msg_type='$msg_type'," + 
				@"msg_status='$msg_status'," + 
				@"i_description='$i_description'," + 
				@"i_html='$i_html'," + 
				@"i_blob='$i_blob'" + 
				
				"WHERE i_UID = '$i_UID'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "medex_icons::Update return: $result");

		return $result;
	}
}
?>
