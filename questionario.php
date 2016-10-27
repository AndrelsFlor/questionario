<html>
<head>
<?php
	session_start();
	if(!empty($_SESSION['login'])){
		$login = $_SESSION['login'];
	}
	else{
		session_destroy();
		header('location:index.html');
	}

	require_once('classes/questionarioClasse.php');
	require_once('classes/respostasClasse.php');
	$questionario = new questionario();
	$id = $_GET['id'];
	
		$i = $_GET['perg'];

	$perguntas[] = array();

	if(isset($_GET['idP']) && isset($_GET['id']) && isset($_GET['resposta'])){
		$idPergunta = $_GET['idP'];
		$idTurma = $_GET['id'];
		$resp = $_GET['resposta'];

		$resposta = new respostas();

		$resposta->setIDPergunta($idPergunta);
		$resposta->setIDTurma($idTurma);
		$resposta->setResposta($resp);

		$resposta->insert();
	}
	


?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="register-form" method="get">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" method="get" id="formularioPergunta">
    <div id="divContentPerg">
    <?php 
    $aux = 0;

    foreach ($questionario->selecionaPerguntas($id) as $valor){ 
    	$perguntas[$aux] = $valor;   	
   		
   		$aux++;
    	
    	} 
    	
    ?>
   <p><?php echo $perguntas[$i]->Nome .":&nbsp;". $perguntas[$i]->Enunciado; ?></p>
   <?php
   		if($perguntas[$i]->Tipo == 1){
   	?>
   		<input type="text" name="resposta" placeholder = "Resposta">
   		<input type="hidden" name="tipo" value="<?php echo $perguntas[$i]->Tipo;?>" >
   		 <input type="hidden" value="<?php echo $perguntas[$i]->id?>" name="idP">
   	<?php


   		}

   		else {
   	?>
   		<label class="radio-inline"><input type="radio" value="1" name="resposta"> 1</label><br>
   		<label class="radio-inline"><input type="radio" value="2" name="resposta">2</label><br>
   		<label class="radio-inline"><input type="radio" value="3" name="resposta">3</label><br>
   		<label class="radio-inline"><input type="radio" value="4" name="resposta">4</label><br>
   		<label class="radio-inline"><input type="radio" value="5" name="resposta">5</label><br>
   		<input type="hidden" name="tipo" value="<?php echo $perguntas[$i]->Tipo;?>" >
   		 <input type="hidden" value="<?php echo $perguntas[$i]->id?>" name="idP">
   		
   	<?php

   		}
   ?>
    </div>
    <input type="hidden" value="<?php echo $i+1; ?>" name="perg">

    <input type="hidden" value="<?php echo $id;?>" name ="id">
   

      <button id="responde">Responder</button><br>
      <?php $soma = $i+1;?>
      <p><?php

      		if($soma <= count($perguntas)){
       		echo $soma."/". count($perguntas);
       	}
       	else{

       ?>
       <script>
       	alert("teste encerrado!");
       	window.location.replace("index.html")

       </script>
       <?php

       	}
       ?></p>
      
    </form>
  </div>
</div>
<script type="text/javascript" src="jquery/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="js/questionario.js"></script>
</body>
</html>