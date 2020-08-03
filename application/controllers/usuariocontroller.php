<?php 

class usuariocontroller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this -> load -> model('usuario');
	}
	public function acessar(){
		$login = $_POST["login"];
		$senha = $_POST['senha'];
		$result = $this -> usuario -> buscarUsuario($login,$senha);
		if($result){
			$this -> session -> set_userdata("usuario_autorizado",$result -> row_array());
			$this -> output -> set_output(base_url('inicio'));
		}else{
			$this -> session -> set_flashdata("LOG001 - Usuário não localizado", true);
			$this -> output -> set_output(base_url('login'));
		}
	}
	public function cadastrar(){
		$login = $_POST["login"];
		$senha = $_POST["senha"];
		$result = $this -> usuario -> cadastrarUsuario($login,$senha);
		if($result == null){
			$this -> session -> set_flashdata("CAD001 - Não foi possível cadastrar", true);
			$this -> output -> set_output(base_url('cadastro'));
		}else{
			$this -> session -> set_flashdata("CAD000 - Usuário cadastrado com sucesso", true);
			$this -> output -> set_output(base_url('login'));
		}
	}
	public function sair(){
		$this -> session -> set_userdata("usuario_autorizado",null);
		$this -> session -> set_flashdata("LOG001 - Usuário não localizado", null);
		$this -> session -> set_flashdata("CAD001 - Não foi possível cadastrar", null);
		$this -> session -> set_flashdata("CAD000 - Usuário cadastrado com sucesso", null);
		$this -> output -> set_output(base_url('login'));
	}
}