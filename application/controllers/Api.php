<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("America/Mexico_City");
        header('Content-Type: application/json');
        $this->load->database(); 

        define('API_KEY', 'raulparedesTokenApi7321');
    }

    private function validate_api_key()
    {
        $apiKey = $this->input->get_request_header('Authorization');

        if (!$apiKey || strpos($apiKey, 'Bearer ') !== 0 || trim(substr($apiKey, 7)) !== API_KEY) 
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Acceso a la agenda NO Autorizado. API KEY Invalida.'
            ]);
            return false;
        }

        return true;
    }

    // METODO 1  *GET*  .../agenda/ (Todos los registros)
    public function agenda()
    {
        if (!$this->validate_api_key())
        {
            return;
        }

        // cnsulta programadores con sus tecnologias
        $query = $this->db->query("
            SELECT p.id, p.nombre, p.apellidos, p.telefono, p.email, p.fecha_alta,
                   GROUP_CONCAT(t.tecnologia ORDER BY t.tecnologia SEPARATOR ', ') as tecnologias
            FROM programadores p
            LEFT JOIN tecnologias_programador tp ON p.id = tp.programador_id
            LEFT JOIN tecnologias t ON tp.tecnologia_id = t.id
            GROUP BY p.id
        ");

        $result = $query->result_array();

        echo json_encode([
            'status' => 'success',
            'data' => $result
        ]);
    }

    // METODO 2  *GET*  .../agenda_tech/ (Filtrar por Tecnologia)
    public function agenda_tech($technology = null)
    {
        if (!$this->validate_api_key())
        {
            return; // sale de la funcion
        }

        if ($technology)
         {
            $query = $this->db->query("
                SELECT p.id, p.nombre, p.apellidos, p.telefono, p.email, p.fecha_alta,
                       GROUP_CONCAT(t.tecnologia ORDER BY t.tecnologia SEPARATOR ', ') as tecnologias
                FROM programadores p
                LEFT JOIN tecnologias_programador tp ON p.id = tp.programador_id
                LEFT JOIN tecnologias t ON tp.tecnologia_id = t.id
                WHERE t.tecnologia = ?
                GROUP BY p.id
            ", [$technology]);

            $result = $query->result_array();

            if (empty($result))
            {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No Hay programadores con la Tecnologia Solicitada.'
                ]);
            }
            else
            {
                echo json_encode([
                    'status' => 'success',
                    'data' => $result
                ]);
            }
        } 
        else
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tiene que especificar alguna tecnologia.'
            ]);
        }
    }
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */
