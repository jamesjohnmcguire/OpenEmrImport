<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a history_data Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class history_data
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
		$this->debug->Show(Debug::DEBUG, "history_data::Delete");

		$query = "DELETE FROM history_data ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "history_data::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM history_data";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$history_datas = $this->database->GetAll($sql);

		return $history_datas;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM history_data WHERE id = '$id'";

		$history_dataRecord = $this->database->GetRow($sql);

		return $history_dataRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($coffee, $tobacco, $alcohol, $sleep_patterns, $exercise_patterns, $seatbelt_use, $counseling, $hazardous_activities, $recreational_drugs, $last_breast_exam, $last_mammogram, $last_gynocological_exam, $last_rectal_exam, $last_prostate_exam, $last_physical_exam, $last_sigmoidoscopy_colonoscopy, $last_ecg, $last_cardiac_echo, $last_retinal, $last_fluvax, $last_pneuvax, $last_ldl, $last_hemoglobin, $last_psa, $last_exam_results, $history_mother, $dc_mother, $history_father, $dc_father, $history_siblings, $dc_siblings, $history_offspring, $dc_offspring, $history_spouse, $dc_spouse, $relatives_cancer, $relatives_tuberculosis, $relatives_diabetes, $relatives_high_blood_pressure, $relatives_heart_problems, $relatives_stroke, $relatives_epilepsy, $relatives_mental_illness, $relatives_suicide, $cataract_surgery, $tonsillectomy, $cholecystestomy, $heart_surgery, $hysterectomy, $hernia_repair, $hip_replacement, $knee_replacement, $appendectomy, $date, $pid, $name_1, $value_1, $name_2, $value_2, $additional_history, $exams, $usertext11, $usertext12, $usertext13, $usertext14, $usertext15, $usertext16, $usertext17, $usertext18, $usertext19, $usertext20, $usertext21, $usertext22, $usertext23, $usertext24, $usertext25, $usertext26, $usertext27, $usertext28, $usertext29, $usertext30, $userdate11, $userdate12, $userdate13, $userdate14, $userdate15, $userarea11, $userarea12)
	{
		$this->debug->Show(Debug::DEBUG, "history_data::Insert");

		$sql = "INSERT INTO history_data (coffee, tobacco, alcohol, sleep_patterns, exercise_patterns, seatbelt_use, counseling, hazardous_activities, recreational_drugs, last_breast_exam, last_mammogram, last_gynocological_exam, last_rectal_exam, last_prostate_exam, last_physical_exam, last_sigmoidoscopy_colonoscopy, last_ecg, last_cardiac_echo, last_retinal, last_fluvax, last_pneuvax, last_ldl, last_hemoglobin, last_psa, last_exam_results, history_mother, dc_mother, history_father, dc_father, history_siblings, dc_siblings, history_offspring, dc_offspring, history_spouse, dc_spouse, relatives_cancer, relatives_tuberculosis, relatives_diabetes, relatives_high_blood_pressure, relatives_heart_problems, relatives_stroke, relatives_epilepsy, relatives_mental_illness, relatives_suicide, cataract_surgery, tonsillectomy, cholecystestomy, heart_surgery, hysterectomy, hernia_repair, hip_replacement, knee_replacement, appendectomy, date, pid, name_1, value_1, name_2, value_2, additional_history, exams, usertext11, usertext12, usertext13, usertext14, usertext15, usertext16, usertext17, usertext18, usertext19, usertext20, usertext21, usertext22, usertext23, usertext24, usertext25, usertext26, usertext27, usertext28, usertext29, usertext30, userdate11, userdate12, userdate13, userdate14, userdate15, userarea11, userarea12)".
			" VALUES ('$coffee', '" + "'$tobacco', '" + "'$alcohol', '" + "'$sleep_patterns', '" + "'$exercise_patterns', '" + "'$seatbelt_use', '" + "'$counseling', '" + "'$hazardous_activities', '" + "'$recreational_drugs', '" + "'$last_breast_exam', '" + "'$last_mammogram', '" + "'$last_gynocological_exam', '" + "'$last_rectal_exam', '" + "'$last_prostate_exam', '" + "'$last_physical_exam', '" + "'$last_sigmoidoscopy_colonoscopy', '" + "'$last_ecg', '" + "'$last_cardiac_echo', '" + "'$last_retinal', '" + "'$last_fluvax', '" + "'$last_pneuvax', '" + "'$last_ldl', '" + "'$last_hemoglobin', '" + "'$last_psa', '" + "'$last_exam_results', '" + "'$history_mother', '" + "'$dc_mother', '" + "'$history_father', '" + "'$dc_father', '" + "'$history_siblings', '" + "'$dc_siblings', '" + "'$history_offspring', '" + "'$dc_offspring', '" + "'$history_spouse', '" + "'$dc_spouse', '" + "'$relatives_cancer', '" + "'$relatives_tuberculosis', '" + "'$relatives_diabetes', '" + "'$relatives_high_blood_pressure', '" + "'$relatives_heart_problems', '" + "'$relatives_stroke', '" + "'$relatives_epilepsy', '" + "'$relatives_mental_illness', '" + "'$relatives_suicide', '" + "'$cataract_surgery', '" + "'$tonsillectomy', '" + "'$cholecystestomy', '" + "'$heart_surgery', '" + "'$hysterectomy', '" + "'$hernia_repair', '" + "'$hip_replacement', '" + "'$knee_replacement', '" + "'$appendectomy', '" + "'$date', '" + "'$pid', '" + "'$name_1', '" + "'$value_1', '" + "'$name_2', '" + "'$value_2', '" + "'$additional_history', '" + "'$exams', '" + "'$usertext11', '" + "'$usertext12', '" + "'$usertext13', '" + "'$usertext14', '" + "'$usertext15', '" + "'$usertext16', '" + "'$usertext17', '" + "'$usertext18', '" + "'$usertext19', '" + "'$usertext20', '" + "'$usertext21', '" + "'$usertext22', '" + "'$usertext23', '" + "'$usertext24', '" + "'$usertext25', '" + "'$usertext26', '" + "'$usertext27', '" + "'$usertext28', '" + "'$usertext29', '" + "'$usertext30', '" + "'$userdate11', '" + "'$userdate12', '" + "'$userdate13', '" + "'$userdate14', '" + "'$userdate15', '" + "'$userarea11', '" + "'$userarea12')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "history_data::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $coffee, $tobacco, $alcohol, $sleep_patterns, $exercise_patterns, $seatbelt_use, $counseling, $hazardous_activities, $recreational_drugs, $last_breast_exam, $last_mammogram, $last_gynocological_exam, $last_rectal_exam, $last_prostate_exam, $last_physical_exam, $last_sigmoidoscopy_colonoscopy, $last_ecg, $last_cardiac_echo, $last_retinal, $last_fluvax, $last_pneuvax, $last_ldl, $last_hemoglobin, $last_psa, $last_exam_results, $history_mother, $dc_mother, $history_father, $dc_father, $history_siblings, $dc_siblings, $history_offspring, $dc_offspring, $history_spouse, $dc_spouse, $relatives_cancer, $relatives_tuberculosis, $relatives_diabetes, $relatives_high_blood_pressure, $relatives_heart_problems, $relatives_stroke, $relatives_epilepsy, $relatives_mental_illness, $relatives_suicide, $cataract_surgery, $tonsillectomy, $cholecystestomy, $heart_surgery, $hysterectomy, $hernia_repair, $hip_replacement, $knee_replacement, $appendectomy, $date, $pid, $name_1, $value_1, $name_2, $value_2, $additional_history, $exams, $usertext11, $usertext12, $usertext13, $usertext14, $usertext15, $usertext16, $usertext17, $usertext18, $usertext19, $usertext20, $usertext21, $usertext22, $usertext23, $usertext24, $usertext25, $usertext26, $usertext27, $usertext28, $usertext29, $usertext30, $userdate11, $userdate12, $userdate13, $userdate14, $userdate15, $userarea11, $userarea12)
	{
		$this->debug->Show(Debug::DEBUG, "history_data::Update");

		$sql = "UPDATE history_data SET ".
				@"coffee='$coffee'," + 
				@"tobacco='$tobacco'," + 
				@"alcohol='$alcohol'," + 
				@"sleep_patterns='$sleep_patterns'," + 
				@"exercise_patterns='$exercise_patterns'," + 
				@"seatbelt_use='$seatbelt_use'," + 
				@"counseling='$counseling'," + 
				@"hazardous_activities='$hazardous_activities'," + 
				@"recreational_drugs='$recreational_drugs'," + 
				@"last_breast_exam='$last_breast_exam'," + 
				@"last_mammogram='$last_mammogram'," + 
				@"last_gynocological_exam='$last_gynocological_exam'," + 
				@"last_rectal_exam='$last_rectal_exam'," + 
				@"last_prostate_exam='$last_prostate_exam'," + 
				@"last_physical_exam='$last_physical_exam'," + 
				@"last_sigmoidoscopy_colonoscopy='$last_sigmoidoscopy_colonoscopy'," + 
				@"last_ecg='$last_ecg'," + 
				@"last_cardiac_echo='$last_cardiac_echo'," + 
				@"last_retinal='$last_retinal'," + 
				@"last_fluvax='$last_fluvax'," + 
				@"last_pneuvax='$last_pneuvax'," + 
				@"last_ldl='$last_ldl'," + 
				@"last_hemoglobin='$last_hemoglobin'," + 
				@"last_psa='$last_psa'," + 
				@"last_exam_results='$last_exam_results'," + 
				@"history_mother='$history_mother'," + 
				@"dc_mother='$dc_mother'," + 
				@"history_father='$history_father'," + 
				@"dc_father='$dc_father'," + 
				@"history_siblings='$history_siblings'," + 
				@"dc_siblings='$dc_siblings'," + 
				@"history_offspring='$history_offspring'," + 
				@"dc_offspring='$dc_offspring'," + 
				@"history_spouse='$history_spouse'," + 
				@"dc_spouse='$dc_spouse'," + 
				@"relatives_cancer='$relatives_cancer'," + 
				@"relatives_tuberculosis='$relatives_tuberculosis'," + 
				@"relatives_diabetes='$relatives_diabetes'," + 
				@"relatives_high_blood_pressure='$relatives_high_blood_pressure'," + 
				@"relatives_heart_problems='$relatives_heart_problems'," + 
				@"relatives_stroke='$relatives_stroke'," + 
				@"relatives_epilepsy='$relatives_epilepsy'," + 
				@"relatives_mental_illness='$relatives_mental_illness'," + 
				@"relatives_suicide='$relatives_suicide'," + 
				@"cataract_surgery='$cataract_surgery'," + 
				@"tonsillectomy='$tonsillectomy'," + 
				@"cholecystestomy='$cholecystestomy'," + 
				@"heart_surgery='$heart_surgery'," + 
				@"hysterectomy='$hysterectomy'," + 
				@"hernia_repair='$hernia_repair'," + 
				@"hip_replacement='$hip_replacement'," + 
				@"knee_replacement='$knee_replacement'," + 
				@"appendectomy='$appendectomy'," + 
				@"date='$date'," + 
				@"pid='$pid'," + 
				@"name_1='$name_1'," + 
				@"value_1='$value_1'," + 
				@"name_2='$name_2'," + 
				@"value_2='$value_2'," + 
				@"additional_history='$additional_history'," + 
				@"exams='$exams'," + 
				@"usertext11='$usertext11'," + 
				@"usertext12='$usertext12'," + 
				@"usertext13='$usertext13'," + 
				@"usertext14='$usertext14'," + 
				@"usertext15='$usertext15'," + 
				@"usertext16='$usertext16'," + 
				@"usertext17='$usertext17'," + 
				@"usertext18='$usertext18'," + 
				@"usertext19='$usertext19'," + 
				@"usertext20='$usertext20'," + 
				@"usertext21='$usertext21'," + 
				@"usertext22='$usertext22'," + 
				@"usertext23='$usertext23'," + 
				@"usertext24='$usertext24'," + 
				@"usertext25='$usertext25'," + 
				@"usertext26='$usertext26'," + 
				@"usertext27='$usertext27'," + 
				@"usertext28='$usertext28'," + 
				@"usertext29='$usertext29'," + 
				@"usertext30='$usertext30'," + 
				@"userdate11='$userdate11'," + 
				@"userdate12='$userdate12'," + 
				@"userdate13='$userdate13'," + 
				@"userdate14='$userdate14'," + 
				@"userdate15='$userdate15'," + 
				@"userarea11='$userarea11'," + 
				@"userarea12='$userarea12'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "history_data::Update return: $result");

		return $result;
	}
}
?>
