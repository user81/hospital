<?php

include('class.password.php');

class User extends Password{

    private $db;
	public $_db;

	function __construct($db){
		parent::__construct();
		$this->_db = $db;
	}
//$_SESSION суперглобальный массив
	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}

	private function get_doctor_hash($email){
			$stmt = $this->_db->prepare('SELECT `id`, `email`, `password` FROM `doctors` WHERE email = :email');
			$stmt->execute(array(':email' => $email));
			return $stmt->fetch();
	}


	public function login($email,$password){

		$doctors = $this->get_doctor_hash($email);

		if($this->password_verify($password,$doctors['password']) == 1){

		    $_SESSION['loggedin'] = true;
		    $_SESSION['id'] = $doctors['id'];
		    $_SESSION['email'] = $doctors['email'];
		    return true;
		}
	}


	public function logout(){
		session_destroy();
	}

}


?>