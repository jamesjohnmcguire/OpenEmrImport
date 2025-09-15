<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a version Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class version
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
	function Delete($v_major)
	{
		$this->debug->Show(Debug::DEBUG, "version::Delete");

		$query = "DELETE FROM version ".
			"WHERE v_major = '$v_major'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "version::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM version";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$versions = $this->database->GetAll($sql);

		return $versions;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($v_major)
	{
		$sql = "SELECT * FROM version WHERE v_major = '$v_major'";

		$versionRecord = $this->database->GetRow($sql);

		return $versionRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($v_minor, $v_patch, $v_realpatch, $v_tag, $v_database, $v_acl)
	{
		$this->debug->Show(Debug::DEBUG, "version::Insert");

		$sql = "INSERT INTO version (v_minor, v_patch, v_realpatch, v_tag, v_database, v_acl)".
			" VALUES ('$v_minor', '" + "'$v_patch', '" + "'$v_realpatch', '" + "'$v_tag', '" + "'$v_database', '" + "'$v_acl')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "version::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($v_major, $v_minor, $v_patch, $v_realpatch, $v_tag, $v_database, $v_acl)
	{
		$this->debug->Show(Debug::DEBUG, "version::Update");

		$sql = "UPDATE version SET ".
				@"v_minor='$v_minor'," + 
				@"v_patch='$v_patch'," + 
				@"v_realpatch='$v_realpatch'," + 
				@"v_tag='$v_tag'," + 
				@"v_database='$v_database'," + 
				@"v_acl='$v_acl'" + 
				
				"WHERE v_major = '$v_major'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "version::Update return: $result");

		return $result;
	}
}
?>
