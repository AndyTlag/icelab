<?php
session_start();

include_once(dirname(__FILE__) . '/Config.class.php');
include_once(dirname(__FILE__) . '/conexao.php');
$user = addslashes($_POST['txtLogin']);
$senha = addslashes(md5($_POST['txtSenha']));
$acessar = addslashes($_POST['acessar']);

if (isset($acessar)) {

	$sql = "SELECT * FROM " . Config::BD_PREFIX . "usuario usu 
	WHERE usu.usu_email = '$user' 
	AND usu.usu_senha= '$senha'";

//die($sql);

	$result = mysqli_query($con,$sql) or die (mysqli_error($con));

	$reg = mysqli_fetch_assoc($result);

	if(isset($reg['usu_id'])){

		if ($reg['usu_status'] == '0') {
//var_dump($reg);

//die($reg['usu_status']);

			$_SESSION['txtLogin'] = $user;
			$_SESSION['usu_id'] = $reg['usu_id'];
			$_SESSION['usu_nome'] = $reg['usu_nome'];

			$_SESSION['start'] = time(); //pegando tempo login
			header('location:index.php');


		} else {

			$_SESSION['danger-login'] = "<div class='alert alert-danger'>Acesso Bloqueado!</div>";

			header('location:login.php');

		}

	} 
	else {

		session_destroy();
		//$_SESSION['danger-login2'] = "<div class='alert alert-danger'></div>";
		header('location:login.php');
	}

}

?>