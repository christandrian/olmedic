<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class CdoctorController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function dashboard() {
	 $this->set('title_for_layout', 'Dashboard');
	$this->layout = 'c_frontdesk';
	}
	
	public function history() {
	 $this->set('title_for_layout', 'Dashboard');
	$this->layout = 'c_frontdesk';
	}
	
	public function queue() {
	 $this->set('title_for_layout', 'Dashboard');
	$this->layout = 'c_frontdesk';
	}
	
	public function patient() {
	 $this->set('title_for_layout', 'Dashboard');
	$this->layout = 'c_frontdesk';
	}
	
	public function finishPatient()	{
			$this->init();
			$id_store = "Clin000";
			$queueNumber = "1"; //Ini harus diinput dari patient
			$id_doctor = 1;//Ini harus diinput dari patient			
			$date_time =  date("Y-m-d H:i:s");
			//Change queue status into 2 (Wait For Payment)
			$this->DashBoard_Clinic->changeQueueStatus($id_store, $queueNumber, $id_doctor, 2, $date_time);
	}
		
		
	public function addDoctor()		{
			$this->init();
			$social_number = "TestSocialNumber";
			$first_name =  "FirstNameDoctor";
			$last_name =  "Last Name Doctor";
			$birth_date =  date("Y-m-d");
			$address =  "Test Address Doctor";
			$gender =  "Laki-Laki";
			$blood_type = "O Positif";;
			$handphone = "08123456789";
			$this->DashBoard_Clinic->addDoctor($social_number, $first_name, $last_name, $birth_date, $address, $gender, $blood_type, $handphone);
		}
		public function editDoctor()	{
			$this->init();
			$id_doctor = 2;
			$address = "Edit Address";
			$gender = "Male";
			$first_name = "Doctor";
			$last_name = "Penyakit";
			$birth_date =  date("Y-m-d");
			$blood_type = "O Positif";;
			$handphone = "08123456789";
			$this->DashBoard_Clinic->editDoctor($id_doctor, $address, $gender, $first_name, $last_name,$birth_date, $blood_type, $handphone);
		}
		public function loadDoctor()	{
			$this->init();
			$id_doctor = 2;
			$result = $this->DashBoard_Clinic->loadDoctor($id_doctor);
			$this->set("data",$result);
		}
		public function loadListDoctor()	{
			$this->init();
			$result = $this->DashBoard_Clinic->loadListDoctor();
			$this->set("data",$result);
		}
}
