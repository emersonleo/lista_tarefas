<?php 
if($this -> session -> flashdata("CTAR001 - Não foi possível cadastrar")){
	echo "<script> Swal.fire('Não foi possível cadastrar','Ocorreu um erro inesperado durante o cadastro da tarefa, por favor tente novamente','error') </script>" ;
}elseif($this -> session -> flashdata("CTAR000 - Tarefa cadastrada com sucesso")){
	echo "<script> Swal.fire('title': 'Tarefa cadastrada com sucesso','icon':'success')</script>" ;
}

?>
<div class="container">
	<div class="row">
		<div class="card col-md-6" style="margin: 10px; margin-left: 23%"> 
			<div class="card-body">
				<div class="form-group">
					<input type="text" name="titulo" id="titulo" placeholder="Título da tarefa" class="form-control col-md-12" required>
				</div>
				<div class="form-group">
					<textarea id="descricao" name="descricao" placeholder="Descreva melhor sua tarefa aqui..." class="form-control col-md-12"></textarea required>
				</div>
				<div class="form-group">
					<button type="submit" id="btnAdicionarTarefa" name="btnAdicionarTarefa" class="btn btn-info"> Adicionar </button>
				</div>
			</div>
		</div>
		<div class="container col-md-12" id="divCards" name="divCards">
			
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$.post(<?php echo "'".base_url("listartarefas")."'";?>,{},function(data){
		var jsonData = JSON.parse(data)
		construirCards(jsonData)
	})
})
function clickHandlerAlterar(idTarefa){
	var descricao = $("#descricao")[0].value
	var titulo = $("#titulo")[0].value
	var inputHTML = '<input type="text" name="novoTitulo" id="novoTitulo" placeholder="Se deseja alterar o título, insira aqui seu novo título" class="form-control col-md-12" style="margin-bottom:10px">'
	var textareaHTML = '<textarea id="novaDescricao" name="novaDescricao" placeholder="Se deseja alterar a descrição, insira aqui sua nova descrição" class="form-control col-md-12">'+ descricao +'</textarea required>'
	Swal.fire({
		  icon: 'error',
		  title: 'Deseja alterar essa tarefa?',
		  html: inputHTML + textareaHTML,
		  showConfirmButton: true,
		  confirmButtonText: "Alterar",
		  confirmButtonColor: "#d33",
		  showCancelButton: true,
		  cancelButtonText: "Cancelar",
		  cancelButtonColor: "#3085d6",
	}).then((result) => {
		var novaDescricao = document.getElementById('novaDescricao').value
		var novoTitulo = document.getElementById('novoTitulo').value
		if(novoTitulo == "" && novaDescricao == ""){
			
		}else{
			$.post(<?php echo "'".base_url('alterartarefa')."'";?>, {"novaDescricao":novaDescricao, "novoTitulo":novoTitulo, "id_tarefa":idTarefa}, function(data){
					if(data){
						window.location.reload(true)
					}
			})
		}

	})

}
function clickHandlerApagar(idTarefa){
	$.post(<?php echo "'".base_url('excluirtarefa')."'";?>, {"tarefa":idTarefa}, function(data){
		if (data){
			window.location.reload(true)
		}
	})
}
function clickHandlerConcluir(idTarefa){
	$.post(<?php echo "'".base_url('concluirtarefa')."'";?>, {"tarefa":idTarefa}, function(data){
		if (data){
			window.location.reload(true)	
		}
	})
}
function construirCards(jsonData){
	var tamanhoJSON = jsonData.length
	var descricao = ""
	var titulo = ""
	var id_tarefa = ""
	var dataInicio = ""
	var strCards = ""
	for(var i = 0; i < tamanhoJSON; i++){
		var data = jsonData[i].inicio.split("-")
		var dia = data[2][0] + data[2][1]
		var mes = data[1]
		var ano = data[0]
		var dataF = dia + "/" + mes + "/" + ano
		var buttonAlterar = '<button onclick="clickHandlerAlterar('+ jsonData[i].id_tarefa +  ')"  style="margin-right:5px" type="button" class="btn btn-info"> Alterar </button>'
		var buttonConcluir = '<button onclick=clickHandlerConcluir('+ jsonData[i].id_tarefa + ') type="button" class="btn btn-success" style="margin-right:5px"> Concluir </button>'
		var buttonApagar = '<button onclick=clickHandlerApagar('+ jsonData[i].id_tarefa + ') class="btn btn-danger" type="button" > Excluir </button>'
		strCards += '<div class="card" style="margin:10px"> <div class="card-body"> <h5 class="card-title"> Título: ' + jsonData[i].titulo +'</h5> <p class="h6"> Descrição: ' + jsonData[i].descricao +'</p> <p class="h6 info"> Início: ' + dataF + '</p>' + buttonAlterar +  buttonConcluir + buttonApagar + '</div> </div>'
	}
	if(tamanhoJSON == 0){
		$("#divCards")[0].innerHTML = '<div class="card"> <div class="card-body" style:"justify-content:center;"> <h4 class="card-title"> Você não possui tarefas a realizar </h4> </div> </div>'
	}else{
		$("#divCards")[0].innerHTML = strCards
	}

}
$("#btnAdicionarTarefa").click(function(){
	var titulo = $("#titulo")[0].value
	var descricao = $("#descricao")[0].value
	console.log(titulo)
	if(titulo == ""){
			Swal.fire(
			  'Título vazio',
			  'Não é possível cadastrar tarefa sem um título',
			  'error'
			)
	}else{
		$.post(<?php echo "'".base_url("criartarefa")."'";?>,{"titulo":titulo,"descricao":descricao},function(data){
			if(data){
				window.location.reload(true)
			}
		})
	}
})

</script>