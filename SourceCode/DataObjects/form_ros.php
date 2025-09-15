<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_ros Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_ros
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
		$this->debug->Show(Debug::DEBUG, "form_ros::Delete");

		$query = "DELETE FROM form_ros ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_ros::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_ros";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_ross = $this->database->GetAll($sql);

		return $form_ross;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_ros WHERE id = '$id'";

		$form_rosRecord = $this->database->GetRow($sql);

		return $form_rosRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($pid, $activity, $date, $weight_change, $weakness, $fatigue, $anorexia, $fever, $chills, $night_sweats, $insomnia, $irritability, $heat_or_cold, $intolerance, $change_in_vision, $glaucoma_history, $eye_pain, $irritation, $redness, $excessive_tearing, $double_vision, $blind_spots, $photophobia, $hearing_loss, $discharge, $pain, $vertigo, $tinnitus, $frequent_colds, $sore_throat, $sinus_problems, $post_nasal_drip, $nosebleed, $snoring, $apnea, $breast_mass, $breast_discharge, $biopsy, $abnormal_mammogram, $cough, $sputum, $shortness_of_breath, $wheezing, $hemoptsyis, $asthma, $copd, $chest_pain, $palpitation, $syncope, $pnd, $doe, $orthopnea, $peripheal, $edema, $legpain_cramping, $history_murmur, $arrythmia, $heart_problem, $dysphagia, $heartburn, $bloating, $belching, $flatulence, $nausea, $vomiting, $hematemesis, $gastro_pain, $food_intolerance, $hepatitis, $jaundice, $hematochezia, $changed_bowel, $diarrhea, $constipation, $polyuria, $polydypsia, $dysuria, $hematuria, $frequency, $urgency, $incontinence, $renal_stones, $utis, $hesitancy, $dribbling, $stream, $nocturia, $erections, $ejaculations, $g, $p, $ap, $lc, $mearche, $menopause, $lmp, $f_frequency, $f_flow, $f_symptoms, $abnormal_hair_growth, $f_hirsutism, $joint_pain, $swelling, $m_redness, $m_warm, $m_stiffness, $muscle, $m_aches, $fms, $arthritis, $loc, $seizures, $stroke, $tia, $n_numbness, $n_weakness, $paralysis, $intellectual_decline, $memory_problems, $dementia, $n_headache, $s_cancer, $psoriasis, $s_acne, $s_other, $s_disease, $p_diagnosis, $p_medication, $depression, $anxiety, $social_difficulties, $thyroid_problems, $diabetes, $abnormal_blood, $anemia, $fh_blood_problems, $bleeding_problems, $allergies, $frequent_illness, $hiv, $hai_status)
	{
		$this->debug->Show(Debug::DEBUG, "form_ros::Insert");

		$sql = "INSERT INTO form_ros (pid, activity, date, weight_change, weakness, fatigue, anorexia, fever, chills, night_sweats, insomnia, irritability, heat_or_cold, intolerance, change_in_vision, glaucoma_history, eye_pain, irritation, redness, excessive_tearing, double_vision, blind_spots, photophobia, hearing_loss, discharge, pain, vertigo, tinnitus, frequent_colds, sore_throat, sinus_problems, post_nasal_drip, nosebleed, snoring, apnea, breast_mass, breast_discharge, biopsy, abnormal_mammogram, cough, sputum, shortness_of_breath, wheezing, hemoptsyis, asthma, copd, chest_pain, palpitation, syncope, pnd, doe, orthopnea, peripheal, edema, legpain_cramping, history_murmur, arrythmia, heart_problem, dysphagia, heartburn, bloating, belching, flatulence, nausea, vomiting, hematemesis, gastro_pain, food_intolerance, hepatitis, jaundice, hematochezia, changed_bowel, diarrhea, constipation, polyuria, polydypsia, dysuria, hematuria, frequency, urgency, incontinence, renal_stones, utis, hesitancy, dribbling, stream, nocturia, erections, ejaculations, g, p, ap, lc, mearche, menopause, lmp, f_frequency, f_flow, f_symptoms, abnormal_hair_growth, f_hirsutism, joint_pain, swelling, m_redness, m_warm, m_stiffness, muscle, m_aches, fms, arthritis, loc, seizures, stroke, tia, n_numbness, n_weakness, paralysis, intellectual_decline, memory_problems, dementia, n_headache, s_cancer, psoriasis, s_acne, s_other, s_disease, p_diagnosis, p_medication, depression, anxiety, social_difficulties, thyroid_problems, diabetes, abnormal_blood, anemia, fh_blood_problems, bleeding_problems, allergies, frequent_illness, hiv, hai_status)".
			" VALUES ('$pid', '" + "'$activity', '" + "'$date', '" + "'$weight_change', '" + "'$weakness', '" + "'$fatigue', '" + "'$anorexia', '" + "'$fever', '" + "'$chills', '" + "'$night_sweats', '" + "'$insomnia', '" + "'$irritability', '" + "'$heat_or_cold', '" + "'$intolerance', '" + "'$change_in_vision', '" + "'$glaucoma_history', '" + "'$eye_pain', '" + "'$irritation', '" + "'$redness', '" + "'$excessive_tearing', '" + "'$double_vision', '" + "'$blind_spots', '" + "'$photophobia', '" + "'$hearing_loss', '" + "'$discharge', '" + "'$pain', '" + "'$vertigo', '" + "'$tinnitus', '" + "'$frequent_colds', '" + "'$sore_throat', '" + "'$sinus_problems', '" + "'$post_nasal_drip', '" + "'$nosebleed', '" + "'$snoring', '" + "'$apnea', '" + "'$breast_mass', '" + "'$breast_discharge', '" + "'$biopsy', '" + "'$abnormal_mammogram', '" + "'$cough', '" + "'$sputum', '" + "'$shortness_of_breath', '" + "'$wheezing', '" + "'$hemoptsyis', '" + "'$asthma', '" + "'$copd', '" + "'$chest_pain', '" + "'$palpitation', '" + "'$syncope', '" + "'$pnd', '" + "'$doe', '" + "'$orthopnea', '" + "'$peripheal', '" + "'$edema', '" + "'$legpain_cramping', '" + "'$history_murmur', '" + "'$arrythmia', '" + "'$heart_problem', '" + "'$dysphagia', '" + "'$heartburn', '" + "'$bloating', '" + "'$belching', '" + "'$flatulence', '" + "'$nausea', '" + "'$vomiting', '" + "'$hematemesis', '" + "'$gastro_pain', '" + "'$food_intolerance', '" + "'$hepatitis', '" + "'$jaundice', '" + "'$hematochezia', '" + "'$changed_bowel', '" + "'$diarrhea', '" + "'$constipation', '" + "'$polyuria', '" + "'$polydypsia', '" + "'$dysuria', '" + "'$hematuria', '" + "'$frequency', '" + "'$urgency', '" + "'$incontinence', '" + "'$renal_stones', '" + "'$utis', '" + "'$hesitancy', '" + "'$dribbling', '" + "'$stream', '" + "'$nocturia', '" + "'$erections', '" + "'$ejaculations', '" + "'$g', '" + "'$p', '" + "'$ap', '" + "'$lc', '" + "'$mearche', '" + "'$menopause', '" + "'$lmp', '" + "'$f_frequency', '" + "'$f_flow', '" + "'$f_symptoms', '" + "'$abnormal_hair_growth', '" + "'$f_hirsutism', '" + "'$joint_pain', '" + "'$swelling', '" + "'$m_redness', '" + "'$m_warm', '" + "'$m_stiffness', '" + "'$muscle', '" + "'$m_aches', '" + "'$fms', '" + "'$arthritis', '" + "'$loc', '" + "'$seizures', '" + "'$stroke', '" + "'$tia', '" + "'$n_numbness', '" + "'$n_weakness', '" + "'$paralysis', '" + "'$intellectual_decline', '" + "'$memory_problems', '" + "'$dementia', '" + "'$n_headache', '" + "'$s_cancer', '" + "'$psoriasis', '" + "'$s_acne', '" + "'$s_other', '" + "'$s_disease', '" + "'$p_diagnosis', '" + "'$p_medication', '" + "'$depression', '" + "'$anxiety', '" + "'$social_difficulties', '" + "'$thyroid_problems', '" + "'$diabetes', '" + "'$abnormal_blood', '" + "'$anemia', '" + "'$fh_blood_problems', '" + "'$bleeding_problems', '" + "'$allergies', '" + "'$frequent_illness', '" + "'$hiv', '" + "'$hai_status')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_ros::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $pid, $activity, $date, $weight_change, $weakness, $fatigue, $anorexia, $fever, $chills, $night_sweats, $insomnia, $irritability, $heat_or_cold, $intolerance, $change_in_vision, $glaucoma_history, $eye_pain, $irritation, $redness, $excessive_tearing, $double_vision, $blind_spots, $photophobia, $hearing_loss, $discharge, $pain, $vertigo, $tinnitus, $frequent_colds, $sore_throat, $sinus_problems, $post_nasal_drip, $nosebleed, $snoring, $apnea, $breast_mass, $breast_discharge, $biopsy, $abnormal_mammogram, $cough, $sputum, $shortness_of_breath, $wheezing, $hemoptsyis, $asthma, $copd, $chest_pain, $palpitation, $syncope, $pnd, $doe, $orthopnea, $peripheal, $edema, $legpain_cramping, $history_murmur, $arrythmia, $heart_problem, $dysphagia, $heartburn, $bloating, $belching, $flatulence, $nausea, $vomiting, $hematemesis, $gastro_pain, $food_intolerance, $hepatitis, $jaundice, $hematochezia, $changed_bowel, $diarrhea, $constipation, $polyuria, $polydypsia, $dysuria, $hematuria, $frequency, $urgency, $incontinence, $renal_stones, $utis, $hesitancy, $dribbling, $stream, $nocturia, $erections, $ejaculations, $g, $p, $ap, $lc, $mearche, $menopause, $lmp, $f_frequency, $f_flow, $f_symptoms, $abnormal_hair_growth, $f_hirsutism, $joint_pain, $swelling, $m_redness, $m_warm, $m_stiffness, $muscle, $m_aches, $fms, $arthritis, $loc, $seizures, $stroke, $tia, $n_numbness, $n_weakness, $paralysis, $intellectual_decline, $memory_problems, $dementia, $n_headache, $s_cancer, $psoriasis, $s_acne, $s_other, $s_disease, $p_diagnosis, $p_medication, $depression, $anxiety, $social_difficulties, $thyroid_problems, $diabetes, $abnormal_blood, $anemia, $fh_blood_problems, $bleeding_problems, $allergies, $frequent_illness, $hiv, $hai_status)
	{
		$this->debug->Show(Debug::DEBUG, "form_ros::Update");

		$sql = "UPDATE form_ros SET ".
				@"pid='$pid'," + 
				@"activity='$activity'," + 
				@"date='$date'," + 
				@"weight_change='$weight_change'," + 
				@"weakness='$weakness'," + 
				@"fatigue='$fatigue'," + 
				@"anorexia='$anorexia'," + 
				@"fever='$fever'," + 
				@"chills='$chills'," + 
				@"night_sweats='$night_sweats'," + 
				@"insomnia='$insomnia'," + 
				@"irritability='$irritability'," + 
				@"heat_or_cold='$heat_or_cold'," + 
				@"intolerance='$intolerance'," + 
				@"change_in_vision='$change_in_vision'," + 
				@"glaucoma_history='$glaucoma_history'," + 
				@"eye_pain='$eye_pain'," + 
				@"irritation='$irritation'," + 
				@"redness='$redness'," + 
				@"excessive_tearing='$excessive_tearing'," + 
				@"double_vision='$double_vision'," + 
				@"blind_spots='$blind_spots'," + 
				@"photophobia='$photophobia'," + 
				@"hearing_loss='$hearing_loss'," + 
				@"discharge='$discharge'," + 
				@"pain='$pain'," + 
				@"vertigo='$vertigo'," + 
				@"tinnitus='$tinnitus'," + 
				@"frequent_colds='$frequent_colds'," + 
				@"sore_throat='$sore_throat'," + 
				@"sinus_problems='$sinus_problems'," + 
				@"post_nasal_drip='$post_nasal_drip'," + 
				@"nosebleed='$nosebleed'," + 
				@"snoring='$snoring'," + 
				@"apnea='$apnea'," + 
				@"breast_mass='$breast_mass'," + 
				@"breast_discharge='$breast_discharge'," + 
				@"biopsy='$biopsy'," + 
				@"abnormal_mammogram='$abnormal_mammogram'," + 
				@"cough='$cough'," + 
				@"sputum='$sputum'," + 
				@"shortness_of_breath='$shortness_of_breath'," + 
				@"wheezing='$wheezing'," + 
				@"hemoptsyis='$hemoptsyis'," + 
				@"asthma='$asthma'," + 
				@"copd='$copd'," + 
				@"chest_pain='$chest_pain'," + 
				@"palpitation='$palpitation'," + 
				@"syncope='$syncope'," + 
				@"pnd='$pnd'," + 
				@"doe='$doe'," + 
				@"orthopnea='$orthopnea'," + 
				@"peripheal='$peripheal'," + 
				@"edema='$edema'," + 
				@"legpain_cramping='$legpain_cramping'," + 
				@"history_murmur='$history_murmur'," + 
				@"arrythmia='$arrythmia'," + 
				@"heart_problem='$heart_problem'," + 
				@"dysphagia='$dysphagia'," + 
				@"heartburn='$heartburn'," + 
				@"bloating='$bloating'," + 
				@"belching='$belching'," + 
				@"flatulence='$flatulence'," + 
				@"nausea='$nausea'," + 
				@"vomiting='$vomiting'," + 
				@"hematemesis='$hematemesis'," + 
				@"gastro_pain='$gastro_pain'," + 
				@"food_intolerance='$food_intolerance'," + 
				@"hepatitis='$hepatitis'," + 
				@"jaundice='$jaundice'," + 
				@"hematochezia='$hematochezia'," + 
				@"changed_bowel='$changed_bowel'," + 
				@"diarrhea='$diarrhea'," + 
				@"constipation='$constipation'," + 
				@"polyuria='$polyuria'," + 
				@"polydypsia='$polydypsia'," + 
				@"dysuria='$dysuria'," + 
				@"hematuria='$hematuria'," + 
				@"frequency='$frequency'," + 
				@"urgency='$urgency'," + 
				@"incontinence='$incontinence'," + 
				@"renal_stones='$renal_stones'," + 
				@"utis='$utis'," + 
				@"hesitancy='$hesitancy'," + 
				@"dribbling='$dribbling'," + 
				@"stream='$stream'," + 
				@"nocturia='$nocturia'," + 
				@"erections='$erections'," + 
				@"ejaculations='$ejaculations'," + 
				@"g='$g'," + 
				@"p='$p'," + 
				@"ap='$ap'," + 
				@"lc='$lc'," + 
				@"mearche='$mearche'," + 
				@"menopause='$menopause'," + 
				@"lmp='$lmp'," + 
				@"f_frequency='$f_frequency'," + 
				@"f_flow='$f_flow'," + 
				@"f_symptoms='$f_symptoms'," + 
				@"abnormal_hair_growth='$abnormal_hair_growth'," + 
				@"f_hirsutism='$f_hirsutism'," + 
				@"joint_pain='$joint_pain'," + 
				@"swelling='$swelling'," + 
				@"m_redness='$m_redness'," + 
				@"m_warm='$m_warm'," + 
				@"m_stiffness='$m_stiffness'," + 
				@"muscle='$muscle'," + 
				@"m_aches='$m_aches'," + 
				@"fms='$fms'," + 
				@"arthritis='$arthritis'," + 
				@"loc='$loc'," + 
				@"seizures='$seizures'," + 
				@"stroke='$stroke'," + 
				@"tia='$tia'," + 
				@"n_numbness='$n_numbness'," + 
				@"n_weakness='$n_weakness'," + 
				@"paralysis='$paralysis'," + 
				@"intellectual_decline='$intellectual_decline'," + 
				@"memory_problems='$memory_problems'," + 
				@"dementia='$dementia'," + 
				@"n_headache='$n_headache'," + 
				@"s_cancer='$s_cancer'," + 
				@"psoriasis='$psoriasis'," + 
				@"s_acne='$s_acne'," + 
				@"s_other='$s_other'," + 
				@"s_disease='$s_disease'," + 
				@"p_diagnosis='$p_diagnosis'," + 
				@"p_medication='$p_medication'," + 
				@"depression='$depression'," + 
				@"anxiety='$anxiety'," + 
				@"social_difficulties='$social_difficulties'," + 
				@"thyroid_problems='$thyroid_problems'," + 
				@"diabetes='$diabetes'," + 
				@"abnormal_blood='$abnormal_blood'," + 
				@"anemia='$anemia'," + 
				@"fh_blood_problems='$fh_blood_problems'," + 
				@"bleeding_problems='$bleeding_problems'," + 
				@"allergies='$allergies'," + 
				@"frequent_illness='$frequent_illness'," + 
				@"hiv='$hiv'," + 
				@"hai_status='$hai_status'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_ros::Update return: $result");

		return $result;
	}
}
?>
