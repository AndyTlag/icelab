<?php

include_once(dirname(__FILE__) . '/Config.class.php');
include_once(dirname(__FILE__) . '/conexao.php');

if ($_POST['action'] == "cad_prod") {
	cad_prod($con);
}

if ($_POST['action'] == "upd_prod") {
	upd_prod($con);
}

if ($_POST['action'] == "del_prod") {
	del_prod($con);
}


function cad_prod($con){
	$prod_nome=$_POST['prod_nome'];
	$prod_valor=$_POST['prod_valor'];
	$prod_valor= str_replace(",", ".", $prod_valor);
	$prod_desc=$_POST['prod_desc'];
	$prod_img=$_FILES['prod_img'];
	

	if (isset($prod_nome) && ($prod_valor) && ($prod_desc) && ($prod_img)){

      	$extensao =  strtolower(substr($prod_img['name'], -4)); //pegar extensao do file
      	$novo_nome = md5(time()) . $extensao; //definir nome do file
      	$diretorio = "asset/upload/"; //definir diretorio que aramazena os file updloads

      	move_uploaded_file($prod_img['tmp_name'], $diretorio.$novo_nome);

      	$sql = "CALL CadProd('$prod_nome', '$prod_valor', '$prod_desc', '$novo_nome')";

      	//die($sql);

      	$oDados = mysqli_query($con, $sql);

      	if ($dados === TRUE) {
      		$_SESSION['success-cad-prod'] = "<div class='container'><div class='alert alert-success'>Produto cadastrado com sucesso!</div></div>";

      		header('location:sorvete.php');

      	}else{
      		$_SESSION['danger-cad-prod']= "<div class='container'><div class='alert alert-danger'>Erro: ".mysqli_error($con)."</div></div>";

      		header('location:sorvete.php');

      	}


      }

  }

  function upd_prod($con){
  	
  }

  function del_prod($con){
  	
  }


  ?>