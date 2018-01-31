<?php 
	
	class Login_model extends CI_Model {

		public function __construct() {
			 parent::__construct();
		}

		public function verify($username, $password) {
			$this->load->library("encrypt");

			$data = $this->dbmodel->select("
				user_account_id,
				user_account_username, 
                user_account_password, 
                user_account_picture, 
                user_account_group_id
            ")
            ->from("mo_info_user_account")
            ->where("user_account_username='$username'")
            ->is_single_row(true)
            ->execute();

			if($data) {
				$secret_pass = $this->encrypt->decode($data['user_account_password']);

				if($username == $data['user_account_username'] && $password == $secret_pass)
					return $data;
				else
					return array();
			} else 
				return array();
		}

	}
