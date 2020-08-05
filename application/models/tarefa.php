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
		$this -> db -> order_by("inicio","DESC");
		$result = $this -> db -> get_where("tarefa", array("usuario" => $id,"status" => 1));
		return $result -> result();
	}
	public function buscarTarefasConcluidasPorUsuario($id){
		$this -> db -> order_by("termino","DESC");
		$result = $this -> db -> get_where("tarefa", array("usuario" => $id,"status" => 0));
		return $result -> result();
	}
	public function cadastrarTarefa($titulo,$descricao = null,$id_usuario){
		$now = new DateTime();
		$timestamp = $now -> format("Y/m/d H:i:s");
		$data = array("usuario" => $id_usuario, "titulo" => $titulo, "descricao" => $descricao, "inicio" => $timestamp,"status" => 1, "termino" => "");
		$result = $this -> db -> insert('tarefa',$data);
		return $result;
	}
	public function excluirTarefa($id_tarefa,$id_usuario){
		$busca = $this -> buscarTarefaPeloId($id_tarefa);
		if($busca -> num_rows() > 0){
			return  $this->db->delete('tarefa', array('id_tarefa' => $id_tarefa,'usuario' => $id_usuario));
		}
		else{
			return false;
		}
	}
	public function alterarTarefa($id_tarefa, $id_usuario, $titulo, $descricao){
		if($this -> verificarPermissaoDeUsuario($id_tarefa,$id_usuario) -> num_rows() == 0){
			$retorno = false;
		}else{
			if($titulo == ""){
				$data = array('descricao' => $descricao);
			}elseif($descricao == ""){
				$data = array('titulo' => $titulo);
			}elseif($titulo != "" and descricao != ""){
				$data = array('titulo' => $titulo,'descricao' => $descricao);
			}
			$this -> db -> where(array('id_tarefa' => $id_tarefa, 'usuario' => $id_usuario));
			$result = $this ->  db -> update('tarefa', $data);
			if($this -> db -> affected_rows() > 0){
				$retorno = true;
			}else{
				$retorno = false;
			}
		}
		return $retorno;
	}
	public function concluirTarefa($id_tarefa, $id_usuario){
		if($this -> verificarPermissaoDeUsuario($id_tarefa,$id_usuario) -> num_rows() == 0){
			$retorno = false;
		}else{
			$now = new DateTime();
			$timestamp = $now -> format("Y/m/d H:i:s");
			$data = array('termino' => $timestamp, 'status' => 0);
			$this -> db -> where(array('id_tarefa' => $id_tarefa, 'usuario' => $id_usuario));
			$result = $this ->  db -> update('tarefa', $data);
			if($this -> db -> affected_rows() > 0){
				$retorno = true;
			}else{
				$retorno = false;
			}
		}
		return $retorno;
	}
}