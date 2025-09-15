<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a users Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class users
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
		$this->debug->Show(Debug::DEBUG, "users::Delete");

		$query = "DELETE FROM users ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "users::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = null, $types = null)
	{
		$this->debug->Show(Debug::INFO, "users::GetList begin");
		$sql = "SELECT * FROM users";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$users = $this->database->GetAll($sql, $values, $types);

		$this->debug->Show(Debug::INFO, "users::GetList end");
		return $users;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM users WHERE id = '$id'";

		$usersRecord = $this->database->GetRow($sql);

		return $usersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($username, $password, $authorized, $info, $source,
		$fname, $mname, $lname, $suffix, $federaltaxid, $federaldrugid, $upin,
		$facility, $facility_id, $see_auth, $active, $npi, $title, $specialty,
		$billname, $email, $email_direct, $url, $assistant, $organization,
		$valedictory, $street, $streetb, $city, $state, $zip, $street2,
		$streetb2, $city2, $state2, $zip2, $phone, $fax, $phonew1, $phonew2,
		$phonecell, $notes, $cal_ui, $taxonomy, $calendar, $abook_type,
		$pwd_expiration_date, $pwd_history1, $pwd_history2,
		$default_warehouse, $irnpool, $state_license_number, $weno_prov_id,
		$newcrop_user_role, $cpoe, $physician_type, $main_menu_role,
		$patient_menu_role, $provider_guid, $user_guid)
	{
		$this->debug->Show(Debug::INFO, "users::Insert");

		$sql = 'INSERT INTO users (username, password, authorized, info, '.
			'source, fname, mname, lname, suffix, federaltaxid, '.
			'federaldrugid, upin, facility, facility_id, see_auth, active, '.
			'npi, title, specialty, billname, email, email_direct, url, '.
			'assistant, organization, valedictory, street, streetb, city, '.
			'state, zip, street2, streetb2, city2, state2, zip2, phone, fax,'.
			' phonew1, phonew2, phonecell, notes, cal_ui, taxonomy, '.
			'calendar, abook_type, pwd_expiration_date, pwd_history1, '.
			'pwd_history2, default_warehouse, irnpool, '.
			'state_license_number, weno_prov_id, newcrop_user_role, cpoe, '.
			'physician_type, main_menu_role, patient_menu_role) VALUES '.
			'(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '.
			'?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '.
			'?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

		$values = array($username, $password, $authorized, $info, $source,
			$fname, $mname, $lname, $suffix, $federaltaxid, $federaldrugid,
			$upin, $facility, $facility_id, $see_auth, $active, $npi, $title,
			$specialty, $billname, $email, $email_direct, $url, $assistant,
			$organization, $valedictory, $street, $streetb, $city, $state,
			$zip, $street2, $streetb2, $city2, $state2, $zip2, $phone, $fax,
			$phonew1, $phonew2, $phonecell, $notes, $cal_ui, $taxonomy,
			$calendar, $abook_type, $pwd_expiration_date, $pwd_history1,
			$pwd_history2, $default_warehouse, $irnpool, 
			$state_license_number, $weno_prov_id, $newcrop_user_role, $cpoe,
			$physician_type, $main_menu_role, $patient_menu_role);

		$types = array('s', 's', 'i', 's', 'i', 's', 's', 's', 's', 's', 's',
			's', 's', 'i', 'i', 'i', 's', 's', 's', 's', 's', 's', 's', 's',
			's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's',
			's', 's', 's', 's', 's', 'i', 's', 'i', 's', 's', 's', 's', 's',
			's', 's', 's', 's', 'i', 's', 's', 's');

		$result	= $this->database->Insert($sql, $values, $types);
		$this->debug->Show(Debug::DEBUG, "users::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $fields, $values, $types)
	{
		$this->debug->Show(Debug::DEBUG, "users::Update");

		$columns = '';
		$begin = true;
		foreach($fields as $field)
		{
			if (false == $begin)
			{
				$columns .= ', ';
				$begin = false;
			}

			$columns .= "`$field` = ?";
		}

		$sql = "UPDATE users SET $columns WHERE id = $id";
		$this->debug->Show(Debug::DEBUG, "users::Update updating with: $sql");

		$result = $this->database->Update($sql, $values, $types);
		$this->debug->Show(Debug::DEBUG, "users::Update return: $result");

		return $result;
	}
}
?>
