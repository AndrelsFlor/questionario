<?php
	
	require_once('classes/turmaClasse.php');
	require_once('classes/adminClasse.php');
	require_once('classes/professorClasse.php');
	require_once('classes/topicosClasse.php');
	require_once('classes/perguntaClasse.php');
	require_once('classes/respostasClasse.php');
	$acao = $_POST["acao"];
	

	if($acao == "loginTurma"){
		$login = $_POST['login'];

		$turma = new turma();
		$turma->setLogin($login);
		if($turma->login() != 'false'){
			session_start();
			$_SESSION['login'] = $login;
			header('location:questionario.php?turma='.$login.'&id='.$turma->login().'&perg=0');
		}
		else{

			unset($_SESSION['login']);
		}
		

		
	}
	else if($acao == "loginAdmin"){
		session_start();
		$_SESSION['login'];
		$_SESSION['senha'];
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		$admin = new admin();
		if($admin->login($login,$senha) == true){
			
			$_SESSION['login'] = $login;
			$_SESSION['senha'] = $senha;
			header('location:admin.php');
		}
		else{
			unset($_SESSION['login']);
			unset($_SESSION['senha']);
			header('location:loginAdmin.php');
		}
	}
	else if($acao == "pgClasse"){
		$turma = new turma();
		$valor = $turma->selectAll();
		if(empty($valor)){
?>
	<p>Ainda não há nenhuma turma cadastrada. Gostaria de <a href="#" id="cadTurma">cadastrar uma turma</a>?</p>

<?php
		}
		else{
			foreach($turma->selectOrdenado() as $val){



?>
		<div class="panel panel-success">
			<div class="panel-heading">
			    <h3 class="panel-title"><?php echo $val->Semestre; ?>º semestre de <?php echo $val->Ano;?></h3>
			  </div>
			  <div class="panel-body">
			  	<ul class="list-group">
			  	    <li class="list-group-item"><?php echo $val->QtdAlunos;?> Alunos</li>
			  	    <li class="list-group-item"><?php echo $val->Termo;?>º Termo</li>
			  	    <li class="list-group-item"><a  role="button" data-toggle="collapse" href="#turma<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
  Professores
</a>  
<div class="collapse" id="turma<?php echo $val->ID;?>">
  <div>
  <ul class="list-group">
    <?php
    	$turma->setIdTurma($val->ID);
    	foreach($turma->listaProfessor() as $prof){

    ?>
    	<li class="list-group-item"><?php echo $prof->Nome;?><span class="badge"><label class="glyphicon glyphicon-trash"><button style="display: none;" class="deletaProf" idTurma="<?php echo $val->ID?>" id="<?php echo $prof->ID;?>" ></button></label></span></li>
    <?php
    	}
    ?>
  </ul>
   <a  role="button" data-toggle="collapse" href="#add<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
     Adicionar
   </a>  
   <div class="collapse" id="add<?php echo $val->ID;?>">
     <div>
     <form class="formAddProf" idTurma ="<?php echo $val->ID;?>">
    	<select name="professor" class="selectProf">
    	<?php
    		$professor = new professor();
    		foreach($professor->selectOrdenado() as $aux){
    	?>
    	 <option value="<?php echo $aux->ID;?>" id="<?php echo $aux->ID;?>"><?php echo $aux->Nome;?></option>
    	 <?php
    	 	}
    	 ?> 
    	
    	</select>
    	<label class="glyphicon glyphicon-ok btn btn-success btn-sm"><button style="display: none;"></button></label>
      </form>
     </div>
   </div>
  </div>
</div>

</li>
			  	    			  	    <li class="list-group-item"><a  role="button" data-toggle="collapse" href="#editturma<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
			  	      Editar...
			  	    </a>  
			  	    <div class="collapse" id="editturma<?php echo $val->ID;?>">
			  	      <div>
			  	     	<form id="formEditTurma" method="POST" action="main.php" class="formTurma">
			  	     	<p>Login:</p><input type="text" value="<?php echo $val->Login;?>" name="loginTurma">
			  	     	<p>Alunos:</p><input type="text" value="<?php echo $val->QtdAlunos;?>" name="QtdAlunos">
			  	     	<p>Termo:</p><input type="text" value="<?php echo $val->Termo;?>" name="termoTurma">
			  	     	
			  	     	 <input type="hidden" value="<?php echo $val->ID;?>" name="idTurma"> 
			  	     	  <input type="hidden" value="editTurma" name="acao"><br><br>
			  	     	  <input type="submit" class="btn btn-success btnTurma" value="Salvar">
			  	     	</form>
			  	       <script>

			  	       </script>
			  	      </div>
			  	    </div>
			  	    </li>
			  	  </ul>
			  	 
			  </div>
			  
		</div>

<?php
			}
		}
	}
	else if($acao == 'editTurma'){
		$login 			= $_POST['loginTurma'];
		$QtdAlunos 		= $_POST['QtdAlunos'];
		$termoTurma 	= $_POST['termoTurma'];
		
		$idTurma 		= $_POST['idTurma'];

		$turma = new turma();
		
		$turma->setLogin($login);
		$turma->setqtdAlunos($QtdAlunos);
		$turma->setTermo($termoTurma);
		
		$turma->update($idTurma);
		foreach($turma->selectOrdenado() as $val){


?>
			
	<div class="panel panel-success">
				<div class="panel-heading">
				    <h3 class="panel-title"><?php echo $val->Semestre; ?>º semestre de <?php echo $val->Ano;?></h3>
				  </div>
				  <div class="panel-body">
				  	<ul class="list-group">
				  	    <li class="list-group-item"><?php echo $val->QtdAlunos;?> Alunos</li>
				  	    <li class="list-group-item"><?php echo $val->Termo;?>º Termo</li>
				  	    <li class="list-group-item"><a  role="button" data-toggle="collapse" href="#turma<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
	  Professores
	</a>  
	<div class="collapse" id="turma<?php echo $val->ID;?>">
	  <div>
	  <ul class="list-group">
	    <?php
	    	$turma->setIdTurma($val->ID);
	    	foreach($turma->listaProfessor() as $prof){

	    ?>
	    	<li class="list-group-item"><?php echo $prof->Nome;?><span class="badge"><label class="glyphicon glyphicon-trash"><button style="display: none;" class="deletaProf" idTurma="<?php echo $val->ID?>" id="<?php echo $prof->ID;?>" ></button></label></span></li>
	    <?php
	    	}
	    ?>
	  </ul>
	   <a  role="button" data-toggle="collapse" href="#add<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
	     Adicionar
	   </a>  
	   <div class="collapse" id="add<?php echo $val->ID;?>">
	     <div>
	     <form class="formAddProf" idTurma ="<?php echo $val->ID;?>">
	    	<select name="professor">
	    	<?php
	    		$professor = new professor();
	    		foreach($professor->selectOrdenado() as $aux){
	    	?>
	    	  <option value="<?php echo $aux->ID;?>" id="<?php echo $aux->ID;?>"><?php echo $aux->Nome;?></option>
	    	 <?php
	    	 	}
	    	 ?> 
	    	
	    	</select>
	    	<label class="glyphicon glyphicon-ok btn btn-success btn-sm"><button style="display: none;"></button></label>
	      </form>
	     </div>
	   </div>
	  </div>
	</div>

	</li>
				  	    			  	    <li class="list-group-item"><a  role="button" data-toggle="collapse" href="#editturma<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
				  	      Editar...
				  	    </a>  
				  	    <div class="collapse" id="editturma<?php echo $val->ID;?>">
				  	      <div>
				  	     	<form id="formEditTurma" method="POST" action="main.php" class="formTurma">
				  	     	<p>Login:</p><input type="text" value="<?php echo $val->Login;?>" name="loginTurma">
				  	     	<p>Alunos:</p><input type="text" value="<?php echo $val->QtdAlunos;?>" name="QtdAlunos">
				  	     	<p>Termo:</p><input type="text" value="<?php echo $val->Termo;?>" name="termoTurma">
				  	     	
				  	     	 <input type="hidden" value="<?php echo $val->ID;?>" name="idTurma"> 
				  	     	  <input type="hidden" value="editTurma" name="acao"><br><br>
				  	     	  <input type="submit" class="btn btn-success btnTurma" value="Salvar">
				  	     	</form>
				  	       <script>

				  	       </script>
				  	      </div>
				  	    </div>
				  	    </li>
				  	  </ul>
				  	 
				  </div>
				  
			</div>


<?php
			}
		}
		else if($acao == "desProf"){
			$idTurma 		= $_POST['idTurma'];
			$idProfessor 	= $_POST['idProfessor'];
			$turma = new turma();
			$turma->setIdTurma($idTurma);
			$turma->deletaProfessor($idProfessor);
			foreach($turma->selectOrdenado() as $val){

?>
		
				<div class="panel panel-success">
					<div class="panel-heading">
					    <h3 class="panel-title"><?php echo $val->Semestre; ?>º semestre de <?php echo $val->Ano;?></h3>
					  </div>
					  <div class="panel-body">
					  	<ul class="list-group">
					  	    <li class="list-group-item"><?php echo $val->QtdAlunos;?> Alunos</li>
					  	    <li class="list-group-item"><?php echo $val->Termo;?>º Termo</li>
					  	    <li class="list-group-item"><a  role="button" data-toggle="collapse" href="#turma<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
		  Professores
		</a>  
		<div class="collapse" id="turma<?php echo $val->ID;?>">
		  <div>
		  <ul class="list-group">
		    <?php
		    	$turma->setIdTurma($val->ID);
		    	foreach($turma->listaProfessor() as $prof){

		    ?>
		    	<li class="list-group-item"><?php echo $prof->Nome;?><span class="badge"><label class="glyphicon glyphicon-trash"><button style="display: none;" class="deletaProf" idTurma="<?php echo $val->ID?>" id="<?php echo $prof->ID;?>" ></button></label></span></li>
		    <?php
		    	}
		    ?>
		  </ul>
		   <a  role="button" data-toggle="collapse" href="#add<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
		     Adicionar
		   </a>  
		   <div class="collapse" id="add<?php echo $val->ID;?>">
		     <div>
		     <form class="formAddProf" idTurma ="<?php echo $val->ID;?>">
		    	<select name="professor">
		    	<?php
		    		$professor = new professor();
		    		foreach($professor->selectOrdenado() as $aux){
		    	?>
		    	  <option value="<?php echo $aux->ID;?>" id="<?php echo $aux->ID;?>"><?php echo $aux->Nome;?></option>
		    	 <?php
		    	 	}
		    	 ?> 
		    	
		    	</select>
		    	<label class="glyphicon glyphicon-ok btn btn-success btn-sm"><button style="display: none;"></button></label>
		      </form>
		     </div>
		   </div>
		  </div>
		</div>

		</li>
					  	    			  	    <li class="list-group-item"><a  role="button" data-toggle="collapse" href="#editturma<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
					  	      Editar...
					  	    </a>  
					  	    <div class="collapse" id="editturma<?php echo $val->ID;?>">
					  	      <div>
					  	     	<form id="formEditTurma" method="POST" action="main.php" class="formTurma">
					  	     	<p>Login:</p><input type="text" value="<?php echo $val->Login;?>" name="loginTurma">
					  	     	<p>Alunos:</p><input type="text" value="<?php echo $val->QtdAlunos;?>" name="QtdAlunos">
					  	     	<p>Termo:</p><input type="text" value="<?php echo $val->Termo;?>" name="termoTurma">
					  	     	
					  	     	 <input type="hidden" value="<?php echo $val->ID;?>" name="idTurma"> 
					  	     	  <input type="hidden" value="editTurma" name="acao"><br><br>
					  	     	  <input type="submit" class="btn btn-success btnTurma" value="Salvar">
					  	     	</form>
					  	       <script>

					  	       </script>
					  	      </div>
					  	    </div>
					  	    </li>
					  	  </ul>
					  	 
					  </div>
					  
				</div>

<?php
		}
	}
	else if($acao == "assocProf"){
		$idTurma = $_POST['idTurma'];
		$idProf = $_POST['idProfessor'];
		$turma = new turma();
		$turma->setIdTurma($idTurma);
		$turma->insereProfessor($idProf);

		foreach($turma->selectOrdenado() as $val){
?>
		<div class="panel panel-success">
			<div class="panel-heading">
			    <h3 class="panel-title"><?php echo $val->Semestre; ?>º semestre de <?php echo $val->Ano;?></h3>
			  </div>
			  <div class="panel-body">
			  	<ul class="list-group">
			  	    <li class="list-group-item"><?php echo $val->QtdAlunos;?> Alunos</li>
			  	    <li class="list-group-item"><?php echo $val->Termo;?>º Termo</li>
			  	    <li class="list-group-item"><a  role="button" data-toggle="collapse" href="#turma<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
  Professores
</a>  
<div class="collapse" id="turma<?php echo $val->ID;?>">
  <div>
  <ul class="list-group">
    <?php
    	$turma->setIdTurma($val->ID);
    	foreach($turma->listaProfessor() as $prof){

    ?>
    	<li class="list-group-item"><?php echo $prof->Nome;?><span class="badge"><label class="glyphicon glyphicon-trash"><button style="display: none;" class="deletaProf" idTurma="<?php echo $val->ID?>" id="<?php echo $prof->ID;?>" ></button></label></span></li>
    <?php
    	}
    ?>
  </ul>
   <a  role="button" data-toggle="collapse" href="#add<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
     Adicionar
   </a>  
   <div class="collapse" id="add<?php echo $val->ID;?>">
     <div>
     <form class="formAddProf" idTurma ="<?php echo $val->ID;?>">
    	<select name="professor">
    	<?php
    		$professor = new professor();
    		foreach($professor->selectOrdenado() as $aux){
    	?>
    	  <option value="<?php echo $aux->ID;?>" id="<?php echo $aux->ID;?>"><?php echo $aux->Nome;?></option>
    	 <?php
    	 	}
    	 ?> 
    	
    	</select>
    	<label class="glyphicon glyphicon-ok btn btn-success btn-sm"><button style="display: none;"></button></label>
      </form>
     </div>
   </div>
  </div>
</div>

</li>
			  	    			  	    <li class="list-group-item"><a  role="button" data-toggle="collapse" href="#editturma<?php echo $val->ID;?>" aria-expanded="false" aria-controls="turma<?php echo $val->ID;?>">
			  	      Editar...
			  	    </a>  
			  	    <div class="collapse" id="editturma<?php echo $val->ID;?>">
			  	      <div>
			  	     	<form id="formEditTurma" method="POST" action="main.php" class="formTurma">
			  	     	<p>Login:</p><input type="text" value="<?php echo $val->Login;?>" name="loginTurma">
			  	     	<p>Alunos:</p><input type="text" value="<?php echo $val->QtdAlunos;?>" name="QtdAlunos">
			  	     	<p>Termo:</p><input type="text" value="<?php echo $val->Termo;?>" name="termoTurma">
			  	     	
			  	     	 <input type="hidden" value="<?php echo $val->ID;?>" name="idTurma"> 
			  	     	  <input type="hidden" value="editTurma" name="acao"><br><br>
			  	     	  <input type="submit" class="btn btn-success btnTurma" value="Salvar">
			  	     	</form>
			  	       <script>

			  	       </script>
			  	      </div>
			  	    </div>
			  	    </li>
			  	  </ul>
			  	 
			  </div>
			  
		</div>

<?php

	}

}
else if($acao == 'cadTurmas'){
?>
<div class="panel panel-success">
	<div class="panel-heading">Cadastro de Turmas</div>
	<div class="panel-body">
		<form id="formCadTurma">
			<input type="text" name="login" placeholder="Login"><br><br>
			<input type="text" name="QtdAlunos" placeholder="Quantidade de Alunos"><br><br>
			<input type="text" name="termo" placeholder="Termo"><br><br>
			<input type="text" name="ano" placeholder="Ano"><br><br>
			<input type="text" name="semestre" placeholder="Semestre"><br><br>
			<input type="hidden" name="acao" value="insereTurmas">
			<button class="btn btn-success">Cadastrar</button>
		</form>

	</div>
</div>
<?php	
}

