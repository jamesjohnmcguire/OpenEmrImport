<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Represents a immunizations Collection
//
// 2018 - James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Libraries/DatabaseLibrary.php";

class immunizations
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
		$this->debug->Show(Debug::DEBUG, "immunizations::Delete");

		$query = "DELETE FROM immunizations ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "immunizations::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where, $values = null, $types = null)
	{
		$sql = "SELECT * FROM immunizations";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$immunizationss = $this->database->GetAll($sql, $values, $types);

		return $immunizationss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM immunizations WHERE id = '$id'";

		$immunizationsRecord = $this->database->GetRow($sql);

		return $immunizationsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($patient_id, $administered_date, $immunization_id,
		$cvx_code, $manufacturer, $lot_number, $administered_by_id,
		$administered_by, $education_date, $vis_date, $note, $create_date,
		$created_by, $updated_by, $amount_administered,
		$amount_administered_unit, $expiration_date, $route,
		$administration_site, $added_erroneously, $external_id,
		$completion_status, $information_source, $refusal_reason,
		$ordering_provider)
	{
		$this->debug->Show(Debug::INFO, "immunizations::Insert");

		$statement = 'INSERT INTO immunizations (patient_id, '.
			'administered_date, immunization_id, cvx_code, manufacturer, '.
			'lot_number, administered_by_id, administered_by, '.
			'education_date, vis_date, note, create_date, '.
			'created_by, updated_by, amount_administered, '.
			'amount_administered_unit, expiration_date, route, '.
			'administration_site, added_erroneously, external_id, '.
			'completion_status, information_source, refusal_reason, '.
			'ordering_provider) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '.
			'?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

		$values = array($patient_id, $administered_date, $immunization_id,
			$cvx_code, $manufacturer, $lot_number, $administered_by_id,
			$administered_by, $education_date, $vis_date, $note, $create_date,
			$created_by, $updated_by, $amount_administered,
			$amount_administered_unit, $expiration_date, $route,
			$administration_site, $added_erroneously, $external_id,
			$completion_status, $information_source, $refusal_reason,
			$ordering_provider);

		$types = array('i', 's', 'i', 's', 's', 's', 'i', 's', 's', 's', 's',
			's', 'i', 'i', 'i', 's', 's', 's', 's', 'i', 's', 's', 's',
			's', 'i');

		$result	= $this->database->Insert($statement, $values, $types);
		$this->debug->Show(Debug::INFO, "immunizations::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $patient_id, $administered_date, $immunization_id, $cvx_code, $manufacturer, $lot_number, $administered_by_id, $administered_by, $education_date, $vis_date, $note, $create_date, $update_date, $created_by, $updated_by, $amount_administered, $amount_administered_unit, $expiration_date, $route, $administration_site, $added_erroneously, $external_id, $completion_status, $information_source, $refusal_reason, $ordering_provider)
	{
		$this->debug->Show(Debug::DEBUG, "immunizations::Update");

		$sql = "UPDATE immunizations SET ".
				@"patient_id='$patient_id'," + 
				@"administered_date='$administered_date'," + 
				@"immunization_id='$immunization_id'," + 
				@"cvx_code='$cvx_code'," + 
				@"manufacturer='$manufacturer'," + 
				@"lot_number='$lot_number'," + 
				@"administered_by_id='$administered_by_id'," + 
				@"administered_by='$administered_by'," + 
				@"education_date='$education_date'," + 
				@"vis_date='$vis_date'," + 
				@"note='$note'," + 
				@"create_date='$create_date'," + 
				@"update_date='$update_date'," + 
				@"created_by='$created_by'," + 
				@"updated_by='$updated_by'," + 
				@"amount_administered='$amount_administered'," + 
				@"amount_administered_unit='$amount_administered_unit'," + 
				@"expiration_date='$expiration_date'," + 
				@"route='$route'," + 
				@"administration_site='$administration_site'," + 
				@"added_erroneously='$added_erroneously'," + 
				@"external_id='$external_id'," + 
				@"completion_status='$completion_status'," + 
				@"information_source='$information_source'," + 
				@"refusal_reason='$refusal_reason'," + 
				@"ordering_provider='$ordering_provider'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "immunizations::Update return: $result");

		return $result;
	}
}
?>
