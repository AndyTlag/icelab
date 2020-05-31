<?php
include_once(dirname(__FILE__) . '/Config.class.php');

session_start();


if((isset ($_SESSION['txtLogin']))){

  $logado = $_SESSION['txtLogin'];
  $usu_id = $_SESSION['usu_id'];
  $usu_nome = $_SESSION['usu_nome'];

}

?>

<!DOCTYPE html>
<html>
<head>
  <title>IceLab</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="asset/css/estilo.css">
  <script src="asset/js/jquery-3.5.1.min"></script>
  <script src="asset/js/bootstrap.js"></script>
  <link rel="stylesheet" href="asset/css/bootstrap.min.css">
  <link rel="shortcut icon" href="asset/img/favicon.png" />

</head>
<body class="login">

  <br>
  <div class="container">

    <div class="row">

      <div class="col-md-3"></div>
      <div class="col-md-6 loginbox">

        <form name="login" action="usuario.php" method="POST" class="form">
        <h3 align="center">Login</h3>



          <label class="sr-only" for="inlineFormInputGroup">Usuário</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fa fa-user"></i>&nbsp;
              </div>
            </div>
            <input type="text" class="form-control" name="txtLogin" id="login" REQUIRED placeholder="E-mail">
          </div>

          <label class="sr-only" for="inlineFormInputGroup">Senha</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fa fa-key"></i>
              </div>
            </div>
            <input class="form-control" name="txtSenha" id="senha" type="password" REQUIRED placeholder="Senha" />         
          </div>

          <input class="btn pull-right" type="submit" name="acessar" id="acessar" value="Acessar">



        </form>

      </div>

    </div>


  </div>

</body>
</html>