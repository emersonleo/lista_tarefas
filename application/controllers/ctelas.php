<?php 

class ctelas extends CI_Controller{
	
	public function index(){

	}
	public function telaLogin(){
		$data = array('title' => "Lista de Tarefas", "lang" => '"pt-br"');
		$this -> load -> view("header",$data);
		$this -> load -> view("telalogin");
		$this -> load -> view("footer");
	}
}