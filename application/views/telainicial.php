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

}
function clickHandlerApagar(idTarefa){

}
function clickHandlerConcluir(idTarefa){

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
		strCards += '<div class="card" style="margin:10px"> <div class="card-body"> <h5 class="card-title">' + jsonData[i].titulo +'</h5> <p class="h6">' + jsonData[i].descricao +'</p> <p class="h6 info">' + dataF + '</p> </button> <button  style="margin-right:5px" type="button" class="btn btn-info"> Alterar </button><button type="button" class="btn btn-success" style="margin:5px"> Concluir </button> <button class="btn btn-danger" type="button" > Excluir </button></div> </div>'
	}
	if(tamanhoJSON == 0){
		$("#divCards")[0].innerHTML = '<div class="card"> <div class="card-body"> <h4 class="card-title"> Você ainda não adicionou tarefas </h4> </div> </div>'
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