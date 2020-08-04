<?php 
class tarefa extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this -> load -> database();
		date_default_timezone_set("America/Recife");
	}
	public function buscarTarefaPeloId($id){
		$result = $this -> db -> get_where("tarefa", array("id_tarefa" => $id));
		return $result;
	}
	public function verificarPermissaoDeUsuario($id_tarefa,$id_usuario){
		$result = $this -> db -> get_where("tarefa", array("usuario" => $id_usuario,'id_tarefa' => $id_tarefa));
		return $result;
	}
	public function buscarTarefaPorUsuario($id){
		$result = $this -> db -> get_where("tarefa", array("usuario" => $id));
		return $result;
	}
	public function cadastrarTarefa($titulo,$descricao = null,$id_usuario){
		$now = new DateTime();
		$timestamp = $now -> format("Y/m/d H:i:s")
		$data = array("usuario" => $id_usuario, "titulo" => $titulo, "descricao" => $descricao, "inicio" => $timestamp);
		$result = $this -> db -> insert('tarefa',$data);
		return $result;
	}
	public function apagarTareafa($id_tarefa,$id_usuario){
		$busca = $this -> buscartarefaPorId($id_tarefa);
		if($busca -> num_rows() > 0){
			return  $this->db->delete('tarefa', array('id_tarefa' => $id_tarefa,'usuario' => $id_usuario));
		}
		else{
			return false;
		}
	}
	public function alterarTarefa($id_tarefa, $id_usuario, $titulo, $descricao = null){
		if($this -> verificarPermissaoDeUsuario($id_tarefa,$id_usuario) -> num_rows() == 0){
			$result = false;
		}else{
			$data = array('titulo' => $titulo, 'descricao' => $descricao);
			$this -> db -> where(array('id_tarefa' => $id_tarefa, 'usuario' => $id_usuario));
			$result = $this ->  db -> update('tarefa', $data);
		}
		return $result;
	}
}