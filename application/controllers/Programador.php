<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programador extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        date_default_timezone_set("America/Mexico_City");
		$this->load->model("Programador_model");
		$this->load->model("Tecnologias_model");
		$this->load->library("upload");

		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}	
	}
	public function index()
	{
				
		$data = array(
			'devs'        => $this->Programador_model->getProgramadores(),
			'tecnologias' => $this->Tecnologias_model->getTecnologias());
		
		$this->load->view("template/header");
		$this->load->view("programadores/index",$data);
	    $this->load->view("template/footer");
	}



	public function agregar()
	{

		$data = array('tecnologias' => $this->Tecnologias_model->getTecnologias());

		$this->load->view("template/header");
		$this->load->view("programadores/agregar",$data);
	    $this->load->view("template/footer");
	}

	public function guardar()
	{
		$nombreFoto         =time().'_'.$_FILES['foto']['name'];
    	$nombreProgramador  =$this->input->post("nombre");
		$apellidos    		=$this->input->post("apellidos");
		$email        		=$this->input->post("email");
		$telefono     		=$this->input->post("telefono");
		$tecnologias  		=$this->input->post("tecnologias");

   		// Validar el archivo de imagen con una funcion callback :P
        $this->form_validation->set_rules('foto', 'Fotografía', 'callback_validar_imagen');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
		$this->form_validation->set_rules('email', 'Correo Electrónico', 'trim|required|valid_email|max_length[100]|is_unique[programadores.email]');		
		$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|numeric|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('tecnologias[]', 'Tecnologías', 'required');

		if ($this->form_validation->run() == FALSE) 
		{
		
		$data = array('tecnologias' => $this->Tecnologias_model->getTecnologias());

		$this->load->view("template/header");
		$this->load->view("programadores/agregar",$data);
	    $this->load->view("template/footer");

		}
		else
		{
				$this->upload->initialize($this->configuracion_upload_foto($nombreFoto));

			    if (!$this->upload->do_upload('foto'))
                {
                $data = array('tecnologias' => $this->Tecnologias_model->getTecnologias());
				$this->form_validation->set_message('validar_imagen', $this->upload->display_errors());
        		
				$this->load->view("template/header");
				$this->load->view("programadores/agregar",$data);
	    		$this->load->view("template/footer");
        		
        		return FALSE;
                }
                else
                {

                $this->Programador_model->guardar($nombreFoto,$nombreProgramador,$apellidos,$email,$telefono,$tecnologias);
		        redirect('programador');  
    
				}

	    }

    }
	private function configuracion_upload_foto($nombreFoto)
	{
	 
		$config = array();
	    $config['upload_path'] 		= './assets/fotos_perfil';
		$config['allowed_types'] 	= 'png|jpeg|gif|jpg';
		$config['file_ext_tolower'] = TRUE;
		$config['detect_mime']      = TRUE;
		$config['max_size'] 	    = 2048;
		$config['remove_spaces']    = TRUE;
		$config['overwrite']        = TRUE;
		$config['file_name']        = $nombreFoto;

		return $config;
	}



	public function editar($id)
	{
	    $programador           = $this->Programador_model->getProgramador($id);	    


    	if (empty($programador))
    	{
        $this->session->set_flashdata('error', 'Programador no encontrado.');
        redirect('programador'); 
    	}


	    $tecnologias_asignadas = $this->Programador_model->getTecnologiasAsignadas($id);
	    $tecnologias 		   = $this->Tecnologias_model->getTecnologias();
	    
	    $data = array(
	        'dev' => $programador,
	        'tecnologias' => $tecnologias,
	        'tecnologias_asignadas' => $tecnologias_asignadas
	    );
	    
	    $this->load->view("template/header");
	    $this->load->view("programadores/editar", $data);
	    $this->load->view("template/footer");
	}

public function actualizar($id)
{

		

//	$fotoInput     = $_FILES['foto'];
/*
	$data = array(
	'fotoInput' => $fotoInput
	);
	print_r($data);
	exit();
*/
    $nombre      	= $this->input->post('nombre');
    $apellidos   	= $this->input->post('apellidos');
    $email       	= $this->input->post('email');
    $telefono    	= $this->input->post('telefono');
    $tecnologias 	= $this->input->post('tecnologias');

    // Validar los datos del formulario
    $this->form_validation->set_rules('nombre', 'Nombre', 'required');
    $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
    $this->form_validation->set_rules('email', 'Correo Electrónico', 'required|valid_email');
    $this->form_validation->set_rules('telefono', 'Teléfono', 'required');
    $this->form_validation->set_rules('tecnologias[]', 'Tecnologías', 'required');
    
    if ($this->form_validation->run() == FALSE) 
    {
        $this->editar($id);
        return;
    }
    else
    {
				// si hay una nueva foto, actualizar el nombre(en db) y la foto(en path)
			    if (!empty($_FILES['foto']['name']))
			     {

									$nombreFoto     =time().'_'.$_FILES['foto']['name'];

						            $data = array(
						            'foto' => $nombreFoto,
						            'nombre' => $nombre,
						            'apellidos' => $apellidos,
						            'email' => $email,
						            'telefono' => $telefono
						             );


								    // Obtener el nombre de la foto 
								    $this->db->select('foto');
								    $this->db->from('programadores');
								    $this->db->where('id', $id);
								    $query = $this->db->get();

								    $foto = $query->row()->foto;

								    if ($foto && file_exists('./assets/fotos_perfil/'.$foto)) 
								    {
								        unlink('./assets/fotos_perfil/'.$foto);
								    }

			


				$this->upload->initialize($this->configuracion_upload_foto($nombreFoto));

			    if (!$this->upload->do_upload('foto'))
                {
                	
                $data = array('tecnologias' => $this->Tecnologias_model->getTecnologias());
				$this->form_validation->set_message('validar_imagen', $this->upload->display_errors());
        		
				$this->load->view("template/header");
				$this->load->view("programadores/agregar",$data);
	    		$this->load->view("template/footer");
        		
        		return FALSE;
                }
                else
                {

								    $this->Programador_model->actualizarProgramador($id,$data);
								    $this->Programador_model->actualizarTecnologias($id,$tecnologias);

								    redirect('programador');  


               }
 


			     }
			     else
			     {
			        $data = array(
			            'nombre' => $nombre,
			            'apellidos' => $apellidos,
			            'email' => $email,
			            'telefono' => $telefono
			        );
			    }

							    $this->Programador_model->actualizarProgramador($id,$data);

							    $this->Programador_model->actualizarTecnologias($id,$tecnologias);

							    redirect('programador');  
 	
    }	

}


	public function eliminar($id)
	{
		$resultado = $this->Programador_model->eliminar($id);

		if ($resultado) {
			redirect(base_url("programador"));
		}
	}


	public function validar_imagen()
	{


	    if (empty($_FILES['foto']['name'])) {
	        $this->form_validation->set_message('validar_imagen', 'Por favor, seleccione una imagen.');
	        return FALSE;
	    }

	    return TRUE;
	}



}

/* End of file Programador.php */
/* Location: ./application/controllers/Programador.php */