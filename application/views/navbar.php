<header>
 		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		    	<div class="navbar-nav" align="center">
		    		<ul class="navbar-nav">
				    	<li class="nav-item">
				    		<a class="nav-item nav-link" href=<?php echo '"'.base_url('inicio').'"';?>>Inicio</a>
				    	</li>
				    	<li class="nav-item dropdown">
					    	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					          Conta
					        </a>
					        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					          <a class="dropdown-item" href=<?php echo '"'.base_url('alterar').'"';?> >Alterar Conta</a>
					          <a class="dropdown-item" id="btnDelete">Excluir Conta</a>
					        </div>
				    	</li>
				    	<li class="nav-item">
		    				<a class="nav-item nav-link " href=<?php echo "'".base_url('concluidas')."'"; ?> > Tarefas concluídas </a>
		    			</li>
				    	<li class="nav-item">
		    				<button id='btnSair' name="btnSair" class="btn btn-outline-danger form-inline"> Sair </button>
		    			</li>
					</ul>
				</div>
			</div>
			</nav>
</header>
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