else if($acao == 'insereTurmas'){
	$login = $_POST['login'];
	$QtdAlunos = $_POST['QtdAlunos'];
	$termo = $_POST['termo'];
	$ano = $_POST['ano'];
	$semestre = $_POST['semestre'];
	
	$turma = new turma();
	$turma->setLogin($login);
	$turma->setqtdAlunos($QtdAlunos);
	$turma->setTermo($termo);
	$turma->setAno($ano);
	$turma->setSemestre($semestre);
	$turma->insert();
}
else if($acao == 'cadProf'){
?>
<div class="panel panel-success">
	<div class="panel-heading">Cadastro de Professores</div>
	<div class="panel-body">
		<form id="formCadProf">
			<input type="text" name="nome" placeholder="Nome"><br><br>
			<input type="hidden" name="acao" value="insereProf">
			<button class="btn btn-success">Cadastrar</button>
		</form>

	</div>
</div>
<?php
}

else if($acao == 'insereProf'){
	$nome = $_POST['nome'];
	$professor = new professor();
	$professor->setNome($nome);
	$professor->insert();
}

else if($acao == 'profLista'){
	$professor = new professor();
?>
<div class="panel panel-success">
	<div class="panel-heading">Lista de professores inscritos no sistema</div>
	<div class="panel-body">
		<ul class="list-group">
		<?php
			foreach($professor->selectOrdenado() as $prof){
		?>
		  <li class="list-group-item">
		    <span class="badge"><label class="glyphicon glyphicon-trash"><button style="display:none;" class="btnProfessor" id="<?php echo $prof->ID;?>"></label></button></span>
		    <?php echo $prof->Nome;?>
		  </li>
		<?php
		}
		?>
		</ul>

	</div>
</div>
<?php
}

