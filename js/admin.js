$(document).ready(function(){

$("#linkTurmas").click(function(e){
	e.preventDefault();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"pgClasse"},
		success: function(data){
			$("#pgContent").html(data);
		}
	});
});

$("#profLista").click(function(e){
	e.preventDefault();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"profLista"},
		success: function(data){
			$("#pgContent").html(data);
		}
	});
});
$("#respostas").click(function(e){
	e.preventDefault();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"listResp"},
		success:function(data){
			$("#pgContent").html(data);
		}
	});
});

$("#cadTurmas").click(function(e){
	e.preventDefault();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"cadTurmas"},
		success: function(data){
			$("#pgContent").html(data);
		}
	});
});

$("#cadPerg").click(function(e){
	e.preventDefault();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"cadPerg"},
		success: function(data){
			$("#pgContent").html(data);
		}
	});
});

$("#pergList").click(function(e){
	e.preventDefault();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"pergList", topico:"todas"},
		success: function(data){
			$("#pgContent").html(data);
			$.ajax({
				url:"main.php",
				type:"POST",
				data:{acao:"listarPerguntas",topico:"todas"},
				success:function(data){
					$("#divPerguntas").html(data);
				}
			});
		}
	});
});

$("#cadProf").click(function(e){
	e.preventDefault();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"cadProf"},
		success: function(data){
			$("#pgContent").html(data);
		}
	});
});

$("#cadTopico").click(function(e){
	e.preventDefault();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"cadTopico"},
		success: function(data){
			$("#pgContent").html(data);
		}
	});
});
$(document).on("click","#cadTurma",function(e){
	e.preventDefault();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"pgCadTurma"},
		success:function(data){
			$("#pgContent").html(data);
		}

	});
});
	
$(this).on("submit",".formTurma",function(e){
	e.preventDefault();
	var formData = $(this).serialize();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:formData,
		success:function(data){
			$("#pgContent").html(data);
		}
	});
});

$(document).on("click",".deletaProf",function(e){
		e.preventDefault();
		var idProfessor = $(this).attr("id");
		var idTurma = $(this).attr("idTurma")
		if(confirm("Tem certeza que deseja desassociar este professor a essa turma?")){
				
				$.ajax({
					url:"main.php",
					type:"POST",
					data:{acao:"desProf",idProfessor:idProfessor,idTurma:idTurma},
					success:function(data){
						$("#pgContent").html(data);
					}

				});
		}

});

$(document).on("submit",".formAddProf",function(e){
	e.preventDefault();
	var idProfessor = $(this).find(":selected").val();
	var idTurma = $(this).attr("idTurma");

	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"assocProf",idProfessor:idProfessor,idTurma:idTurma},
		success:function(data){
			$("#pgContent").html(data);
		}
	});
});


$(document).on("submit","#formCadTurma",function(e){
	e.preventDefault();
	var dados = $(this).serialize();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:dados,
		success:function(){
			alert("Turma cadastrada com sucesso!");
			$("#formCadTurma").trigger("reset");
		}
	});
});

$(document).on("submit","#formCadProf",function(e){
	e.preventDefault();
	var dados = $(this).serialize();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:dados,
		success:function(){
			alert("Professor(a) cadastrado(a) com sucesso!");
			$("#formCadProf").trigger("reset");
		}
	});
});

$(document).on("click",".btnProfessor",function(e){
	e.preventDefault();
	var idProfessor = $(this).attr("id");
	if(confirm("deseja mesmo deletar o(a) professor(a)?")){
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"deletaProfLista",id:idProfessor},
		success:function(data){
			$("#pgContent").html(data);
		}
	});
}
});
$(document).on("submit","#cadPergDissert",function(e){
	e.preventDefault();
	var idTopico = $("[name = 'selectTopDissert']").val();
	
	var tipo = 1;
	var enunciado = $("#cadPergDissert textarea[name='enunciado']").val();
	var acao = 'insereDissert';
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{idTopico:idTopico,tipo:tipo,enunciado:enunciado,acao:acao},
		success: function(){
			alert("Pergunta inserida com sucesso!");
			$("#cadPergDissert").trigger("reset");
		}
	});

});

$(document).on("submit","#cadPergMult",function(e){
	e.preventDefault();
	var idTopico = $("#cadPergMult select[name = 'selectTop']").val();
	var idProfessor = $("#cadPergMult select[name = 'selectProf']").val();
	var tipo = 2;
	var enunciado = $("#cadPergMult textarea[name='enunciado']").val();
	var acao = 'insereMult';
	var pergA = $("#cadPergMult input[name='opA']").val();
	var pergB = $("#cadPergMult input[name='opB']").val();
	var pergC = $("#cadPergMult input[name='opC']").val();
	var pergD = $("#cadPergMult input[name='opD']").val();
	var pergE = $("#cadPergMult input[name='opE']").val();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{idTopico:idTopico,idProfessor:idProfessor,tipo:tipo,enunciado:enunciado,acao:acao, pergA:pergA,pergB:pergB,pergC:pergC,pergD:pergD,pergE:pergE},
		success: function(){
			alert("Pergunta inserida com sucesso!");
			$("#cadPergMult").trigger("reset");
		}
	});

});

$(document).on("click","#buttonTopico",function(e){
	e.preventDefault();
	var nome = $("#nomeTopico").val();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"insereTopico",nome:nome},
		success:function(data){
			$("#pgContent").html(data);
		}
	});
});

$(document).on("click",".deletaTop",function(e){
	
	var id = $(this).attr("id");
	if(confirm("Deseja deletar este tópico e as perguntas a ele associadas?")){
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"deletaTopico", id:id},
		success:function(data){
			$("#pgContent").html(data);
		}
	});
}
});

$(document).on("change","#selectTopLista",function(){
	var topico = $(this).val();
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"listarPerguntas",topico:topico},
		success:function(data){
			$("#divPerguntas").html(data);
		}
	});
});

$(document).on("click",".btnPergList",function(e){
	e.preventDefault();
	var topico = $("#selectTopLista").val();
	var idPergunta = $(this).attr('id');
	$.ajax({
		url:"main.php",
		type:"POST",
		data:{acao:"deletaPergunta",idPergunta:idPergunta, topico:topico},
		success:function(data){
			$("#divPerguntas").html(data);
		}
	});
});


});


