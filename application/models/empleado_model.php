<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleado_model extends CI_Model{

	//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

/*		function listar() {
			$query = $this->db->get("empleado");
			return $query->result();
	}*/
	function listar() {
		$this->db->select('*');
		$this->db->join('monto', 'monto.id_monto = empleado.id_monto');
		$query = $this->db->get('empleado');
		return $query->result();
	}

	function dar_baja($id) {
		$inactivo = array('status' => '0');
		$this->db->where("id_Empleado", $id);
		return $this->db->update("empleado",$inactivo);
	}

	function dar_alta($id) {
		$activo = array ('status' => '1');
		$this->db->where("id_Empleado", $id);
		return $this->db->update("empleado",$activo);
	}

	function ver_status($id) {
		$sql = "SELECT status
				FROM 	empleado
				Where id_Empleado = $id
				LIMIT 1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['status'];
	}

	function update_residente($id, $data) {
		$this->db->where("id_Empleado", $id);
		return $this->db->update("empleado", $data);
	}
}
