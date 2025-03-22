<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}


		public function login($email, $password)
		{
		$this->db->where("email", $email);
		$this->db->where("password", $password);

		$query = $this->db->get("usuarios");
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	function checkMailReg($email)
	{
		$this->db->select("*");
		$this->db->from("usuarios");
		$this->db->where("email",$email);
		$query = $this->db->get();
		return $query->result();
	}

	function registrar($username,$email,$password)
	{
		   		$datareg = array(
				'username' => $username,
				'email'    => $email,
				'password' => sha1($password)	
   				);

   				$registro = $this->db->insert("usuarios",$datareg);
   				return $registro;

	}

}

/* End of file Usuarios_model.php */
/* Location: ./application/models/Usuarios_model.php */