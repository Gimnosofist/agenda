<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registro extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuarios_model');
	}

	public function index()
	{
		$this->load->view("registro");
	}

	public function registrar()
	{
	$access_key    = 'ff8865c6d6e4df35581212d09a639e2d';
	$username      = $this->input->post('username');
	$email         = $this->input->post('email');
	$password      = $this->input->post('password');

	$ch = curl_init('http://apilayer.net/api/check?access_key='.$access_key.'&email='.$email.'');  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Store the data:
	$json = curl_exec($ch);
	curl_close($ch);

	$resultado = json_decode($json, true);

	//print_r($resultado);

	$formato =  $resultado['format_valid'];
	$serv    =  $resultado['smtp_check'];
	$mxFound =  $resultado['mx_found'];

	if ($formato == 1 && $serv == 1 && $mxFound == 1)
	{
		$this->guardar_registro($username,$email,$password);
	}
	else
	{
		$this->session->set_flashdata("error",'¡Cuenta de Correo Invalida!');
		redirect(base_url("registro"));
	}

}
   	 function guardar_registro($username,$email,$password)
   	{
   		//Checamos que no exista el mail en db
   		$check = $this->Usuarios_model->checkMailReg($email);

   		if ($check)
   		{
   		$this->session->set_flashdata("error",'¡Cuenta de Correo Ya esta en uso!');
		redirect(base_url("registro"));
   		}
   		else
   		{

   			$registrar = $this->Usuarios_model->registrar($username,$email,$password);	

   			if ($registrar) {
   						$data  = array(
				'id'       => $query->id,
				'username' => $query->username,
				'email'    => $query->email,				
				'login' => TRUE
			);
			$this->session->set_userdata($data);
			redirect(base_url()."programador");
   			}
   			else
   			{
			$this->session->set_flashdata("error",'¡Ha ocurrido un error al registrar el usuario, contacte con el administrador del sistema!');
			redirect(base_url("registro"));
   			}
   		}

   	}

	}

	

/* End of file Registro.php */
/* Location: ./application/controllers/Registro.php */