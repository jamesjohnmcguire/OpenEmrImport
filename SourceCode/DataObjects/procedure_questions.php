<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a procedure_questions Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class procedure_questions
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
	function Delete($lab_id)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_questions::Delete");

		$query = "DELETE FROM procedure_questions ".
			"WHERE lab_id = '$lab_id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "procedure_questions::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM procedure_questions";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$procedure_questionss = $this->database->GetAll($sql);

		return $procedure_questionss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($lab_id)
	{
		$sql = "SELECT * FROM procedure_questions WHERE lab_id = '$lab_id'";

		$procedure_questionsRecord = $this->database->GetRow($sql);

		return $procedure_questionsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($procedure_code, $question_code, $seq, $question_text, $required, $maxsize, $fldtype, $options, $tips, $activity)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_questions::Insert");

		$sql = "INSERT INTO procedure_questions (procedure_code, question_code, seq, question_text, required, maxsize, fldtype, options, tips, activity)".
			" VALUES ('$procedure_code', '" + "'$question_code', '" + "'$seq', '" + "'$question_text', '" + "'$required', '" + "'$maxsize', '" + "'$fldtype', '" + "'$options', '" + "'$tips', '" + "'$activity')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_questions::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($lab_id, $procedure_code, $question_code, $seq, $question_text, $required, $maxsize, $fldtype, $options, $tips, $activity)
	{
		$this->debug->Show(Debug::DEBUG, "procedure_questions::Update");

		$sql = "UPDATE procedure_questions SET ".
				@"procedure_code='$procedure_code'," + 
				@"question_code='$question_code'," + 
				@"seq='$seq'," + 
				@"question_text='$question_text'," + 
				@"required='$required'," + 
				@"maxsize='$maxsize'," + 
				@"fldtype='$fldtype'," + 
				@"options='$options'," + 
				@"tips='$tips'," + 
				@"activity='$activity'" + 
				
				"WHERE lab_id = '$lab_id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "procedure_questions::Update return: $result");

		return $result;
	}
}
?>
