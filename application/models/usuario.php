<?php 
class usuario extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this -> load -> database();
	}
	public function buscarUsuarioPeloLogin($login){
		$result = $this -> db -> get_where("usuario", array("login" => $login));
		return $result;
	}
	public function buscarUsuario($login,$senha){
		$busca = array('login' => $login, 'senha' => md5($senha));
		$result = $this -> db -> get_where('usuario',$busca);
		return $result;
	}
	public function buscarUsuarioPorId($id, $senha){
		$result = $this -> db -> get_where('usuario', array('id' => $id, 'senha' => md5($senha)));
		return $result;
	}
	public function cadastrarUsuario($login,$senha){
		$data = array("login" => $login, "senha" => md5($senha));
		if($this -> buscarUsuarioPeloLogin($login) -> num_rows() > 0){
			$result = false;
		}else{
			$result = $this -> db -> insert('usuario',$data);
		}
		return $result;
	}
	public function apagarConta($id,$senha){
		$busca = $this -> buscarUsuarioPorId($id,$senha);
		if($busca){
			return  $this->db->delete('usuario', array('id' => $id));
		}
		else{
			return false;
		}
	}
}