else if($acao == "deletaProfLista"){
	$professor = new professor();
	$id = $_POST['id'];
	$professor->delete($id);
?>
<div class="panel panel-success">
	<div class="panel-heading">Lista de professores inscritos no sistema</div>
	<div class="panel-body">
		<ul class="list-group">
		<?php
			foreach($professor->selectOrdenado() as $prof){
		?>
		  <li class="list-group-item">
		    <span class="badge"><label class="glyphicon glyphicon-trash"><button style="display:none;" class="btnProfessor" id="<?php echo $prof->ID;?>"></label></button></span>
		    <?php echo $prof->Nome;?>
		  </li>
		<?php
		}
		?>
		</ul>

	</div>
</div>
<?php
}

else if($acao == 'cadPerg'){
	$professor = new professor();
	$topico = new topicos();
	$pergunta = new pergunta();
?>
<div class="panel panel-success">
	<div class="panel-heading">Cadastro de Perguntas</div>
	<div class="panel-body">
		<p>Escolha o tipo de pergunta:<a  role="button" data-toggle="collapse" href="#collapseDissert" aria-expanded="false" aria-controls="collapseDissert">
  Dissertativa
</a> ou <a  role="button" data-toggle="collapse" href="#collapseMult" aria-expanded="false" aria-controls="collapseMult">
  Múltipa Escolha</a></p>
<div class="collapse" id="collapseDissert">
  <div class="panel-body">
   <form id="cadPergDissert">
   	
   		<p>Tópico ao qual a pergunta pertence:</p>
   		<select name="selectTopDissert">
   			<?php foreach($topico->selectOrdenado() as $valor){
   			?>

   				<option value="<?php echo $valor->ID;?>"> <?php echo $valor->Nome;?> </option>
   			<?php
   				}
   			?>
   		</select><br><br>

   		<p>Enunciado:</p>
   		<textarea rows="4" cols="50" name="enunciado" placeholder="Enunciado">
   		 
   		</textarea><br><br>
   		<button class=" btn btn-success">Cadastrar</button>
   </form>
  </div>
</div>
<div class="collapse" id="collapseMult">
  <div class="panel-body">
   <form id="cadPergMult">
 
   	<p>Tópico ao qual a pergunta pertence:</p>
   	<select name="selectTop">
   		<?php foreach($topico->selectOrdenado() as $valor){
   		?>

   			<option value="<?php echo $valor->ID;?>"> <?php echo $valor->Nome;?> </option>
   		<?php
   			}
   		?>
   	</select><br><br>
   	<p>Enunciado:</p>
   	<textarea rows="4" cols="50" name="enunciado" placeholder="Enunciado">   	 
   	</textarea><br><br>
   	<input type="text" placeholder="Opção A" name="opA"><br><br>
   	<input type="text" placeholder="Opção B" name="opB"><br><br>
   	<input type="text" placeholder="Opção C" name="opC"><br><br>
   	<input type="text" placeholder="Opção D" name="opD"><br><br>
   	<input type="text" placeholder="Opção E" name="opE"><br><br>
   	<button class=" btn btn-success">Cadastrar</button>
   </form>
  </div>
</div>
	</div>
</div>
<?php

}


