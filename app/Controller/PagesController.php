<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {

    public $uses = array();


    public function login() {
        $this->layout = 'login';
        $this->set('title_for_layout', 'Login');
    }

    public function redirecting() {
        $this->loadModel('Login');
        $this->Login->find('all');
        $username = $this->request['data']['userid'];
        $password = $this->request['data']['password'];
        
        $data = $this->Login->checkLogin($username, $password);
        
        $this->Session->write('username', $data['Username']);
		$this->Session->write('domain', $data['Domain_Target']);
		
		if($data['Store1']!=null){
			$this->Session->write('idStore', $data['Store1']);
			return $this->redirect(
                        array('controller' => $data['Domain_Target'], 'action' => 'dashboard'));
		}else if($data['Store2']!=null){
			$this->Session->write('idStore', $data['Store2']);
			return $this->redirect(
                        array('controller' => $data['Domain_Target'], 'action' => 'dashboard'));
		}else{
			$this->Session->setFlash('Wrong password or username');
			return $this->redirect(
                        array('controller' => 'pages', 'action' => 'login'));
		}
		
        
    }

    public function logout() {
        $this->autoRender = false;
        $this->layout = 'login';
        
        $this->Session->destroy();
        $this->Session->setFlash('You have been logout');
        return $this->redirect(
                        array('controller' => 'pages', 'action' => 'login'));
       
    }

}
