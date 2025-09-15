<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a openemr_postcalendar_categories Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class openemr_postcalendar_categories
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
	function Delete($pc_catid)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_categories::Delete");

		$query = "DELETE FROM openemr_postcalendar_categories ".
			"WHERE pc_catid = '$pc_catid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_categories::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM openemr_postcalendar_categories";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$openemr_postcalendar_categoriess = $this->database->GetAll($sql);

		return $openemr_postcalendar_categoriess;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pc_catid)
	{
		$sql = "SELECT * FROM openemr_postcalendar_categories WHERE pc_catid = '$pc_catid'";

		$openemr_postcalendar_categoriesRecord = $this->database->GetRow($sql);

		return $openemr_postcalendar_categoriesRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pc_constant_id, $pc_catname, $pc_catcolor, $pc_catdesc, $pc_recurrtype, $pc_enddate, $pc_recurrspec, $pc_recurrfreq, $pc_duration, $pc_end_date_flag, $pc_end_date_type, $pc_end_date_freq, $pc_end_all_day, $pc_dailylimit, $pc_cattype, $pc_active, $pc_seq, $aco_spec)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_categories::Insert");

		$sql = "INSERT INTO openemr_postcalendar_categories (pc_constant_id, pc_catname, pc_catcolor, pc_catdesc, pc_recurrtype, pc_enddate, pc_recurrspec, pc_recurrfreq, pc_duration, pc_end_date_flag, pc_end_date_type, pc_end_date_freq, pc_end_all_day, pc_dailylimit, pc_cattype, pc_active, pc_seq, aco_spec)".
			" VALUES ('$pc_constant_id', '" + "'$pc_catname', '" + "'$pc_catcolor', '" + "'$pc_catdesc', '" + "'$pc_recurrtype', '" + "'$pc_enddate', '" + "'$pc_recurrspec', '" + "'$pc_recurrfreq', '" + "'$pc_duration', '" + "'$pc_end_date_flag', '" + "'$pc_end_date_type', '" + "'$pc_end_date_freq', '" + "'$pc_end_all_day', '" + "'$pc_dailylimit', '" + "'$pc_cattype', '" + "'$pc_active', '" + "'$pc_seq', '" + "'$aco_spec')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_categories::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pc_catid, $pc_constant_id, $pc_catname, $pc_catcolor, $pc_catdesc, $pc_recurrtype, $pc_enddate, $pc_recurrspec, $pc_recurrfreq, $pc_duration, $pc_end_date_flag, $pc_end_date_type, $pc_end_date_freq, $pc_end_all_day, $pc_dailylimit, $pc_cattype, $pc_active, $pc_seq, $aco_spec)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_categories::Update");

		$sql = "UPDATE openemr_postcalendar_categories SET ".
				@"pc_constant_id='$pc_constant_id'," + 
				@"pc_catname='$pc_catname'," + 
				@"pc_catcolor='$pc_catcolor'," + 
				@"pc_catdesc='$pc_catdesc'," + 
				@"pc_recurrtype='$pc_recurrtype'," + 
				@"pc_enddate='$pc_enddate'," + 
				@"pc_recurrspec='$pc_recurrspec'," + 
				@"pc_recurrfreq='$pc_recurrfreq'," + 
				@"pc_duration='$pc_duration'," + 
				@"pc_end_date_flag='$pc_end_date_flag'," + 
				@"pc_end_date_type='$pc_end_date_type'," + 
				@"pc_end_date_freq='$pc_end_date_freq'," + 
				@"pc_end_all_day='$pc_end_all_day'," + 
				@"pc_dailylimit='$pc_dailylimit'," + 
				@"pc_cattype='$pc_cattype'," + 
				@"pc_active='$pc_active'," + 
				@"pc_seq='$pc_seq'," + 
				@"aco_spec='$aco_spec'" + 
				
				"WHERE pc_catid = '$pc_catid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_categories::Update return: $result");

		return $result;
	}
}
?>