else if($acao == 'insereDissert'){
	$topico = new topicos();
	$professores = new professor();
	$pergunta = new pergunta();
	$idTopico = $_POST['idTopico'];

	
	$tipo = $_POST['tipo'];
	$enunciado = $_POST['enunciado'];

	$pergunta->setIDTopico($idTopico);
	
	$pergunta->setEnunciado($enunciado);
	$pergunta->setTipo($tipo);
	$busca = $topico->select($idTopico);
	if($busca->Nome == 'Professores'){
		foreach($professores->selectAll() as $prof){
			$pergunta->setIDProfessor($prof->ID);
			$pergunta->insert();

		}
	}
	else{
		$pergunta->insert();
	}

	
}

else if($acao == 'insereMult'){
	$pergunta = new pergunta();
	$idTopico = $_POST['idTopico'];
	$topico = new topicos();
	$professores = new professor();
	$tipo = $_POST['tipo'];
	$enunciado = $_POST['enunciado'];
	
	$pergunta->setIDTopico($idTopico);
	
	$pergunta->setEnunciado($enunciado);
	$pergunta->setTipo($tipo);
	$pergunta->setEnuncA(1);
	$pergunta->setEnuncB(2);
	$pergunta->setEnuncC(3);
	$pergunta->setEnuncD(4);
	$pergunta->setEnuncE(5);

	$busca = $topico->select($idTopico);
	if($busca->Nome == 'Professores'){
		foreach($professores->selectAll() as $prof){
			$pergunta->setIDProfessor($prof->ID);
			$pergunta->insert();

		}
	}
	else{
		$pergunta->insert();
	}

	
}

