<div class="container">
	<div class="row"> 
		<div class="container col-md-12"  id='divCardsConcluidas'>
		</div>
	</div> 
</div>

<script type="text/javascript">
$(function(){
	$.post(<?php echo "'".base_url("listartarefasconcluidas")."'";?>,{},function(data){
		var jsonData = JSON.parse(data)
		construirCards(jsonData)
	})
})
function formatarData(strData){
	var data = strData.split("-")
	var diaHora = data[2].split(" ")
	var dia = diaHora[0]
	var mes = data[1]
	var ano = data[0]
	var hora = diaHora[1]
	var dataF = dia + "/" + mes + "/" + ano + " " + hora
	return dataF
}
function construirCards(jsonData){
	console.log(jsonData)
	var tamanhoJSON = jsonData.length
	var descricao = ""
	var titulo = ""
	var id_tarefa = ""
	var dataInicio = ""
	var strCards = ""
	if(tamanhoJSON == 0){
		$("#divCardsConcluidas")[0].innerHTML = '<div class="card" style="align-items:center; justify-content:center; margin:10px"> <div class="card-body" style:"justify-content:center;"> <h4 class="card-title"> Você não possui tarefas concluídas </h4> </div> </div>'
	}else{
		for(var i = 0; i < tamanhoJSON; i++){
			var dataInicio = formatarData(jsonData[i].inicio)
			var dataTermino = formatarData(jsonData[i].termino)
			strCards += '<div class="card col-md-12 style="margin-left:25%" style="margin:10px"> <div class="card-body"> <h5 class="card-title"> Título: ' + jsonData[i].titulo +'</h5> <p class="h6"> Descrição: ' + jsonData[i].descricao +'</p> <p class="h6"> Início: ' + dataInicio + '</p><p class="h6"> Término:' + dataTermino + '</div> </div>'
		}
		$("#divCardsConcluidas")[0].innerHTML = strCards
	}

}


</script>