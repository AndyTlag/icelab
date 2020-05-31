<?php 

include_once(dirname(__FILE__) . '/Config.class.php');
include_once(dirname(__FILE__) . '/conexao.php');

session_start();

$msg="";

if(isset ($_SESSION['start'])) {
  $_SESSION['expire'] = $_SESSION['start'] + (15 * 60); //1 vez -- 60 segundos
} else {
	$msg="<div class='alert alert-warning'>Faça Login novamente!</div><br>";
}

if(isset ($_SESSION['txtLogin'])){

	$now = time(); 

	if ($now > $_SESSION['expire']) {
		$msg = "<div class='alert alert-danger'>Sua sessão expirou por questão de segurança. Faça Login novamente!</div><br>";
		session_destroy();
	}
	else {

		$_SESSION['start'] = $now; // pegando o tempo login

	}
}


$logado = $_SESSION['txtLogin'];
$usu_id = $_SESSION['usu_id'];
$usu_nome = $_SESSION['usu_nome'];



?>
