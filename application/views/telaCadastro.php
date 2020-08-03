<?php 
	if($this -> session -> flashdata("CAD001 - Não foi possível cadastrar")){
		echo "<script> Swal.fire('O Usuário informado já existe','Digite um novo nome de usuário ou acesse sua conta na página de login','error')</script>" ;
	}
?>
<div class="container" style="margin-left: 30%; margin-top: 10%">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title" align="center"> Cadastre-se </h5>
					<form> 
						<div class="form-group">
							<input required type="text" name="login" id="login" class="form-control" placeholder="Nome de usuário">
						</div>
						<div class="form-group">
							<input required type="password" name="senha" id='senha' class="form-control" placeholder="Senha">
						</div>
						<div class="form-group">
							<input required type="password" name="confirmarSenha" id='confirmarSenha' class="form-control" placeholder="Confirme sua senha">
						</div>
						<div class="form-group">
							<a  id="linkLogin" href= <?php echo "'".base_url('login')."'"; ?> > Já possui uma conta? Acesse sua conta </a>
						</div>
						
						<button type="button" id="btnCadastro" name="btnCadastro" class="btn btn-info form-group"> Cadastrar </button>

					</form>
				</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#btnCadastro").click(function(){
		var login = $("#login")[0].value
		var senha = $("#senha")[0].value
		var confirmasenha = $("#confirmarSenha")[0].value
		if(senha == confirmasenha){
			$.post(<?php echo "'".base_url("cadastrar")."'";?>, {"login":login, "senha":senha}, function(data){
				if(data){
					console.log(data)
					window.location.href = data
				}else{

				}
			})
		}else{
			alert("não bateu")
		}
	})
</script>