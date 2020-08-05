<?php 
	if($this -> session -> flashdata("ALT000 - Senha alterada")){
		echo "<script> Swal.fire('Senha alterada com sucesso','Você já pode utilizar sua nova senha no próximo acesso','success')</script>" ;
	}elseif($this -> session -> flashdata("ALT001 - Login alterado")){
		echo "<script> Swal.fire('Login alterado com sucesso','Você já pode utilizar seu novo login no próximo acesso','success')</script>" ;
	}
?>


<div id="container" class="container" style="width: 35%; margin-top: 10%">
		<div id='divButtons' class="container" align="center">
				<button class="btn btn-warning row" id='btnLogin' style="margin: 10px"> Alterar Login </button>
			
				<button class="btn btn-warning row " id='btnSenha' style="margin: 10px"> Alterar Senha </button>
		</div>
		<div id="alterarLogin"> 
			<input type="text" id='novoLogin' name="novoLogin" placeholder="Digite seu novo Login"  class="form-control" required style="margin-bottom: 5px">
		</div>
		<input type="password" id='senha' name="senha" placeholder="Digite sua senha atual"  class="form-control"required style="margin-bottom: 5px">
		<div id="alterarSenha">
			<input type="password" id='novaSenha' name="novaSenha" placeholder="Digite sua nova senha"  class="form-control"required style="margin-bottom: 5px">
			<input type="password" id='confirmarSenha' name="confirmarSenha" placeholder="Confirme sua nova senha"  class="form-control" required style="margin-bottom:  5px">
		</div>
		<div id='divConfirmar'>
			<button type="submit" id="btnConfirmar" class="btn btn-success" > Confirmar </button>
			<button type="button" id="btnVoltar"class="btn btn-info"> Voltar </button>
		</div>
</div>
</html>
<script type="text/javascript">
	$(function(){
		var opcao = null
		$('divButtons').show()
		$('#alterarLogin').hide()
		$('#alterarSenha').hide()
		$('#senha').hide()
		$('#divConfirmar').hide()
	})
	$('#btnLogin').click(function(data){
		opcao = "login"
		$('#divConfirmar').show()
		$('#senha').show()
		$('#alterarLogin').show()
		$('#alterarSenha').hide()
		$('#divButtons').hide()
	})
	$('#btnSenha').click(function(data){
		opcao = "senha"
		$('#divConfirmar').show()
		$('#senha').show()
		$('#alterarLogin').hide()
		$('#alterarSenha').show()
		$('#divButtons').hide()
	})
	$("#btnConfirmar").click(function(data){
		if(opcao == "login"){
			var login = $("#novoLogin")[0].value
			var senha = $('#senha')[0].value
			$.post(<?php echo "'".base_url('trocarlogin')."'"; ?>,{"login":login, "senha":senha}, function(data){
				if(data){
					window.location.href = data; 
				}
				else{
					Swal.fire(
					  'Não foi possível alterar sua senha',
					  'O login digitado já existe, tente novamente com outro ',
					  'error'
					)
				}
			})
		}
		else if(opcao == "senha" ){
			var novaSenha = $("#novaSenha")[0].value
			var senha = $('#senha')[0].value
			var confirmarSenha = $("#confirmarSenha")[0].value

			if(novaSenha != confirmarSenha){
				console.log(novaSenha + "-----" + senha)
				Swal.fire(
				  'Senhas diferentes',
				  'Os dados digitados na senha e confirmação de senha não são iguais',
				  'error'
				)
			}else{
				$.post(<?php echo "'".base_url('trocarsenha')."'"; ?>,{"novasenha":novaSenha, "senha":senha}, function(data){
					if(data){
						window.location.href = data
					}else{
						Swal.fire(
						  'Não foi possível alterar a senha',
						  'Certifique-se que a senha digite está correta e tente novamente',
						  'error'
						)
					}
				})
			}
		}

	})
	$("#btnVoltar").click(function(data){
		window.location.href =<?php echo "'".base_url('alterar')."'"; ?>	
	})
</script>