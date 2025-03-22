<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tecnologias_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}


	public function getTecnologias()
	{
		$this->db->select("*");
		$this->db->from("tecnologias");
		$query = $this->db->get();
		return $query->result();
	}


}

/* End of file Tecnologias_model.php */
/* Location: ./application/models/Tecnologias_model.php */