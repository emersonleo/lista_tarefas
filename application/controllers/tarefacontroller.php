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
			$this -> output -> set_output(base_url('telainicial'));
		}
	}
	public function listarTarefasConcluidas(){
		$id = $this -> session -> userdata('usuario_autorizado') -> id_usuario;
		$result = $this -> tarefa -> buscarTarefasConcluidasPorUsuario($id);
		$this -> output -> set_output(json_encode($result));
	}
	public function listarTarefas(){
		$id = $this -> session -> userdata('usuario_autorizado') -> id_usuario;
		$result = $this -> tarefa -> buscarTarefaPorUsuario($id);
		$this -> output -> set_output(json_encode($result));
	}
	public function concluirTarefa(){
		$id_usuario = $this -> session -> userdata('usuario_autorizado') -> id_usuario;
		$id_tarefa  = $_POST['tarefa'];
		$result = $this -> tarefa -> concluirTarefa($id_tarefa,$id_usuario);
		if($result){
			$this -> output -> set_output(true);
		}else{
			$this -> output -> set_output(false);
		}
	}
	public function excluirTarefa(){
		$id_usuario = $this -> session -> userdata('usuario_autorizado') -> id_usuario;
		$id_tarefa  = $_POST['tarefa'];
		$result = $this -> tarefa -> excluirTarefa($id_tarefa,$id_usuario);
		if($result){
			$this -> session -> set_flashdata("ETAR001 - excluída com sucesso", true);
			$this -> output -> set_output(base_url("inicial"));
		}else{
			$this -> session -> set_flashdata("ETAR000 - houve algum erro", true);
			$this -> output -> set_output(base_url("inicial"));
		}
	}
	public function alterarTarefa(){
		$id_usuario = $this -> session -> userdata('usuario_autorizado') -> id_usuario;
		$id_tarefa = $_POST['id_tarefa'];
		$novoTitulo = $_POST['novoTitulo'];
		$novaDescricao = $_POST['novaDescricao'];
		$result = $this -> tarefa -> alterarTarefa($id_tarefa,$id_usuario,$novoTitulo,$novaDescricao);
		if($result){
			$this -> session -> set_flashdata("ALTTAR000 - Tarefa alterada com sucesso", true);
			$this -> output -> set_output(true);
		}else{
			$this -> session -> set_flashdata("ALTTAR001 - Ocorreu um erro", true);
			$this -> output -> set_output(false);
		}
	}
}