<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a insurance_data Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class insurance_data
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
		$this->debug->Show(Debug::DEBUG, "insurance_data::Delete");

		$query = "DELETE FROM insurance_data ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "insurance_data::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM insurance_data";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$insurance_datas = $this->database->GetAll($sql);

		return $insurance_datas;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM insurance_data WHERE id = '$id'";

		$insurance_dataRecord = $this->database->GetRow($sql);

		return $insurance_dataRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($type, $provider, $plan_name, $policy_number, $group_number, $subscriber_lname, $subscriber_mname, $subscriber_fname, $subscriber_relationship, $subscriber_ss, $subscriber_DOB, $subscriber_street, $subscriber_postal_code, $subscriber_city, $subscriber_state, $subscriber_country, $subscriber_phone, $subscriber_employer, $subscriber_employer_street, $subscriber_employer_postal_code, $subscriber_employer_state, $subscriber_employer_country, $subscriber_employer_city, $copay, $date, $pid, $subscriber_sex, $accept_assignment, $policy_type)
	{
		$this->debug->Show(Debug::DEBUG, "insurance_data::Insert");

		$sql = "INSERT INTO insurance_data (type, provider, plan_name, policy_number, group_number, subscriber_lname, subscriber_mname, subscriber_fname, subscriber_relationship, subscriber_ss, subscriber_DOB, subscriber_street, subscriber_postal_code, subscriber_city, subscriber_state, subscriber_country, subscriber_phone, subscriber_employer, subscriber_employer_street, subscriber_employer_postal_code, subscriber_employer_state, subscriber_employer_country, subscriber_employer_city, copay, date, pid, subscriber_sex, accept_assignment, policy_type)".
			" VALUES ('$type', '" + "'$provider', '" + "'$plan_name', '" + "'$policy_number', '" + "'$group_number', '" + "'$subscriber_lname', '" + "'$subscriber_mname', '" + "'$subscriber_fname', '" + "'$subscriber_relationship', '" + "'$subscriber_ss', '" + "'$subscriber_DOB', '" + "'$subscriber_street', '" + "'$subscriber_postal_code', '" + "'$subscriber_city', '" + "'$subscriber_state', '" + "'$subscriber_country', '" + "'$subscriber_phone', '" + "'$subscriber_employer', '" + "'$subscriber_employer_street', '" + "'$subscriber_employer_postal_code', '" + "'$subscriber_employer_state', '" + "'$subscriber_employer_country', '" + "'$subscriber_employer_city', '" + "'$copay', '" + "'$date', '" + "'$pid', '" + "'$subscriber_sex', '" + "'$accept_assignment', '" + "'$policy_type')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "insurance_data::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $type, $provider, $plan_name, $policy_number, $group_number, $subscriber_lname, $subscriber_mname, $subscriber_fname, $subscriber_relationship, $subscriber_ss, $subscriber_DOB, $subscriber_street, $subscriber_postal_code, $subscriber_city, $subscriber_state, $subscriber_country, $subscriber_phone, $subscriber_employer, $subscriber_employer_street, $subscriber_employer_postal_code, $subscriber_employer_state, $subscriber_employer_country, $subscriber_employer_city, $copay, $date, $pid, $subscriber_sex, $accept_assignment, $policy_type)
	{
		$this->debug->Show(Debug::DEBUG, "insurance_data::Update");

		$sql = "UPDATE insurance_data SET ".
				@"type='$type'," + 
				@"provider='$provider'," + 
				@"plan_name='$plan_name'," + 
				@"policy_number='$policy_number'," + 
				@"group_number='$group_number'," + 
				@"subscriber_lname='$subscriber_lname'," + 
				@"subscriber_mname='$subscriber_mname'," + 
				@"subscriber_fname='$subscriber_fname'," + 
				@"subscriber_relationship='$subscriber_relationship'," + 
				@"subscriber_ss='$subscriber_ss'," + 
				@"subscriber_DOB='$subscriber_DOB'," + 
				@"subscriber_street='$subscriber_street'," + 
				@"subscriber_postal_code='$subscriber_postal_code'," + 
				@"subscriber_city='$subscriber_city'," + 
				@"subscriber_state='$subscriber_state'," + 
				@"subscriber_country='$subscriber_country'," + 
				@"subscriber_phone='$subscriber_phone'," + 
				@"subscriber_employer='$subscriber_employer'," + 
				@"subscriber_employer_street='$subscriber_employer_street'," + 
				@"subscriber_employer_postal_code='$subscriber_employer_postal_code'," + 
				@"subscriber_employer_state='$subscriber_employer_state'," + 
				@"subscriber_employer_country='$subscriber_employer_country'," + 
				@"subscriber_employer_city='$subscriber_employer_city'," + 
				@"copay='$copay'," + 
				@"date='$date'," + 
				@"pid='$pid'," + 
				@"subscriber_sex='$subscriber_sex'," + 
				@"accept_assignment='$accept_assignment'," + 
				@"policy_type='$policy_type'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "insurance_data::Update return: $result");

		return $result;
	}
}
?>
