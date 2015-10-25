<?php

App::uses('AppModel', 'Model');

class Login extends AppModel {

    public $useTable = 'user_level';
    public $primaryKey = 'Level';

    public function checkLogin($user, $pass) {
        $sql = "SELECT * FROM `user_id` where `Username` LIKE '$user' AND `Password` LIKE md5('$pass');";
        $data = $this->query($sql);
        if (sizeof($data) >= 1 && sizeof($data[0]) == 1) {
            $result['Username'] = $user;
            $result['Level'] = $data[0]['user_id']['Level'];
            
			$sql = "SELECT `Domain_Target` FROM `user_level` where `Level` = " . $result['Level'];
            $data = $this->query($sql);
            $result['Domain_Target'] = $data[0]['user_level']['Domain_Target'];
			
			$sql = "SELECT * FROM `user_id_store_list` where `Username` LIKE '" . $result['Username']."';";
			$data = $this->query($sql);
			$result['Store1'] = $data[0]['user_id_store_list']['ID_Pharmacy'];
			$result['Store2'] = $data[0]['user_id_store_list']['ID_Clinic'];
        } else {
            $result = false;
        }
        return $result;
    }

}
