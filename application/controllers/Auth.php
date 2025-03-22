<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Usuarios_model');
	

	}

	public function index()
	{
			$this->load->view("login");
	}



	public function pre_auth_email()
	{

		$access_key = 'ff8865c6d6e4df35581212d09a639e2d';
		$email = $this->input->post('email');
		$password      = $this->input->post('password');

		$ch = curl_init('http://apilayer.net/api/check?access_key='.$access_key.'&email='.$email.'');  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$json = curl_exec($ch);
		curl_close($ch);

		$resultado = json_decode($json, true);

		//print_r($resultado);

		$formato =  $resultado['format_valid'];
		$serv    =  $resultado['smtp_check'];
		$mxFound =  $resultado['mx_found'];

		if ($formato == 1 && $serv == 1 && $mxFound == 1)
		{
			$this->login($email,$password);
		}
		else
		{
			$this->session->set_flashdata("error",'¡Cuenta de Correo Invalida!');
			redirect(base_url());
		}

	}	

	public function login()
	{
		$email    = $this->input->post("email");
		$password = $this->input->post("password");
		//exit();
		$query= $this->Usuarios_model->login($email, sha1($password));

		if(!$query){
		$this->session->set_flashdata("error",'El Usuario y /o Contraseña son Incorrectos');
				redirect(base_url());
		}else{

			$data  = array(
					'id'       => $query->id,
					'username' => $query->username,
					'email'    => $query->email,				
					'login' => TRUE
				);
				$this->session->set_userdata($data);
				redirect(base_url()."programador");
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('login');
		session_destroy();
		redirect(base_url(), 'refresh');
	}


}