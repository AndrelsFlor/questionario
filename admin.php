
<!DOCTYPE html>
<html lang="en">

<head>
	<?php
    //ABANDONE TODA ESPERANÇA AQUELE QUE AQUI ENTRAR
	session_start();

	if(isset($_SESSION['login']) && isset($_SESSION['senha'])){
		$login = $_SESSION['login'];
		$senha = $_SESSION['senha'];

	}
	else{
		session_destroy();
		header("location:loginAdmin.php");
	}
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administração</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Menu Administrativo
                    </a>
                </li>
                <li id="linkTurmas">
                    <a href="#">Lista de Turmas</a>
                </li>
                <li id="cadTurmas">
                    <a href="#">Cadastro de Turmas</a>
                </li >
                 <li id="logProf">
                    <a href="#">Login de professores e funcionários</a>
                </li>
                <li id ="cadProf">
                    <a href="#">Cadastro de Professores</a>
                </li>
                <li id="profLista">
                    <a href="#">Lista de Professores</a>
                </li>
                <li id="cadPerg">
                    <a href="#">Cadastrar Perguntas</a>
                </li>
                <li id="pergList">
                    <a href="#">Lista de Perguntas</a>
                </li>
                <li id="cadTopico">
                    <a href="#">Cadastrar Tópicos</a>
                </li>
                <li id="respostas">
                    <a href="#">Respostas</a>
                </li>
                <li>
                    <a href="sair.php">Sair</a>
                </li>
                
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" id="pgContent">
                        <h1>Página de administração</h1>
                        <p>Bem-vindo(a) à página de administração do sistema!</p>
                        <p>Escolha, no menu ao lado, a ação desejada. Qualquer dúvida, entrar em contato.</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
<script src="js/admin.js"></script>
</body>

</html>
