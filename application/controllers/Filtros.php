<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Filtros extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Mexico_City");
        $this->load->model("Tecnologias_model");        
        $this->load->model("Filtros_model");
    }

    public function getTecno()
    {
        $data = array('tecnologias' => $this->Tecnologias_model->getTecnologias());
        $this->load->view("programadores/filtros_modal", $data);        
    }

    public function fitrar()
    {

        $desde = $this->input->post('desde');
        $hasta = $this->input->post('hasta');
        $tecnologias = $this->input->post('tecnologias');
        
        if (empty($tecnologias) && empty($desde) && empty($hasta))
        {
            echo json_encode(['status' => 'error', 'message' => 'Debe seleccionar al menos un filtro (tecnologia o rango de fechas).']);
            return;
        }

        if (!empty($tecnologias) && !empty($desde) && !empty($hasta))
        {
            $query = $this->Filtros_model->tecnologiasYrangoDeFechas($tecnologias, $desde, $hasta);
        }
        elseif (empty($tecnologias) && !empty($desde) && !empty($hasta))
        {
            $query = $this->Filtros_model->soloRangoDeFechas($desde, $hasta);
        }
        elseif (!empty($tecnologias) && empty($desde) && empty($hasta)) 
        {
            $query = $this->Filtros_model->soloTecnologias($tecnologias);
        }
        elseif (!empty($desde) && empty($hasta)) 
        {
            $query = $this->Filtros_model->soloRangoDeFechas($desde, null);
        }
        elseif (empty($desde) && !empty($hasta)) 
        {
            $query = $this->Filtros_model->soloRangoDeFechas(null, $hasta);
        }
        
        if (empty($query)) 
        {
            echo json_encode(['status' => 'error', 'message' => 'No se encontraron resultados']);
        }
        else
        {
            header('Content-Type: application/json');
            echo json_encode($query); 
        }
    }
}

/* End of file filtros.php */
/* Location: ./application/controllers/Filtros.php */
