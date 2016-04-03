<?php
App::uses('AppController', 'Controller');

class CdoctorController extends AppController {

    public $components = array('Session', 'Cookie');

    public function init() {
        $this->loadModel('DashBoard_Doctor');
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->DashBoard_Doctor->frontdesk(CakeSession::read('username'));
        $data['username'] = CakeSession::read('username');
        $data['storeName'] = $data['data_store']['Nama'];
        $this->set('data', $data);
        $this->layout = 'c_doctor';
    }

    public function dashboard() {
        $this->init();
        $this->set('title_for_layout', 'Beranda');
    }

    public function history() {
        $this->set('title_for_layout', 'Riwayat');
        $this->init();
		$id_store = CakeSession::read('idStore');
		 $username = CakeSession::read('username');
        $id = $this->DashBoard_Doctor->getIdDoctor($username);
        $id_doctor = $id[0]['ID_Doctor'];
		$history = $this->DashBoard_Doctor->loadPatientByDoctor_($id_store, $id_doctor);
		$this->set('history',$history);
    }

    public function queue() {
        $this->init();
        $id_store = CakeSession::read('idStore');
        $status = 1;
        $username = CakeSession::read('username');
        $id = $this->DashBoard_Doctor->getIdDoctor($username);
        $id_doctor = $id[0]['ID_Doctor'];
        $queue = $this->DashBoard_Doctor->loadPatientByDoctor($id_store, $status, $id_doctor);
        $this->set('queue', $queue);
        $this->set('title_for_layout', 'Antrian');
    }

		public function faq() {
        $this->init();
		$this->set('title_for_layout', 'FAQ');
    }
	
    public function getAnamnesa() {
        $this->init();
        $this->autoRender = false;
        $id_store = CakeSession::read('idStore');
        $id_visit = $this->request['data']['id_visit'];
        $id_patient = $this->request['data']['id_patient'];
        $anamnesa = $this->DashBoard_Doctor->LoadPatientListAnamnesa($id_patient, $id_store, $id_visit);
        return json_encode($anamnesa);
    }

    public function getTreatmentPrescription() {
        $this->init();
        $this->autoRender = false;
        $id_store = CakeSession::read('idStore');
        $id_visit = $this->request['data']['id_visit'];
        $id_patient = $this->request['data']['id_patient'];
        $treatmentPresc = $this->DashBoard_Doctor->PatientLoadDoctorDiagnose($id_patient, $id_store, $id_visit);

        return json_encode($treatmentPresc);
    }

    public function getIDX() {
        $this->init();
        $this->autoRender = false;
        $idx = $this->DashBoard_Doctor->loadIDX();
        return json_encode($idx);
    }

    public function getDetailDiagnose() {
        $this->init();
        $this->autoRender = false;
        $id_diagnose = $this->request['data']['id_diagnose'];
        $diagnose = $this->DashBoard_Doctor->LoadDetailDiagnose($id_diagnose);
        return json_encode($diagnose);
    }

    public function saveDiagnosis() {

        $this->init();
        $this->autoRender = false;
        $message = "";
        $id_visit = $this->request['data']['id'];
        $detail = array();
        $detail['treatment'] = $this->request['data']['treatment'];
        $detail['memo'] = '';
        $detail['prescription_list'] = $this->request['data']['prescription'];
        $time = date("Y-m-d H:i:s");
        $id_diagnose = $this->DashBoard_Doctor->insertDiagnose($id_visit, $detail, $time);
        $id_diagnose = $id_diagnose[0]['doctor_diagnosis_clinic']['ID_Diagnosis'];

        if (!isset($this->request['data']['image'])) {
//update/insert image
            $image = $this->request->params['form']['image'];
            $imageTypes = array("image/gif", "image/jpeg", "image/png");
            $uploadFolder = "img/upload";
            $uploadPath = WWW_ROOT . $uploadFolder;

//check if image type fits one of allowed types
            foreach ($imageTypes as $type) {
                if ($type == $image['type']) {
//check if there wasn't errors uploading file on serwer
                    if ($image['error'] == 0) {
                        $imageName = $image['name'];
                        if (file_exists($uploadPath . '/' . $imageName)) {
//create full filename with timestamp
                            $imageName = date('His') . $imageName;
                        }
                        $full_image_path = $uploadPath . '/' . $imageName;
                        if (move_uploaded_file($image['tmp_name'], $full_image_path)) {
//update ke DB
                            $this->DashBoard_Doctor->insertImage($id_visit, $imageName);
                        } else {
                            $message+="Error move/upload file;";
                        }
                    } else {
                        $message+="Error file;";
                    }
                    break;
                } else {
                    $message+="Wrong type file;";
                }
            }
        } else {
//remove
        }

//
        $diagnose = $this->request['data']['diagnose'];
        $diagnoseArr = explode(',', $diagnose);

        for ($i = 0; $i < count($diagnoseArr); $i++) {
            $detail = array();
            $yes = $this->DashBoard_Doctor->getDetailDiagnose_($id_diagnose, $diagnoseArr[$i]);
            if (count($yes) == 0) {
                $detail['diagnose_code'] = $diagnoseArr[$i];
                $detail['memo'] = '';
                $this->DashBoard_Doctor->insertDetailDiagnose($id_diagnose, $detail);
            }
        }
		
        $detDiagnosis = $this->DashBoard_Doctor->getDetailDiagnose($id_diagnose);
        for ($i = 0; $i < count($detDiagnosis); $i++) {
            $exist = false;
            for ($j = 0; $j < count($diagnoseArr); $j++) {
                if ($detDiagnosis[$i]['Diagnosis'] == $diagnoseArr[$j]) {
                    $exist = true;
                    break;
                }
            }

            if (!$exist) {
                $det = $detDiagnosis[$i]['Diagnosis'];
                $this->DashBoard_Doctor->deleteDetailDiagnose($det, $id_diagnose);
            }
        }

        return json_encode($message);
    }

