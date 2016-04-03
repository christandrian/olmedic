<?php

App::uses('AppController', 'Controller');


class PagesController extends AppController {

    public $uses = array();
	public $components = array('Cookie');

    public function login() {
		$cookie = $this->Cookie->read('User');
		if($cookie!=NULL){
		$this->redirecting();
		}else{
		$this->layout = 'login';
        $this->set('title_for_layout', 'Login');
		}
		
        
		
    }

    public function redirecting() {
        $cookie = $this->Cookie->read('User');
		if($cookie!=NULL){
		$data['Username']=$this->Cookie->read('User.username');
		$data['Domain_Target']=	$this->Cookie->read('User.domain');
		$data['Store1']=	$this->Cookie->read('User.store1');
		$data['Store2']=	$this->Cookie->read('User.store2');
		}else{
		$this->loadModel('Login');
        $this->Login->find('all');
        $username = $this->request['data']['userid'];
        $password = $this->request['data']['password'];
        
        $data = $this->Login->checkLogin($username, $password);
        
        $this->Session->write('username', $data['Username']);
		$this->Session->write('domain', $data['Domain_Target']);
		
		
		}
		
		if($data['Store1']!=null){
			if(isset($this->request['data']['remember_me'])){
			$this->Cookie->write('User.username', $data['Username']);
			$this->Cookie->write('User.domain', $data['Domain_Target']);
			$this->Cookie->write('User.store1', $data['Store1']);
			$this->Cookie->write('User.store2', $data['Store2']);
			}
			
			
			$this->Session->write('idStore', $data['Store1']);
			return $this->redirect(
                      array('controller' => $data['Domain_Target'], 'action' => 'dashboard'));
		}else if($data['Store2']!=null){
			if(isset($this->request['data']['remember_me'])){
			$this->Cookie->write('User.username', $data['Username']);
			$this->Cookie->write('User.domain', $data['Domain_Target']);
			$this->Cookie->write('User.store1', $data['Store1']);
			$this->Cookie->write('User.store2', $data['Store2']);
			}
			
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
        $this->Cookie->delete('User');
        $this->Session->destroy();
        $this->Session->setFlash('You have been logout');
        return $this->redirect(
                        array('controller' => 'pages', 'action' => 'login'));
       
    }

}
