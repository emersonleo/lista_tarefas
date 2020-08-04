
<div class="container">
	<div class="row">
		<div class="card"> 
			<div class="card-body">
				<input type="text" name="titulo" id="titulo" placeholder="Título da tarefa" class="form-control row">
				<textarea id="descricao" name="descricao" placeholder="Descreva melhor sua tarefa aqui..." class="form-control "> </textarea>
				<button type="button" id="btnAdicionarTarefa" class="btn btn-info"> Adicionar </button>
			</div>
		</div>
		<div class="container" id="divTarefas">
			
		</div>
	</div>
</div>


<script type="text/javascript">
	$('#btnSair').click(function(){
		window.location.href = <?php echo '"'.base_url('sair').'"'; ?>
	})
	$("#btnDelete").click(function(){
		Swal.fire({
		  icon: 'error',
		  title: 'Deseja excluir sua conta?',
		  text: 'Confirme sua senha para prosseguir com a exclusão',
		  input: 'password',
		  showConfirmButton: true,
		  confirmButtonText: "Continuar",
		  confirmButtonColor: "#d33",
		  showCancelButton: true,
		  cancelButtonText: "Voltar",
		  cancelButtonColor: "#3085d6",
		}).then((result) => {
		  if(result.value){
		   	$.post(<?php echo "'".base_url("excluir")."'";?>,{"senha":result.value},function(data){
		   		if(data == false){
		   			Swal.fire('Não foi possível prosseguir com a exclusão', 'Certifique-se que a senha digite está correta e tente novamente','error');
		   		}
		   		else{
					window.location.href = data	   			
		   		}
		   	})
		  }
		})
	})
</script>