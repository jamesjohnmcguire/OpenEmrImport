<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a documents Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class documents
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
		$this->debug->Show(Debug::DEBUG, "documents::Delete");

		$query = "DELETE FROM documents ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "documents::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = null, $types = null)
	{
		$sql = "SELECT * FROM documents";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$documentss = $this->database->GetAll($sql, $values, $types);

		return $documentss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM documents WHERE id = '$id'";

		$documentsRecord = $this->database->GetRow($sql);

		return $documentsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($id, $type, $size, $date, $url, $thumb_url, $mimetype,
		$pages, $owner, $foreign_id, $docdate, $hash, $list_id,
		$couch_docid, $couch_revid, $storagemethod, $path_depth, $imported,
		$encounter_id, $encounter_check, $audit_master_approval_status,
		$audit_master_id, $documentationOf)
	{
		$this->debug->Show(Debug::DEBUG, "documents::Insert");

		$statement = 'INSERT INTO documents (id, type, size, date, url, '.
			'thumb_url, mimetype, pages, owner, foreign_id, docdate, hash, '.
			'list_id, couch_docid, couch_revid, storagemethod, path_depth, '.
			'imported, encounter_id, encounter_check, '.
			'audit_master_approval_status, audit_master_id, documentationOf)'.
			' VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '.
			'?, ?, ?, ?, ?)';

		$values = array($id, $type, $size, $date, $url, $thumb_url, $mimetype,
			$pages, $owner, $foreign_id, $docdate, $hash, $list_id,
			$couch_docid, $couch_revid, $storagemethod, $path_depth,
			$imported, $encounter_id, $encounter_check,
			$audit_master_approval_status, $audit_master_id,
			$documentationOf);

		$types = array('i', 's', 'i', 's', 's', 's', 's', 'i', 'i', 'i', 's',
			's', 'i', 's', 's', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 's');

		$result	= $this->database->Insert($statement, $values, $types);
		$this->debug->Show(Debug::DEBUG, "documents::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $type, $size, $date, $url, $thumb_url, $mimetype, $pages, $owner, $revision, $foreign_id, $docdate, $hash, $list_id, $couch_docid, $couch_revid, $storagemethod, $path_depth, $imported, $encounter_id, $encounter_check, $audit_master_approval_status, $audit_master_id, $documentationOf)
	{
		$this->debug->Show(Debug::DEBUG, "documents::Update");

		$sql = "UPDATE documents SET ".
				@"type='$type'," + 
				@"size='$size'," + 
				@"date='$date'," + 
				@"url='$url'," + 
				@"thumb_url='$thumb_url'," + 
				@"mimetype='$mimetype'," + 
				@"pages='$pages'," + 
				@"owner='$owner'," + 
				@"revision='$revision'," + 
				@"foreign_id='$foreign_id'," + 
				@"docdate='$docdate'," + 
				@"hash='$hash'," + 
				@"list_id='$list_id'," + 
				@"couch_docid='$couch_docid'," + 
				@"couch_revid='$couch_revid'," + 
				@"storagemethod='$storagemethod'," + 
				@"path_depth='$path_depth'," + 
				@"imported='$imported'," + 
				@"encounter_id='$encounter_id'," + 
				@"encounter_check='$encounter_check'," + 
				@"audit_master_approval_status='$audit_master_approval_status'," + 
				@"audit_master_id='$audit_master_id'," + 
				@"documentationOf='$documentationOf'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "documents::Update return: $result");

		return $result;
	}
}
?>
