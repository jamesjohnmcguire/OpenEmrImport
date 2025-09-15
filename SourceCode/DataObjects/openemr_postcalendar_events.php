<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a openemr_postcalendar_events Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class openemr_postcalendar_events
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
	function Delete($pc_eid)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_events::Delete");

		$query = "DELETE FROM openemr_postcalendar_events ".
			"WHERE pc_eid = '$pc_eid'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_events::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = null, $types = null)
	{
		$sql = "SELECT * FROM openemr_postcalendar_events";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$openemr_postcalendar_eventss =
			$this->database->GetAll($sql, $values, $types);

		return $openemr_postcalendar_eventss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($pc_eid)
	{
		$sql = "SELECT * FROM openemr_postcalendar_events WHERE pc_eid = '$pc_eid'";

		$openemr_postcalendar_eventsRecord = $this->database->GetRow($sql);

		return $openemr_postcalendar_eventsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pc_catid, $pc_multiple, $pc_aid, $pc_pid, $pc_gid,
		$pc_title, $pc_time, $pc_hometext, $pc_comments, $pc_counter,
		$pc_topic, $pc_informant, $pc_eventDate, $pc_endDate, $pc_duration,
		$pc_recurrtype, $pc_recurrspec, $pc_recurrfreq, $pc_startTime,
		$pc_endTime, $pc_alldayevent, $pc_location, $pc_conttel, $pc_contname,
		$pc_contemail, $pc_website, $pc_fee, $pc_eventstatus, $pc_sharing,
		$pc_language, $pc_apptstatus, $pc_prefcatid, $pc_facility,
		$pc_sendalertsms, $pc_sendalertemail, $pc_billing_location, $pc_room)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_events::Insert");

		$statement = 'INSERT INTO openemr_postcalendar_events (pc_catid, '.
			'pc_multiple, pc_aid, pc_pid, pc_gid, pc_title, pc_time, '.
			'pc_hometext, pc_comments, pc_counter, pc_topic, pc_informant, '.
			'pc_eventDate, pc_endDate, pc_duration, pc_recurrtype, '.
			'pc_recurrspec, pc_recurrfreq, pc_startTime, pc_endTime, '.
			'pc_alldayevent, pc_location, pc_conttel, pc_contname, '.
			'pc_contemail, pc_website, pc_fee, pc_eventstatus, pc_sharing, '.
			'pc_language, pc_apptstatus, pc_prefcatid, pc_facility, '.
			'pc_sendalertsms, pc_sendalertemail, pc_billing_location, '.
			'pc_room) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '.
			'?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '.
			'?)';

		$values = array($pc_catid, $pc_multiple, $pc_aid, $pc_pid, $pc_gid,
			$pc_title, $pc_time, $pc_hometext, $pc_comments, $pc_counter,
			$pc_topic, $pc_informant, $pc_eventDate, $pc_endDate,
			$pc_duration, $pc_recurrtype, $pc_recurrspec, $pc_recurrfreq,
			$pc_startTime, $pc_endTime, $pc_alldayevent, $pc_location,
			$pc_conttel, $pc_contname, $pc_contemail, $pc_website, $pc_fee,
			$pc_eventstatus, $pc_sharing, $pc_language, $pc_apptstatus,
			$pc_prefcatid, $pc_facility, $pc_sendalertsms, $pc_sendalertemail,
			$pc_billing_location, $pc_room);

		$types = array('i', 'i', 's', 's', 'i', 's', 's', 's', 's', 'i', 'i',
			's', 's', 's', 'i', 'i', 's', 'i', 's', 's', 'i', 's', 's', 's',
			's', 's', 's', 'i', 'i', 's', 's', 'i', 'i', 's', 's', 'i', 's');
		$result	= $this->database->Insert($statement, $values, $types);
		$this->debug->Show(Debug::DEBUG,
			"openemr_postcalendar_events::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($pc_eid, $pc_catid, $pc_multiple, $pc_aid, $pc_pid, $pc_gid, $pc_title, $pc_time, $pc_hometext, $pc_comments, $pc_counter, $pc_topic, $pc_informant, $pc_eventDate, $pc_endDate, $pc_duration, $pc_recurrtype, $pc_recurrspec, $pc_recurrfreq, $pc_startTime, $pc_endTime, $pc_alldayevent, $pc_location, $pc_conttel, $pc_contname, $pc_contemail, $pc_website, $pc_fee, $pc_eventstatus, $pc_sharing, $pc_language, $pc_apptstatus, $pc_prefcatid, $pc_facility, $pc_sendalertsms, $pc_sendalertemail, $pc_billing_location, $pc_room)
	{
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_events::Update");

		$sql = "UPDATE openemr_postcalendar_events SET ".
				@"pc_catid='$pc_catid'," + 
				@"pc_multiple='$pc_multiple'," + 
				@"pc_aid='$pc_aid'," + 
				@"pc_pid='$pc_pid'," + 
				@"pc_gid='$pc_gid'," + 
				@"pc_title='$pc_title'," + 
				@"pc_time='$pc_time'," + 
				@"pc_hometext='$pc_hometext'," + 
				@"pc_comments='$pc_comments'," + 
				@"pc_counter='$pc_counter'," + 
				@"pc_topic='$pc_topic'," + 
				@"pc_informant='$pc_informant'," + 
				@"pc_eventDate='$pc_eventDate'," + 
				@"pc_endDate='$pc_endDate'," + 
				@"pc_duration='$pc_duration'," + 
				@"pc_recurrtype='$pc_recurrtype'," + 
				@"pc_recurrspec='$pc_recurrspec'," + 
				@"pc_recurrfreq='$pc_recurrfreq'," + 
				@"pc_startTime='$pc_startTime'," + 
				@"pc_endTime='$pc_endTime'," + 
				@"pc_alldayevent='$pc_alldayevent'," + 
				@"pc_location='$pc_location'," + 
				@"pc_conttel='$pc_conttel'," + 
				@"pc_contname='$pc_contname'," + 
				@"pc_contemail='$pc_contemail'," + 
				@"pc_website='$pc_website'," + 
				@"pc_fee='$pc_fee'," + 
				@"pc_eventstatus='$pc_eventstatus'," + 
				@"pc_sharing='$pc_sharing'," + 
				@"pc_language='$pc_language'," + 
				@"pc_apptstatus='$pc_apptstatus'," + 
				@"pc_prefcatid='$pc_prefcatid'," + 
				@"pc_facility='$pc_facility'," + 
				@"pc_sendalertsms='$pc_sendalertsms'," + 
				@"pc_sendalertemail='$pc_sendalertemail'," + 
				@"pc_billing_location='$pc_billing_location'," + 
				@"pc_room='$pc_room'" + 
				
				"WHERE pc_eid = '$pc_eid'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "openemr_postcalendar_events::Update return: $result");

		return $result;
	}
}
?>
