<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a x12_partners Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class x12_partners
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
		$this->debug->Show(Debug::DEBUG, "x12_partners::Delete");

		$query = "DELETE FROM x12_partners ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "x12_partners::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM x12_partners";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$x12_partnerss = $this->database->GetAll($sql);

		return $x12_partnerss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM x12_partners WHERE id = '$id'";

		$x12_partnersRecord = $this->database->GetRow($sql);

		return $x12_partnersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($name, $id_number, $x12_sender_id, $x12_receiver_id, $processing_format, $x12_isa01, $x12_isa02, $x12_isa03, $x12_isa04, $x12_isa05, $x12_isa07, $x12_isa14, $x12_isa15, $x12_gs02, $x12_per06, $x12_gs03)
	{
		$this->debug->Show(Debug::DEBUG, "x12_partners::Insert");

		$sql = "INSERT INTO x12_partners (name, id_number, x12_sender_id, x12_receiver_id, processing_format, x12_isa01, x12_isa02, x12_isa03, x12_isa04, x12_isa05, x12_isa07, x12_isa14, x12_isa15, x12_gs02, x12_per06, x12_gs03)".
			" VALUES ('$name', '" + "'$id_number', '" + "'$x12_sender_id', '" + "'$x12_receiver_id', '" + "'$processing_format', '" + "'$x12_isa01', '" + "'$x12_isa02', '" + "'$x12_isa03', '" + "'$x12_isa04', '" + "'$x12_isa05', '" + "'$x12_isa07', '" + "'$x12_isa14', '" + "'$x12_isa15', '" + "'$x12_gs02', '" + "'$x12_per06', '" + "'$x12_gs03')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "x12_partners::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $name, $id_number, $x12_sender_id, $x12_receiver_id, $processing_format, $x12_isa01, $x12_isa02, $x12_isa03, $x12_isa04, $x12_isa05, $x12_isa07, $x12_isa14, $x12_isa15, $x12_gs02, $x12_per06, $x12_gs03)
	{
		$this->debug->Show(Debug::DEBUG, "x12_partners::Update");

		$sql = "UPDATE x12_partners SET ".
				@"name='$name'," + 
				@"id_number='$id_number'," + 
				@"x12_sender_id='$x12_sender_id'," + 
				@"x12_receiver_id='$x12_receiver_id'," + 
				@"processing_format='$processing_format'," + 
				@"x12_isa01='$x12_isa01'," + 
				@"x12_isa02='$x12_isa02'," + 
				@"x12_isa03='$x12_isa03'," + 
				@"x12_isa04='$x12_isa04'," + 
				@"x12_isa05='$x12_isa05'," + 
				@"x12_isa07='$x12_isa07'," + 
				@"x12_isa14='$x12_isa14'," + 
				@"x12_isa15='$x12_isa15'," + 
				@"x12_gs02='$x12_gs02'," + 
				@"x12_per06='$x12_per06'," + 
				@"x12_gs03='$x12_gs03'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "x12_partners::Update return: $result");

		return $result;
	}
}
?>
