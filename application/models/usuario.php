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
		if($result -> num_rows() > 0){
			$retorno = $result;
		}
		else{
			$retorno = false;
		}
		return $retorno;
	}
	public function buscarUsuarioPorId($id, $senha){
		$result = $this -> db -> get_where('usuario', array('id_usuario' => $id, 'senha' => md5($senha)));
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
		if($busca -> num_rows() > 0){
			return  $this->db->delete('usuario', array('id_usuario' => $id));
		}
		else{
			return false;
		}
	}
	public function alterarLogin($login, $senha, $id_usuario){
		if($this -> buscarUsuarioPeloLogin($login) -> num_rows() > 0){
			$result = false;
		}else{
			$this -> db -> where(array('id_usuario' => $id_usuario, 'senha' => md5($senha)));
			$result = $this ->  db -> update('usuario', array('login' => $login));
		}
		return $result;
	}
	public function alterarSenha($senhaAntiga, $senhaNova, $id_usuario){
		$this -> db -> where(array('id_usuario' => $id_usuario, 'senha' => md5($senhaAntiga)));
		$result = $this ->  db -> update('usuario', array('senha' => md5($senhaNova)));
		if($this -> db -> affected_rows() > 0){
			$retorno = true;
		}else{
			$retorno = false;
		}
		return $retorno;
	}
}