    public function finishPatient() {
        $this->init();
        $this->autoRender = false;
        $id_store = CakeSession::read('idStore');
        $queueNumber = $this->request['data']['queue_number']; //Ini harus diinput dari patient

        $username = CakeSession::read('username');

        $id = $this->DashBoard_Doctor->getIdDoctor($username);
        $id_doctor = $id[0]['ID_Doctor'];

        $date_time = date("Y-m-d H:i:s");
//Change queue status into 2 (Wait For Payment)
        $this->DashBoard_Doctor->changeQueueStatus($id_store, $queueNumber, $id_doctor, 2, $date_time);
    }

    public function patient($id) {
        $this->set('title_for_layout', 'Dashboard');
        $this->init();
        $id_store = CakeSession::read('idStore');
        $id_patient = $id;
        $result = $this->DashBoard_Doctor->loadPatientByID($id_store, $id_patient);
        $result2 = $this->DashBoard_Doctor->loadPatientHistory($id_store, $id_patient);
        $this->set("patient", $result);
        //$this->set("history", $result2);
		$this->set('title_for_layout', 'Detail Pasien');
    }
	
	public function history_patient($id) {
        $this->set('title_for_layout', 'Dashboard');
        $this->init();
        $id_store = CakeSession::read('idStore');
        $id_patient = $id;
        //$result = $this->DashBoard_Doctor->loadPatientByID($id_store, $id_patient);
        $result2 = $this->DashBoard_Doctor->loadPatientHistory($id_store, $id_patient);
        //$this->set("patient", $result);
        $this->set("history", $result2);
		$this->set('title_for_layout', 'Riwayat Pasien');
    }
/*
    public function addDoctor() {
        $this->init();
        $social_number = "TestSocialNumber";
        $first_name = "FirstNameDoctor";
        $last_name = "Last Name Doctor";
        $birth_date = date("Y-m-d");
        $address = "Test Address Doctor";
        $gender = "Laki-Laki";
        $blood_type = "O Positif";
        ;
        $handphone = "08123456789";
        $this->DashBoard_Clinic->addDoctor($social_number, $first_name, $last_name, $birth_date, $address, $gender, $blood_type, $handphone);
    }

    public function editDoctor() {
        $this->init();
        $id_doctor = 2;
        $address = "Edit Address";
        $gender = "Male";
        $first_name = "Doctor";
        $last_name = "Penyakit";
        $birth_date = date("Y-m-d");
        $blood_type = "O Positif";
        $handphone = "08123456789";
        $this->DashBoard_Clinic->editDoctor($id_doctor, $address, $gender, $first_name, $last_name, $birth_date, $blood_type, $handphone);
    }*/

    public function loadDoctor() {
        $this->init();
        $id_doctor = 2;
        $result = $this->DashBoard_Clinic->loadDoctor($id_doctor);
        $this->set("data", $result);
    }

    public function loadListDoctor() {
        $this->init();
        $result = $this->DashBoard_Clinic->loadListDoctor();
        $this->set("data", $result);
    }

}