else if($acao == 'cadTopico'){
	$topico = new topicos();
?>
<div class="panel panel-success">
<div class="panel-heading">
Tópicos
</div>
<div class="panel-body">
	
	<input type="text" id="nomeTopico">&nbsp;<button class="btn btn-success btn-sm" id="buttonTopico">Cadastrar</button><br><br>
	
	<ul class="list-group">
	<?php
		foreach($topico->selectOrdenado() as $valor){
	?>
		<li class="list-group-item"><?php echo $valor->Nome;?><span class="badge"><label class="glyphicon glyphicon-trash"><button class="deletaTop" id="<?php echo $valor->ID;?>" style="display:none;"></button></label></span></li>
	<?php
		}
	?>
	</ul>

</div>	
</div>
<?php
}
else if($acao == 'insereTopico'){
	$nome = $_POST['nome'];	

	$topico = new topicos();
	$topico->setNome($nome);
	$topico->insert();
?>
<div class="panel panel-success">
<div class="panel-heading">
Tópicos
</div>
<div class="panel-body">
	
	<input type="text" id="nomeTopico">&nbsp;<button class="btn btn-success btn-sm" id="buttonTopico">Cadastrar</button><br><br>
	
	<ul class="list-group">
	<?php
		foreach($topico->selectOrdenado() as $valor){
	?>
		<li class="list-group-item"><?php echo $valor->Nome;?><span class="badge"><label class="glyphicon glyphicon-trash"><button class="deletaTop" id="<?php echo $valor->ID;?>" style="display:none;"></button></label></span></li>
	<?php
		}
	?>
	</ul>

</div>	
</div>
<?php
} else if($acao == 'deletaTopico'){
	$topico = new topicos();
	$id = $_POST['id'];
	$topico->deletaTopico($id);
?>
<div class="panel panel-success">
<div class="panel-heading">
Tópicos
</div>
<div class="panel-body">
	
	<input type="text" id="nomeTopico">&nbsp;<button class="btn btn-success btn-sm" id="buttonTopico">Cadastrar</button><br><br>
	
	<ul class="list-group">
	<?php
		foreach($topico->selectOrdenado() as $valor){
	?>
		<li class="list-group-item"><?php echo $valor->Nome;?><span class="badge"><label class="glyphicon glyphicon-trash"><button class="deletaTop" id="<?php echo $valor->ID;?>" style="display:none;"></button></label></span></li>
	<?php
		}
	?>
	</ul>

</div>	
</div>

<?php
}

