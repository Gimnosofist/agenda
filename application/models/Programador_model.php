<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programador_model extends CI_Model {

/*
	public function getProgramadores()
	{
		$this->db->select("*");
		$this->db->from("programadores");
		$resultado = $this->db->get();
		return $resultado->result();
	}
*/

	public function getProgramadores()
{
    $this->db->select("programadores.id, programadores.foto, programadores.nombre, programadores.apellidos, programadores.email, GROUP_CONCAT(tecnologias.tecnologia SEPARATOR ', ') as tecnologias");
    $this->db->from("programadores");
    $this->db->join("tecnologias_programador", "tecnologias_programador.programador_id = programadores.id", "left");
    $this->db->join("tecnologias", "tecnologias.id = tecnologias_programador.tecnologia_id", "left");
    $this->db->group_by("programadores.id");
    
    $resultado = $this->db->get();
    return $resultado->result();
}

public function getProgramador($id)
{
    $this->db->select('*');
    $this->db->from('programadores');
    $this->db->where('id', $id);
    $resultado = $this->db->get();
    return $resultado->row();
}

public function getTecnologiasAsignadas($id)
{
    $this->db->select('tecnologia_id');
    $this->db->from('tecnologias_programador');
    $this->db->where('programador_id', $id);
    $resultado = $this->db->get();
    $tecnologias = $resultado->result();
    $tecnologias_ids = [];
    foreach ($tecnologias as $tecno) {
        $tecnologias_ids[] = $tecno->tecnologia_id;
    }
    return $tecnologias_ids;
}


public function guardar($nombreFoto, $nombre, $apellidos, $email, $telefono, $tecnologias)
{
    $data = array(
        'foto'      => $nombreFoto,
        'nombre'    => $nombre,
        'apellidos' => $apellidos,
        'telefono'  => $telefono,
        'email'     => $email,
        'fecha_alta'=> date("Y-m-d H:i:s")
    );

    $this->db->insert('programadores', $data);
    $id = $this->db->insert_id();  // Obtener el ID insertado

    if ($id) 
    {
        if (is_array($tecnologias)) 
        {
            foreach ($tecnologias as $tecnologia) 
            {
                $data_tecnologia = array(
                    'programador_id' => $id,
                    'tecnologia_id' => $tecnologia
                );
                $this->db->insert('tecnologias_programador', $data_tecnologia);
            }
        }
        return $id;
    }
    else 
    {
        return false;
    }
}


public function actualizarProgramador($id, $data)
{
    
    // Actualizar los datos del programador
    $this->db->where('id', $id);
    $this->db->update('programadores', $data);
    //redirect(base_url('programador'));
}

public function actualizarTecnologias($id,$tecnologias)
{
    $this->db->where('programador_id', $id);
    $this->db->delete('tecnologias_programador');

    if (is_array($tecnologias)) 
    {
        foreach ($tecnologias as $tecnologia_id)
         {
            $data_tecnologia = array(
                'programador_id' => $id,
                'tecnologia_id' => $tecnologia_id
            );
            $this->db->insert('tecnologias_programador', $data_tecnologia);
        }
    }
}

public function eliminar($id)
{
    $this->db->select('foto');
    $this->db->from('programadores');
    $this->db->where('id', $id);
    $query = $this->db->get();

    $foto = $query->row()->foto; // Obtener el nombre del archivo de la foto

    if ($foto && file_exists('./assets/fotos_perfil/' . $foto)) 
    {
        unlink('./assets/fotos_perfil/' . $foto); // Eliminar el archivo de la foto
    }

    $this->db->where("id", $id);
    $this->db->delete("programadores");

    $this->db->where('programador_id', $id);
    $this->db->delete('tecnologias_programador');
    $this->session->set_flashdata("error",'¡Programador Eliminado!');
    redirect('programador','refresh');
}

}

/* End of file Programadores_model.php */
/* Location: ./application/models/Programadores_model.php */