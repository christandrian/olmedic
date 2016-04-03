<?php

App::uses('AppModel', 'Model');

class DashBoard_Doctor extends AppModel {
	
	public $useTable = 'store';
	 
    public function findAll($tableName) {
        $sql = "SELECT * FROM $tableName;";
        $result = $this->query($sql);
        return $result;
    }

    public function findWhere($tableName, $condition) {
        $sql = "SELECT * FROM $tableName WHERE $condition;";
        $result = $this->query($sql);
        return $result;
    }

    public function getByColumn($array, $column) {
        foreach ($array as $item) {
            $result[] = $item[$column];
        }
        return $result;
    }

    public function loadPatientByDoctor($id_clinic, $id_doctor, $status) {
        $sql = "SELECT `ID_Visit`,`patient_clinic`.`ID_Patient`, `Social_Number`, `First_Name`, 
			`Last_Name`, `Birth_Date`, `Address`, `Gender`, `Blood_Type`, `Weight`, 
			`Handphone_Number`, `Emergency_Contact`, `Temp`.`Queue Number` as `Queue Number`
		FROM `patient_clinic`  
		JOIN 
			(
				SELECT `ID_Patient`, `ID_Visit`, `Inner_Temp`.`Queue_Number` as `Queue Number`
				FROM `visit_history_clinic` 
				JOIN (
					SELECT `Queue_Number`
					FROM `queue_clinic`
					Where `ID_Store` = '$id_clinic' AND `ID_Doctor` = '$id_doctor' AND `Status` = '$status'
				) as `Inner_Temp`
				ON `visit_history_clinic`.`Queue_Number` = `Inner_Temp`.`Queue_Number`
				WHERE `visit_history_clinic`.`Status` = '0' AND `visit_history_clinic`.`ID_Store` = '$id_clinic'
			) as `Temp`
		ON `patient_clinic`.`ID_Patient`= `Temp`.`ID_Patient`";
        $res = $this->query($sql);
        $result = array();
        $counter = 0;
        foreach ($res as $r) {
            $result[$counter] = $r['patient_clinic'];
            $result[$counter]['ID_Visit'] = $r['Temp']['ID_Visit'];
            $result[$counter]['Queue_Number'] = $r['Temp']['Queue Number'];
            $counter++;
        }
        return $result;
    }

    public function frontdesk($user) {
        $sql = "SELECT * FROM `user_id_store_list` WHERE `Username` LIKE '$user'";
        $data = $this->query($sql);
        $result = array();
        if (sizeof($data) >= 1 && sizeof($data[0]) == 1) {
            $result['id_clinic'] = $data[0]['user_id_store_list']['ID_Clinic'];
            $id_clinic = $result['id_clinic'];
            $sql = "SELECT * FROM `store` WHERE `ID_Store` LIKE '$id_clinic'";
            $data = $this->query($sql);
            $result['data_store'] = $data[0]['store'];
        } else {
            
        }
        return $result;
    }

