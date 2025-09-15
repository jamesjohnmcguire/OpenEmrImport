<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_misc_billing_options Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_misc_billing_options
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
		$this->debug->Show(Debug::DEBUG, "form_misc_billing_options::Delete");

		$query = "DELETE FROM form_misc_billing_options ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_misc_billing_options::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_misc_billing_options";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_misc_billing_optionss = $this->database->GetAll($sql);

		return $form_misc_billing_optionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_misc_billing_options WHERE id = '$id'";

		$form_misc_billing_optionsRecord = $this->database->GetRow($sql);

		return $form_misc_billing_optionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $pid, $user, $groupname, $authorized, $activity, $employment_related, $auto_accident, $accident_state, $other_accident, $medicaid_referral_code, $epsdt_flag, $provider_qualifier_code, $provider_id, $outside_lab, $lab_amount, $is_unable_to_work, $onset_date, $date_initial_treatment, $off_work_from, $off_work_to, $is_hospitalized, $hospitalization_date_from, $hospitalization_date_to, $medicaid_resubmission_code, $medicaid_original_reference, $prior_auth_number, $comments, $replacement_claim, $icn_resubmission_number, $box_14_date_qual, $box_15_date_qual)
	{
		$this->debug->Show(Debug::DEBUG, "form_misc_billing_options::Insert");

		$sql = "INSERT INTO form_misc_billing_options (date, pid, user, groupname, authorized, activity, employment_related, auto_accident, accident_state, other_accident, medicaid_referral_code, epsdt_flag, provider_qualifier_code, provider_id, outside_lab, lab_amount, is_unable_to_work, onset_date, date_initial_treatment, off_work_from, off_work_to, is_hospitalized, hospitalization_date_from, hospitalization_date_to, medicaid_resubmission_code, medicaid_original_reference, prior_auth_number, comments, replacement_claim, icn_resubmission_number, box_14_date_qual, box_15_date_qual)".
			" VALUES ('$date', '" + "'$pid', '" + "'$user', '" + "'$groupname', '" + "'$authorized', '" + "'$activity', '" + "'$employment_related', '" + "'$auto_accident', '" + "'$accident_state', '" + "'$other_accident', '" + "'$medicaid_referral_code', '" + "'$epsdt_flag', '" + "'$provider_qualifier_code', '" + "'$provider_id', '" + "'$outside_lab', '" + "'$lab_amount', '" + "'$is_unable_to_work', '" + "'$onset_date', '" + "'$date_initial_treatment', '" + "'$off_work_from', '" + "'$off_work_to', '" + "'$is_hospitalized', '" + "'$hospitalization_date_from', '" + "'$hospitalization_date_to', '" + "'$medicaid_resubmission_code', '" + "'$medicaid_original_reference', '" + "'$prior_auth_number', '" + "'$comments', '" + "'$replacement_claim', '" + "'$icn_resubmission_number', '" + "'$box_14_date_qual', '" + "'$box_15_date_qual')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_misc_billing_options::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $pid, $user, $groupname, $authorized, $activity, $employment_related, $auto_accident, $accident_state, $other_accident, $medicaid_referral_code, $epsdt_flag, $provider_qualifier_code, $provider_id, $outside_lab, $lab_amount, $is_unable_to_work, $onset_date, $date_initial_treatment, $off_work_from, $off_work_to, $is_hospitalized, $hospitalization_date_from, $hospitalization_date_to, $medicaid_resubmission_code, $medicaid_original_reference, $prior_auth_number, $comments, $replacement_claim, $icn_resubmission_number, $box_14_date_qual, $box_15_date_qual)
	{
		$this->debug->Show(Debug::DEBUG, "form_misc_billing_options::Update");

		$sql = "UPDATE form_misc_billing_options SET ".
				@"date='$date'," + 
				@"pid='$pid'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'," + 
				@"activity='$activity'," + 
				@"employment_related='$employment_related'," + 
				@"auto_accident='$auto_accident'," + 
				@"accident_state='$accident_state'," + 
				@"other_accident='$other_accident'," + 
				@"medicaid_referral_code='$medicaid_referral_code'," + 
				@"epsdt_flag='$epsdt_flag'," + 
				@"provider_qualifier_code='$provider_qualifier_code'," + 
				@"provider_id='$provider_id'," + 
				@"outside_lab='$outside_lab'," + 
				@"lab_amount='$lab_amount'," + 
				@"is_unable_to_work='$is_unable_to_work'," + 
				@"onset_date='$onset_date'," + 
				@"date_initial_treatment='$date_initial_treatment'," + 
				@"off_work_from='$off_work_from'," + 
				@"off_work_to='$off_work_to'," + 
				@"is_hospitalized='$is_hospitalized'," + 
				@"hospitalization_date_from='$hospitalization_date_from'," + 
				@"hospitalization_date_to='$hospitalization_date_to'," + 
				@"medicaid_resubmission_code='$medicaid_resubmission_code'," + 
				@"medicaid_original_reference='$medicaid_original_reference'," + 
				@"prior_auth_number='$prior_auth_number'," + 
				@"comments='$comments'," + 
				@"replacement_claim='$replacement_claim'," + 
				@"icn_resubmission_number='$icn_resubmission_number'," + 
				@"box_14_date_qual='$box_14_date_qual'," + 
				@"box_15_date_qual='$box_15_date_qual'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_misc_billing_options::Update return: $result");

		return $result;
	}
}
?>
