<?php
	class OLMedicsController extends AppController {
			
		public function login()	{
			$this->loadModel('Login');
			$this->Login->find('all');
			$data = $this->Login->checkLogin('Admin','Admin');
			$this->set('data',$data);
			//$this->redirect($data['Domain_Target']); // working			
		}
		
	}
?>