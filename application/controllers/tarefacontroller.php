<?php 
/**
 * 
 */
class tarefacontroller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this -> load -> model('tarefa');
	}
	public function criarTarefa(){
		$titulo = $_POST["titulo"];
		$descricao = $_POST["descricao"];
		$id = $this -> session -> userdata('usuario_autorizado') -> id_usuario;
		$result = $this -> tarefa -> cadastrarTarefa($titulo,$descricao,$id);
		if($result == null){
			$this -> session -> set_flashdata("CTAR001 - Não foi possível cadastrar", true);
			$this -> output -> set_output(true);
		}else{
			$this -> session -> set_flashdata("CTAR000 - Tarefa cadastrada com sucesso", true);
			$this -> output -> set_output(true);
		}
	}
	public function listarTarefas(){
		$id = $this -> session -> userdata('usuario_autorizado') -> id_usuario;
		$result = $this -> tarefa -> buscarTarefaPorUsuario($id);
		$this -> output -> set_output(json_encode($result));
	}
	public function alterarTarefa(){
		$id_usuario = $this -> session -> userdata('usuario_autorizado') -> id_usuario;
		$id_tarefa  = $_POST['tarefa'];
	}
}