    public function getIdDoctor($username) {

        $sql = "SELECT  `ID_Doctor` 
		FROM `doctor_clinic` WHERE `Username`='$username';";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['doctor_clinic'];
        }
        return $result;
    }

    public function LoadPatientListAnamnesa($id_patient, $id_store, $id_visit) {
        $sql = "SELECT  Anamnesa
		FROM `visit_history_clinic` 
		WHERE `ID_Patient` = '$id_patient' AND `ID_Store` = '$id_store' AND `ID_Visit` = '$id_visit';";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['visit_history_clinic'];
        }
        return $result;
    }

    public function PatientLoadDoctorDiagnose($id_patient, $id_store, $id_visit) {
        $sql = "SELECT `ddc`.`ID_Visit`, `ID_Diagnosis`, `Treatment`, `Prescription_List`, `Image`, `Memo`, `Time_Created` 
		FROM `doctor_diagnosis_clinic` as `ddc` 
		JOIN (
			SELECT `ID_Visit`,`ID_Patient` 
			FROM `visit_history_clinic` 
			WHERE `ID_Patient` = '$id_patient' AND `ID_Store` = '$id_store' AND `ID_Visit` = '$id_visit'
		) as `iv` 
		ON `iv`.`ID_Visit` = `ddc`.`ID_Visit`;";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['ddc'];
        }
        return $result;
    }

    public function LoadDetailDiagnose($id_diagnosis) {
        $sql = "SELECT `ID_Detail`, `Diagnosis`, `Memo` 
		FROM `detail_doctor_diagnosis_clinic`  as `dddc`
		WHERE `ID_Diagnosis` = '$id_diagnosis'";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['dddc'];
        }
        return $result;
    }

    public function loadIDX() {

        $sql = "SELECT  `code`, `diagnose` 
		FROM `mr_diagnose_std_code`;";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['mr_diagnose_std_code'];
        }
        return $result;
    }

    public function insertDiagnose($id_visit, $detail, $time) {

        $sql = "SELECT `ddc`.`ID_Visit`, `ID_Diagnosis`, `Treatment`, `Prescription_List`, `Image`, `Memo`, `Time_Created` 
		FROM `doctor_diagnosis_clinic` as `ddc` WHERE `ddc`.`ID_Visit` = '$id_visit';";
        $res = $this->query($sql);

        if ($res) {
            //update
            $sql = "UPDATE `doctor_diagnosis_clinic` SET `Prescription_List`='$detail[prescription_list]',
		`Treatment`='$detail[treatment]',`Memo`='$detail[memo]',`Time_Created`='$time' WHERE `ID_Visit` = '$id_visit'";
            $res = $this->query($sql);
        } else {
            //insert
            $sql = "INSERT INTO `ol_medic`.`doctor_diagnosis_clinic` 
		(`ID_Diagnosis`, `ID_Visit`, `Treatment`, `Prescription_List`, `Image`, `Memo`, `Time_Created`) 
		VALUES 
		(NULL, '$id_visit', '$detail[treatment]', '$detail[prescription_list]', '$detail[image]', '$detail[memo]', '$time');";
            $res = $this->query($sql);
        }

        $sql = "SELECT `ID_Diagnosis` FROM `doctor_diagnosis_clinic` WHERE `ID_Visit` = '$id_visit'; ";
        $res = $this->query($sql);
        return $res;
    }

    //New!
    public function insertDetailDiagnose($id_diagnose, $detail) {
        $sql = "INSERT INTO `ol_medic`.`detail_doctor_diagnosis_clinic` 
		(`ID_Detail`, `ID_Diagnosis`, `Diagnosis`, `Memo`) 
		VALUES 
		(NULL, '$id_diagnose', '$detail[diagnose_code]', '$detail[memo]');";
        $res = $this->query($sql);
    }

    public function getDetailDiagnose($id_diagnose) {
        $sql = "SELECT `ID_Detail`, `Diagnosis` FROM `detail_doctor_diagnosis_clinic` WHERE `ID_Diagnosis` = '$id_diagnose';";
        $res = $this->query($sql);
        foreach ($res as $r) {
            $result[] = $r['detail_doctor_diagnosis_clinic'];
        }
        return $result;
    }

    public function getDetailDiagnose_($id_diagnose, $diagnosis) {
        $sql = "SELECT `ID_Detail` FROM `detail_doctor_diagnosis_clinic` WHERE `ID_Diagnosis` = '$id_diagnose' AND `Diagnosis`='$diagnosis';";
        $res = $this->query($sql);
        return $res;
    }

    public function deleteDetailDiagnose($detail, $id_diagnose) {
        $sql = "DELETE FROM `detail_doctor_diagnosis_clinic` WHERE `Diagnosis` = '$detail' AND `ID_Diagnosis` = '$id_diagnose';";
        $res = $this->query($sql);
        //echo var_dump($res);
    }

    public function insertImage($id_visit, $image) {
        //delete dulu gmbr yg di folder nya.
        $sql = "UPDATE `doctor_diagnosis_clinic` SET `Image`='$image' WHERE `ID_Visit` = '$id_visit'";
        $res = $this->query($sql);
    }

    public function changeQueueStatus($id_store, $queue_number, $id_doctor, $new_status, $date_time) {
        $sql = "UPDATE `ol_medic`.`queue_clinic` SET `Status` = '$new_status', `Time_Modified` = '$date_time' WHERE `queue_clinic`.`ID_Store` = '$id_store' AND `queue_clinic`.`Queue_Number` = '$queue_number' AND `queue_clinic`.`ID_Doctor` = '$id_doctor';";

        $res = $this->query($sql);
        return $res;
    }

	public function loadPatientByDoctor_($id_clinic, $id_doctor) {
        $sql = "SELECT `ID_Visit`,`patient_clinic`.`ID_Patient`, `Social_Number`, `First_Name`, 
			`Last_Name`, `Birth_Date`, `Address`, `Gender`, `Blood_Type`, `Weight`, 
			`Handphone_Number`, `Emergency_Contact`
		FROM `patient_clinic`  
		JOIN 
			(
				SELECT `ID_Patient`, `ID_Visit`
				FROM `visit_history_clinic` 
				JOIN (
					SELECT `Queue_Number`
					FROM `queue_clinic`
					Where `ID_Store` = '$id_clinic' AND `ID_Doctor` = '$id_doctor' AND `Status` = '3'
				) as `Inner_Temp`
				ON `visit_history_clinic`.`Queue_Number` = `Inner_Temp`.`Queue_Number`
				WHERE `visit_history_clinic`.`Status` = '1' AND `visit_history_clinic`.`ID_Store` = '$id_clinic'
			) as `Temp`
		ON `patient_clinic`.`ID_Patient`= `Temp`.`ID_Patient`";
        $res = $this->query($sql);
        $result = array();
        $counter = 0;
        foreach ($res as $r) {
            $result[$counter] = $r['patient_clinic'];
            $result[$counter]['ID_Visit'] = $r['Temp']['ID_Visit'];
            $counter++;
        }
        return $result;
    }
	
	public function loadPatientByID($id_clinic, $id_patient) {
        $sql = "SELECT `ID_Patient`, `Social_Number`, `First_Name`, `Last_Name`, `Birth_Date`, `Address`, `Gender`, `Blood_Type`, `Weight`, `Handphone_Number`, `Emergency_Contact` FROM `patient_clinic` WHERE `ID_Store` = '$id_clinic' AND `ID_Patient` = '$id_patient'";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['patient_clinic'];
        }
        return $result;
    }
	
	public function loadPatientHistory($id_store, $id_patient) {
        $sql = "SELECT dc.First_Name as fm_doc ,dc.Last_Name as lm_doc , pc.First_Name as fm_pat , pc.Last_Name as lm_pat,
			vhc.Status, vhc.ID_Visit, vhc.Queue_Number, vhc.ID_Doc, vhc.Date_Time, vhc.ID_Patient 
			FROM `visit_history_clinic` as vhc
			JOIN `doctor_clinic` as dc ON dc.ID_Doctor = vhc.ID_Doc
			JOIN `patient_clinic` as pc on pc.ID_Patient = vhc.ID_Patient 
		WHERE vhc.`ID_Store`= '$id_store' AND vhc.`ID_Patient` = '$id_patient' AND vhc.`Status`=1;";
        $res = $this->query($sql);
        return $res;
    }
}
