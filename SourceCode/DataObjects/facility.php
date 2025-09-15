<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a facility Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class facility
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
		$this->debug->Show(Debug::DEBUG, "facility::Delete");

		$query = "DELETE FROM facility ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "facility::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM facility";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$facilitys = $this->database->GetAll($sql);

		return $facilitys;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM facility WHERE id = '$id'";

		$facilityRecord = $this->database->GetRow($sql);

		return $facilityRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($name, $phone, $fax, $street, $city, $state, $postal_code, $country_code, $federal_ein, $website, $email, $service_location, $billing_location, $accepts_assignment, $pos_code, $x12_sender_id, $attn, $domain_identifier, $facility_npi, $facility_taxonomy, $tax_id_type, $color, $primary_business_entity, $facility_code, $extra_validation)
	{
		$this->debug->Show(Debug::DEBUG, "facility::Insert");

		$sql = "INSERT INTO facility (name, phone, fax, street, city, state, postal_code, country_code, federal_ein, website, email, service_location, billing_location, accepts_assignment, pos_code, x12_sender_id, attn, domain_identifier, facility_npi, facility_taxonomy, tax_id_type, color, primary_business_entity, facility_code, extra_validation)".
			" VALUES ('$name', '" + "'$phone', '" + "'$fax', '" + "'$street', '" + "'$city', '" + "'$state', '" + "'$postal_code', '" + "'$country_code', '" + "'$federal_ein', '" + "'$website', '" + "'$email', '" + "'$service_location', '" + "'$billing_location', '" + "'$accepts_assignment', '" + "'$pos_code', '" + "'$x12_sender_id', '" + "'$attn', '" + "'$domain_identifier', '" + "'$facility_npi', '" + "'$facility_taxonomy', '" + "'$tax_id_type', '" + "'$color', '" + "'$primary_business_entity', '" + "'$facility_code', '" + "'$extra_validation')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "facility::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $name, $phone, $fax, $street, $city, $state, $postal_code, $country_code, $federal_ein, $website, $email, $service_location, $billing_location, $accepts_assignment, $pos_code, $x12_sender_id, $attn, $domain_identifier, $facility_npi, $facility_taxonomy, $tax_id_type, $color, $primary_business_entity, $facility_code, $extra_validation)
	{
		$this->debug->Show(Debug::DEBUG, "facility::Update");

		$sql = "UPDATE facility SET ".
				@"name='$name'," + 
				@"phone='$phone'," + 
				@"fax='$fax'," + 
				@"street='$street'," + 
				@"city='$city'," + 
				@"state='$state'," + 
				@"postal_code='$postal_code'," + 
				@"country_code='$country_code'," + 
				@"federal_ein='$federal_ein'," + 
				@"website='$website'," + 
				@"email='$email'," + 
				@"service_location='$service_location'," + 
				@"billing_location='$billing_location'," + 
				@"accepts_assignment='$accepts_assignment'," + 
				@"pos_code='$pos_code'," + 
				@"x12_sender_id='$x12_sender_id'," + 
				@"attn='$attn'," + 
				@"domain_identifier='$domain_identifier'," + 
				@"facility_npi='$facility_npi'," + 
				@"facility_taxonomy='$facility_taxonomy'," + 
				@"tax_id_type='$tax_id_type'," + 
				@"color='$color'," + 
				@"primary_business_entity='$primary_business_entity'," + 
				@"facility_code='$facility_code'," + 
				@"extra_validation='$extra_validation'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "facility::Update return: $result");

		return $result;
	}
}
?>
