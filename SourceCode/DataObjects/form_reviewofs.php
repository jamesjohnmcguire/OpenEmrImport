<?php
/////////////////////////////////////////////////////////////////////////////
// Represents a form_reviewofs Collection
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
require_once "Defines.php";
require_once "../Libraries/Utils.php";
require_once "../Libraries/DatabaseLibrary.php";

class form_reviewofs
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
		$this->debug->Show(Debug::DEBUG, "form_reviewofs::Delete");

		$query = "DELETE FROM form_reviewofs ".
			"WHERE id = '$id'";

		$result = $this->database->Delete($query);
		$this->debug->Show(Debug::DEBUG, "form_reviewofs::Delete return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetList
	/////////////////////////////////////////////////////////////////////////
	function GetList($where)
	{
		$sql = "SELECT * FROM form_reviewofs";

		if (!empty($where))
		{
			$sql .= ' '.$where;
		}

		$form_reviewofss = $this->database->GetAll($sql);

		return $form_reviewofss;
	}

	/////////////////////////////////////////////////////////////////////////
	// GetRecord
	/////////////////////////////////////////////////////////////////////////
	function GetRecord($id)
	{
		$sql = "SELECT * FROM form_reviewofs WHERE id = '$id'";

		$form_reviewofsRecord = $this->database->GetRow($sql);

		return $form_reviewofsRecord;
	}

	/////////////////////////////////////////////////////////////////////////
	// Insert
	/////////////////////////////////////////////////////////////////////////
	function Insert($date, $pid, $user, $groupname, $authorized, $activity, $fever, $chills, $night_sweats, $weight_loss, $poor_appetite, $insomnia, $fatigued, $depressed, $hyperactive, $exposure_to_foreign_countries, $cataracts, $cataract_surgery, $glaucoma, $double_vision, $blurred_vision, $poor_hearing, $headaches, $ringing_in_ears, $bloody_nose, $sinusitis, $sinus_surgery, $dry_mouth, $strep_throat, $tonsillectomy, $swollen_lymph_nodes, $throat_cancer, $throat_cancer_surgery, $heart_attack, $irregular_heart_beat, $chest_pains, $shortness_of_breath, $high_blood_pressure, $heart_failure, $poor_circulation, $vascular_surgery, $cardiac_catheterization, $coronary_artery_bypass, $heart_transplant, $stress_test, $emphysema, $chronic_bronchitis, $interstitial_lung_disease, $shortness_of_breath_2, $lung_cancer, $lung_cancer_surgery, $pheumothorax, $stomach_pains, $peptic_ulcer_disease, $gastritis, $endoscopy, $polyps, $colonoscopy, $colon_cancer, $colon_cancer_surgery, $ulcerative_colitis, $crohns_disease, $appendectomy, $divirticulitis, $divirticulitis_surgery, $gall_stones, $cholecystectomy, $hepatitis, $cirrhosis_of_the_liver, $splenectomy, $kidney_failure, $kidney_stones, $kidney_cancer, $kidney_infections, $bladder_infections, $bladder_cancer, $prostate_problems, $prostate_cancer, $kidney_transplant, $sexually_transmitted_disease, $burning_with_urination, $discharge_from_urethra, $rashes, $infections, $ulcerations, $pemphigus, $herpes, $osetoarthritis, $rheumotoid_arthritis, $lupus, $ankylosing_sondlilitis, $swollen_joints, $stiff_joints, $broken_bones, $neck_problems, $back_problems, $back_surgery, $scoliosis, $herniated_disc, $shoulder_problems, $elbow_problems, $wrist_problems, $hand_problems, $hip_problems, $knee_problems, $ankle_problems, $foot_problems, $insulin_dependent_diabetes, $noninsulin_dependent_diabetes, $hypothyroidism, $hyperthyroidism, $cushing_syndrom, $addison_syndrom, $additional_notes)
	{
		$this->debug->Show(Debug::DEBUG, "form_reviewofs::Insert");

		$sql = "INSERT INTO form_reviewofs (date, pid, user, groupname, authorized, activity, fever, chills, night_sweats, weight_loss, poor_appetite, insomnia, fatigued, depressed, hyperactive, exposure_to_foreign_countries, cataracts, cataract_surgery, glaucoma, double_vision, blurred_vision, poor_hearing, headaches, ringing_in_ears, bloody_nose, sinusitis, sinus_surgery, dry_mouth, strep_throat, tonsillectomy, swollen_lymph_nodes, throat_cancer, throat_cancer_surgery, heart_attack, irregular_heart_beat, chest_pains, shortness_of_breath, high_blood_pressure, heart_failure, poor_circulation, vascular_surgery, cardiac_catheterization, coronary_artery_bypass, heart_transplant, stress_test, emphysema, chronic_bronchitis, interstitial_lung_disease, shortness_of_breath_2, lung_cancer, lung_cancer_surgery, pheumothorax, stomach_pains, peptic_ulcer_disease, gastritis, endoscopy, polyps, colonoscopy, colon_cancer, colon_cancer_surgery, ulcerative_colitis, crohns_disease, appendectomy, divirticulitis, divirticulitis_surgery, gall_stones, cholecystectomy, hepatitis, cirrhosis_of_the_liver, splenectomy, kidney_failure, kidney_stones, kidney_cancer, kidney_infections, bladder_infections, bladder_cancer, prostate_problems, prostate_cancer, kidney_transplant, sexually_transmitted_disease, burning_with_urination, discharge_from_urethra, rashes, infections, ulcerations, pemphigus, herpes, osetoarthritis, rheumotoid_arthritis, lupus, ankylosing_sondlilitis, swollen_joints, stiff_joints, broken_bones, neck_problems, back_problems, back_surgery, scoliosis, herniated_disc, shoulder_problems, elbow_problems, wrist_problems, hand_problems, hip_problems, knee_problems, ankle_problems, foot_problems, insulin_dependent_diabetes, noninsulin_dependent_diabetes, hypothyroidism, hyperthyroidism, cushing_syndrom, addison_syndrom, additional_notes)".
			" VALUES ('$date', '" + "'$pid', '" + "'$user', '" + "'$groupname', '" + "'$authorized', '" + "'$activity', '" + "'$fever', '" + "'$chills', '" + "'$night_sweats', '" + "'$weight_loss', '" + "'$poor_appetite', '" + "'$insomnia', '" + "'$fatigued', '" + "'$depressed', '" + "'$hyperactive', '" + "'$exposure_to_foreign_countries', '" + "'$cataracts', '" + "'$cataract_surgery', '" + "'$glaucoma', '" + "'$double_vision', '" + "'$blurred_vision', '" + "'$poor_hearing', '" + "'$headaches', '" + "'$ringing_in_ears', '" + "'$bloody_nose', '" + "'$sinusitis', '" + "'$sinus_surgery', '" + "'$dry_mouth', '" + "'$strep_throat', '" + "'$tonsillectomy', '" + "'$swollen_lymph_nodes', '" + "'$throat_cancer', '" + "'$throat_cancer_surgery', '" + "'$heart_attack', '" + "'$irregular_heart_beat', '" + "'$chest_pains', '" + "'$shortness_of_breath', '" + "'$high_blood_pressure', '" + "'$heart_failure', '" + "'$poor_circulation', '" + "'$vascular_surgery', '" + "'$cardiac_catheterization', '" + "'$coronary_artery_bypass', '" + "'$heart_transplant', '" + "'$stress_test', '" + "'$emphysema', '" + "'$chronic_bronchitis', '" + "'$interstitial_lung_disease', '" + "'$shortness_of_breath_2', '" + "'$lung_cancer', '" + "'$lung_cancer_surgery', '" + "'$pheumothorax', '" + "'$stomach_pains', '" + "'$peptic_ulcer_disease', '" + "'$gastritis', '" + "'$endoscopy', '" + "'$polyps', '" + "'$colonoscopy', '" + "'$colon_cancer', '" + "'$colon_cancer_surgery', '" + "'$ulcerative_colitis', '" + "'$crohns_disease', '" + "'$appendectomy', '" + "'$divirticulitis', '" + "'$divirticulitis_surgery', '" + "'$gall_stones', '" + "'$cholecystectomy', '" + "'$hepatitis', '" + "'$cirrhosis_of_the_liver', '" + "'$splenectomy', '" + "'$kidney_failure', '" + "'$kidney_stones', '" + "'$kidney_cancer', '" + "'$kidney_infections', '" + "'$bladder_infections', '" + "'$bladder_cancer', '" + "'$prostate_problems', '" + "'$prostate_cancer', '" + "'$kidney_transplant', '" + "'$sexually_transmitted_disease', '" + "'$burning_with_urination', '" + "'$discharge_from_urethra', '" + "'$rashes', '" + "'$infections', '" + "'$ulcerations', '" + "'$pemphigus', '" + "'$herpes', '" + "'$osetoarthritis', '" + "'$rheumotoid_arthritis', '" + "'$lupus', '" + "'$ankylosing_sondlilitis', '" + "'$swollen_joints', '" + "'$stiff_joints', '" + "'$broken_bones', '" + "'$neck_problems', '" + "'$back_problems', '" + "'$back_surgery', '" + "'$scoliosis', '" + "'$herniated_disc', '" + "'$shoulder_problems', '" + "'$elbow_problems', '" + "'$wrist_problems', '" + "'$hand_problems', '" + "'$hip_problems', '" + "'$knee_problems', '" + "'$ankle_problems', '" + "'$foot_problems', '" + "'$insulin_dependent_diabetes', '" + "'$noninsulin_dependent_diabetes', '" + "'$hypothyroidism', '" + "'$hyperthyroidism', '" + "'$cushing_syndrom', '" + "'$addison_syndrom', '" + "'$additional_notes')";

		$result	= $this->database->Insert($sql);
		$this->debug->Show(Debug::DEBUG, "form_reviewofs::Insert return: $result");

		return $result;
	}

	/////////////////////////////////////////////////////////////////////////
	// Update
	/////////////////////////////////////////////////////////////////////////
	function Update($id, $date, $pid, $user, $groupname, $authorized, $activity, $fever, $chills, $night_sweats, $weight_loss, $poor_appetite, $insomnia, $fatigued, $depressed, $hyperactive, $exposure_to_foreign_countries, $cataracts, $cataract_surgery, $glaucoma, $double_vision, $blurred_vision, $poor_hearing, $headaches, $ringing_in_ears, $bloody_nose, $sinusitis, $sinus_surgery, $dry_mouth, $strep_throat, $tonsillectomy, $swollen_lymph_nodes, $throat_cancer, $throat_cancer_surgery, $heart_attack, $irregular_heart_beat, $chest_pains, $shortness_of_breath, $high_blood_pressure, $heart_failure, $poor_circulation, $vascular_surgery, $cardiac_catheterization, $coronary_artery_bypass, $heart_transplant, $stress_test, $emphysema, $chronic_bronchitis, $interstitial_lung_disease, $shortness_of_breath_2, $lung_cancer, $lung_cancer_surgery, $pheumothorax, $stomach_pains, $peptic_ulcer_disease, $gastritis, $endoscopy, $polyps, $colonoscopy, $colon_cancer, $colon_cancer_surgery, $ulcerative_colitis, $crohns_disease, $appendectomy, $divirticulitis, $divirticulitis_surgery, $gall_stones, $cholecystectomy, $hepatitis, $cirrhosis_of_the_liver, $splenectomy, $kidney_failure, $kidney_stones, $kidney_cancer, $kidney_infections, $bladder_infections, $bladder_cancer, $prostate_problems, $prostate_cancer, $kidney_transplant, $sexually_transmitted_disease, $burning_with_urination, $discharge_from_urethra, $rashes, $infections, $ulcerations, $pemphigus, $herpes, $osetoarthritis, $rheumotoid_arthritis, $lupus, $ankylosing_sondlilitis, $swollen_joints, $stiff_joints, $broken_bones, $neck_problems, $back_problems, $back_surgery, $scoliosis, $herniated_disc, $shoulder_problems, $elbow_problems, $wrist_problems, $hand_problems, $hip_problems, $knee_problems, $ankle_problems, $foot_problems, $insulin_dependent_diabetes, $noninsulin_dependent_diabetes, $hypothyroidism, $hyperthyroidism, $cushing_syndrom, $addison_syndrom, $additional_notes)
	{
		$this->debug->Show(Debug::DEBUG, "form_reviewofs::Update");

		$sql = "UPDATE form_reviewofs SET ".
				@"date='$date'," + 
				@"pid='$pid'," + 
				@"user='$user'," + 
				@"groupname='$groupname'," + 
				@"authorized='$authorized'," + 
				@"activity='$activity'," + 
				@"fever='$fever'," + 
				@"chills='$chills'," + 
				@"night_sweats='$night_sweats'," + 
				@"weight_loss='$weight_loss'," + 
				@"poor_appetite='$poor_appetite'," + 
				@"insomnia='$insomnia'," + 
				@"fatigued='$fatigued'," + 
				@"depressed='$depressed'," + 
				@"hyperactive='$hyperactive'," + 
				@"exposure_to_foreign_countries='$exposure_to_foreign_countries'," + 
				@"cataracts='$cataracts'," + 
				@"cataract_surgery='$cataract_surgery'," + 
				@"glaucoma='$glaucoma'," + 
				@"double_vision='$double_vision'," + 
				@"blurred_vision='$blurred_vision'," + 
				@"poor_hearing='$poor_hearing'," + 
				@"headaches='$headaches'," + 
				@"ringing_in_ears='$ringing_in_ears'," + 
				@"bloody_nose='$bloody_nose'," + 
				@"sinusitis='$sinusitis'," + 
				@"sinus_surgery='$sinus_surgery'," + 
				@"dry_mouth='$dry_mouth'," + 
				@"strep_throat='$strep_throat'," + 
				@"tonsillectomy='$tonsillectomy'," + 
				@"swollen_lymph_nodes='$swollen_lymph_nodes'," + 
				@"throat_cancer='$throat_cancer'," + 
				@"throat_cancer_surgery='$throat_cancer_surgery'," + 
				@"heart_attack='$heart_attack'," + 
				@"irregular_heart_beat='$irregular_heart_beat'," + 
				@"chest_pains='$chest_pains'," + 
				@"shortness_of_breath='$shortness_of_breath'," + 
				@"high_blood_pressure='$high_blood_pressure'," + 
				@"heart_failure='$heart_failure'," + 
				@"poor_circulation='$poor_circulation'," + 
				@"vascular_surgery='$vascular_surgery'," + 
				@"cardiac_catheterization='$cardiac_catheterization'," + 
				@"coronary_artery_bypass='$coronary_artery_bypass'," + 
				@"heart_transplant='$heart_transplant'," + 
				@"stress_test='$stress_test'," + 
				@"emphysema='$emphysema'," + 
				@"chronic_bronchitis='$chronic_bronchitis'," + 
				@"interstitial_lung_disease='$interstitial_lung_disease'," + 
				@"shortness_of_breath_2='$shortness_of_breath_2'," + 
				@"lung_cancer='$lung_cancer'," + 
				@"lung_cancer_surgery='$lung_cancer_surgery'," + 
				@"pheumothorax='$pheumothorax'," + 
				@"stomach_pains='$stomach_pains'," + 
				@"peptic_ulcer_disease='$peptic_ulcer_disease'," + 
				@"gastritis='$gastritis'," + 
				@"endoscopy='$endoscopy'," + 
				@"polyps='$polyps'," + 
				@"colonoscopy='$colonoscopy'," + 
				@"colon_cancer='$colon_cancer'," + 
				@"colon_cancer_surgery='$colon_cancer_surgery'," + 
				@"ulcerative_colitis='$ulcerative_colitis'," + 
				@"crohns_disease='$crohns_disease'," + 
				@"appendectomy='$appendectomy'," + 
				@"divirticulitis='$divirticulitis'," + 
				@"divirticulitis_surgery='$divirticulitis_surgery'," + 
				@"gall_stones='$gall_stones'," + 
				@"cholecystectomy='$cholecystectomy'," + 
				@"hepatitis='$hepatitis'," + 
				@"cirrhosis_of_the_liver='$cirrhosis_of_the_liver'," + 
				@"splenectomy='$splenectomy'," + 
				@"kidney_failure='$kidney_failure'," + 
				@"kidney_stones='$kidney_stones'," + 
				@"kidney_cancer='$kidney_cancer'," + 
				@"kidney_infections='$kidney_infections'," + 
				@"bladder_infections='$bladder_infections'," + 
				@"bladder_cancer='$bladder_cancer'," + 
				@"prostate_problems='$prostate_problems'," + 
				@"prostate_cancer='$prostate_cancer'," + 
				@"kidney_transplant='$kidney_transplant'," + 
				@"sexually_transmitted_disease='$sexually_transmitted_disease'," + 
				@"burning_with_urination='$burning_with_urination'," + 
				@"discharge_from_urethra='$discharge_from_urethra'," + 
				@"rashes='$rashes'," + 
				@"infections='$infections'," + 
				@"ulcerations='$ulcerations'," + 
				@"pemphigus='$pemphigus'," + 
				@"herpes='$herpes'," + 
				@"osetoarthritis='$osetoarthritis'," + 
				@"rheumotoid_arthritis='$rheumotoid_arthritis'," + 
				@"lupus='$lupus'," + 
				@"ankylosing_sondlilitis='$ankylosing_sondlilitis'," + 
				@"swollen_joints='$swollen_joints'," + 
				@"stiff_joints='$stiff_joints'," + 
				@"broken_bones='$broken_bones'," + 
				@"neck_problems='$neck_problems'," + 
				@"back_problems='$back_problems'," + 
				@"back_surgery='$back_surgery'," + 
				@"scoliosis='$scoliosis'," + 
				@"herniated_disc='$herniated_disc'," + 
				@"shoulder_problems='$shoulder_problems'," + 
				@"elbow_problems='$elbow_problems'," + 
				@"wrist_problems='$wrist_problems'," + 
				@"hand_problems='$hand_problems'," + 
				@"hip_problems='$hip_problems'," + 
				@"knee_problems='$knee_problems'," + 
				@"ankle_problems='$ankle_problems'," + 
				@"foot_problems='$foot_problems'," + 
				@"insulin_dependent_diabetes='$insulin_dependent_diabetes'," + 
				@"noninsulin_dependent_diabetes='$noninsulin_dependent_diabetes'," + 
				@"hypothyroidism='$hypothyroidism'," + 
				@"hyperthyroidism='$hyperthyroidism'," + 
				@"cushing_syndrom='$cushing_syndrom'," + 
				@"addison_syndrom='$addison_syndrom'," + 
				@"additional_notes='$additional_notes'" + 
				
				"WHERE id = '$id'";

		$result = $this->database->Update($sql);
		$this->debug->Show(Debug::DEBUG, "form_reviewofs::Update return: $result");

		return $result;
	}
}
?>
