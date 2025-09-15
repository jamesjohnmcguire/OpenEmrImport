<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a lists Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class lists
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
		$this->debug->Show(Debug::DEBUG, "lists::Delete");

		$query = "DELETE FROM lists ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "lists::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = null, $types = null)
	{
		$sql = "SELECT * FROM lists";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$lists = $this->database->GetAll($sql, $values, $types);

		return $lists;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM lists WHERE id = '$id'";

		$listsRecord = $this->database->GetRow($sql);

		return $listsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $type, $subtype, $title, $begdate, $enddate,
		$returndate, $occurrence, $classification, $referredby, $extrainfo,
		$diagnosis, $activity, $comments, $pid, $user, $groupname, $outcome,
		$destination, $reinjury_id, $injury_part, $injury_type, $injury_grade,
		$reaction, $external_allergyid, $erx_source, $erx_uploaded,
		$severity_al, $external_id)
	{
		$this->debug->Show(Debug::DEBUG, "lists::Insert");

		$statement = 'INSERT INTO lists (date, type, subtype, title, '.
			'begdate, enddate, returndate, occurrence, classification, '.
			'referredby, extrainfo, diagnosis, activity, comments, pid, '.
			'user, groupname, outcome, destination, reinjury_id, '.
			'injury_part, injury_type, injury_grade, reaction, '.
			'external_allergyid, erx_source, erx_uploaded, severity_al, '.
			'external_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '.
			'?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

		$values = array($date, $type, $subtype, $title, $begdate, $enddate,
			$returndate, $occurrence, $classification, $referredby,
			$extrainfo, $diagnosis, $activity, $comments, $pid, $user,
			$groupname, $outcome, $destination, $reinjury_id, $injury_part,
			$injury_type, $injury_grade, $reaction, $external_allergyid,
			$erx_source, $erx_uploaded, $severity_al, $external_id);

		$types = array('s', 's', 's', 's', 's', 's', 's', 'i', 'i', 's', 's',
			's', 'i', 's', 'i', 's', 's', 'i', 's', 'i', 's', 's', 's', 's',
			'i', 'i', 'i', 's', 's');

		$result	= $this->database->Insert($statement, $values, $types);
		$this->debug->Show(Debug::DEBUG, "lists::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $type, $subtype, $title, $begdate, $enddate, $returndate, $occurrence, $classification, $referredby, $extrainfo, $diagnosis, $activity, $comments, $pid, $user, $groupname, $outcome, $destination, $reinjury_id, $injury_part, $injury_type, $injury_grade, $reaction, $external_allergyid, $erx_source, $erx_uploaded, $modifydate, $severity_al, $external_id)
	{
		$this->debug->Show(Debug::DEBUG, "lists::Update");

		$sql = "UPDATE lists SET ".
				@"date='$date'," + 
				@"type='$type'," + 
				@"subtype='$subtype'," + 
				@"title='$title'," + 
				@"begdate='$begdate'," + 
				@"enddate='$enddate'," + 
				@"returndate='$returndate'," + 
				@"occurrence='$occurrence'," + 
				@"classification='$classification'," + 
				@"referredby='$referredby'," + 
				@"extrainfo='$extrainfo'," + 
				@"diagnosis='$diagnosis'," + 
				@"activity='$activity'," + 
				@"comments='$comments'," + 
				@"pid='$pid'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"outcome='$outcome'," + 
				@"destination='$destination'," + 
				@"reinjury_id='$reinjury_id'," + 
				@"injury_part='$injury_part'," + 
				@"injury_type='$injury_type'," + 
				@"injury_grade='$injury_grade'," + 
				@"reaction='$reaction'," + 
				@"external_allergyid='$external_allergyid'," + 
				@"erx_source='$erx_source'," + 
				@"erx_uploaded='$erx_uploaded'," + 
				@"modifydate='$modifydate'," + 
				@"severity_al='$severity_al'," + 
				@"external_id='$external_id'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "lists::Update return: $result");

		return $result;
	}
}
?>
