<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="register-form" type="POST">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" method="POST" action="main.php">
      <input type="text" placeholder="Login" name="login"/>
       <input type="password" placeholder="password" name="senha"/>
      <input type="hidden" name="acao" value="loginAdmin">
      <button>Entrar</button>
      
    </form>
  </div>
</div>
</body>
</html>