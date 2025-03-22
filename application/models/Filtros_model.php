<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filtros_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
public function soloTecnologias($tecnologias)
{
    $this->db->select('programadores.*, GROUP_CONCAT(tecnologias.tecnologia ORDER BY tecnologias.tecnologia ASC) as tecnologias');
    $this->db->from('programadores');
    $this->db->join('tecnologias_programador', 'tecnologias_programador.programador_id = programadores.id', 'inner');
    $this->db->join('tecnologias', 'tecnologias.id = tecnologias_programador.tecnologia_id', 'inner');

    if (!empty($tecnologias)) {
        $this->db->where_in('tecnologias_programador.tecnologia_id', $tecnologias);
    }

    $this->db->group_by('programadores.id');  

    $query = $this->db->get();

    return $query->result();
}

public function tecnologiasYrangoDeFechas($tecnologias, $desde, $hasta)
{
    $this->db->select('programadores.*, GROUP_CONCAT(tecnologias.tecnologia ORDER BY tecnologias.tecnologia ASC) as tecnologias');
    $this->db->from('programadores');
    $this->db->join('tecnologias_programador', 'tecnologias_programador.programador_id = programadores.id', 'inner');
    $this->db->join('tecnologias', 'tecnologias.id = tecnologias_programador.tecnologia_id', 'inner');

    if (!empty($tecnologias)) {
        $this->db->where_in('tecnologias_programador.tecnologia_id', $tecnologias);
    }

    $this->db->where('programadores.fecha_alta >=', $desde . ' 00:00:00');
    $this->db->where('programadores.fecha_alta <=', $hasta . ' 23:59:59');

    $this->db->group_by('programadores.id');  

    $query = $this->db->get();

    return $query->result();
}


public function soloRangoDeFechas($desde, $hasta)
{
    $this->db->select('p.id, p.nombre, p.apellidos, p.telefono, p.email, p.foto, p.fecha_alta, p.status');
    $this->db->from('programadores p');
    $this->db->where('p.fecha_alta >=', $desde);
    $this->db->where('p.fecha_alta <=', $hasta);
    $this->db->join('tecnologias_programador tp', 'tp.programador_id = p.id', 'left');
    $this->db->join('tecnologias t', 't.id = tp.tecnologia_id', 'left');
    $this->db->group_by('p.id');

    $this->db->select("GROUP_CONCAT(t.tecnologia SEPARATOR ', ') as tecnologias");

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result_array(); 
    } else {
        return []; 
    }
}



}

/* End of file Filtros_model.php */
/* Location: ./application/models/Filtros_model.php */