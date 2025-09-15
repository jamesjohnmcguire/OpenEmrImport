<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a procedure_answers Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class procedure_answers
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
	function Delete($procedure_order_id)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_answers::Delete");

		$query = "DELETE FROM procedure_answers ".
			"WHERE procedure_order_id = '$procedure_order_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "procedure_answers::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM procedure_answers";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$procedure_answerss = $this->database->GetAll($sql);

		return $procedure_answerss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($procedure_order_id)
	{
		$sql = "SELECT * FROM procedure_answers WHERE procedure_order_id = '$procedure_order_id'";

		$procedure_answersRecord = $this->database->GetRow($sql);

		return $procedure_answersRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($procedure_order_seq, $question_code, $answer_seq, $answer)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_answers::Insert");

		$sql = "INSERT INTO procedure_answers (procedure_order_seq, question_code, answer_seq, answer)".
			" VALUES ('$procedure_order_seq', '" + "'$question_code', '" + "'$answer_seq', '" + "'$answer')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_answers::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($procedure_order_id, $procedure_order_seq, $question_code, $answer_seq, $answer)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_answers::Update");

		$sql = "UPDATE procedure_answers SET ".
				@"procedure_order_seq='$procedure_order_seq'," + 
				@"question_code='$question_code'," + 
				@"answer_seq='$answer_seq'," + 
				@"answer='$answer'" + 
				
				"WHERE procedure_order_id = '$procedure_order_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_answers::Update return: $result");

		return $result;
	}
}
?>
