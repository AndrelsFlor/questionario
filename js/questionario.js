$(document).ready(function(){
	$("#formularioPergunta").submit(function(e){

		var tipo = $("#tipo").val();

		if(tipo == 1){
			if($("#formularioPergunta input[name = 'resposta']").val() == ""){
				e.preventDefault();
				alert("O campo precisa ser preenchido!");
			}
		}

		if(tipo == 2){
			if ($("#formularioPergunta input[name='resposta']:checked").length==0) {
			  	e.preventDefault();
			   alert('Você precisa escolher uma opção!');

			}
		}
	});
});