else if($acao == 'pergList'){
	$topico = new topicos();
?>
<div class="panel panel-success">
	<div class="panel-heading">
		Lista de Perguntas
	</div> 
	<div class="panel-body">
	<div class="container">
		<select id="selectTopLista">
			<option value="todas">Todas as perguntas</option>
			<?php
				foreach($topico->selectOrdenado() as $valor){
			?>
				<option value="<?php echo $valor->ID;?>"><?php echo $valor->Nome;?></option>
			<?php
				}
			?>
		</select><br>
		</div>
		<div id="divPerguntas" class="panel-body">
		</div>
	</div>
</div>
<?php
}
else if($acao == 'listarPerguntas'){
	$pergunta = new pergunta();
	$topico = $_POST['topico'];
	if($topico != "todas"){
		
?>
	<ul class="list-group">
		<?php
			foreach($pergunta->selectTopico($topico) as $valor){
		?>
			<li class="list-group-item"><?php echo $valor->Nome;?>:<?php echo $valor->Enunciado;?><span class="badge"><label class="glyphicon glyphicon-trash"><button class="btnPergList" id="<?php echo $valor->id;?>" style="display:none;"></button></label></span></li>
		<?php		
			}
		?>

	</ul>
	
<?php
		
	}
	else{
	?>
	<ul class="list-group">
		<?php
			foreach($pergunta->selectOrdenado() as $valor){
		?>
			<li class="list-group-item"><?php echo $valor->Nome;?>:<?php echo $valor->Enunciado;?><span class="badge"><label class="glyphicon glyphicon-trash"><button class="btnPergList" id="<?php echo $valor->id;?>" style="display:none;"></button></label></span></li>
		<?php		
			}
		?>

	</ul>
	
	<?php
	}
}
else if($acao == 'deletaPergunta'){
	$idPergunta = $_POST['idPergunta'];
	$topico = $_POST['topico'];
	$pergunta = new pergunta();
	$pergunta->delete($idPergunta);
		if($topico != "todas"){
			
	?>
		<ul class="list-group">
			<?php
				foreach($pergunta->selectTopico($topico) as $valor){
			?>
				<li class="list-group-item"><?php echo $valor->Nome;?>:<?php echo $valor->Enunciado;?><span class="badge"><label class="glyphicon glyphicon-trash"><button class="btnPergList" id="<?php echo $valor->id;?>" style="display:none;"></button></label></span></li>
			<?php		
				}
			?>

		</ul>
		
	<?php
			
		}
		else{
		?>
		<ul class="list-group">
			<?php
				foreach($pergunta->selectOrdenado() as $valor){
			?>
				<li class="list-group-item"><?php echo $valor->Nome;?>:<?php echo $valor->Enunciado;?><span class="badge"><label class="glyphicon glyphicon-trash"><button class="btnPergList" id="<?php echo $valor->id;?>" style="display:none;"></button></label></span></li>
			<?php		
				}
			?>

		</ul>
		
		<?php
		}
	}

	else if($acao == 'listResp'){
		$respostas = new respostas();
		$professores = new professor();

    	require_once('classes/PHPExcel.php');
    	include 'classes/PHPExcel/Writer/Excel2007.php';

    	$objPHPExcel = new PHPExcel();

    	$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Professor');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Pergunta');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Resposta');

		$row = 2; // 1-based index
		
		    foreach($respostas->selectRespostas() as $key=>$value) {
		        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $value->Nome);
		         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $value->Enunciado);
		          $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $value->Resposta);
		        $row++;
		    }
		   
		

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
		
	?>
	<a href="main.xlsx">Baixar planilha com respostas</a>
	<?php
	
	
	}



?>