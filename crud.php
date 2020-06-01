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
	del_prod($con,$_POST['prod_id']);
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
      	$diretorio = Config::SITE_UPLOAD_IMG; //definir diretorio que aramazena os file updloads

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

      $prod_nome=$_POST['prod_nome'];
      $prod_valor=$_POST['prod_valor'];
      $prod_valor= str_replace(",", ".", $prod_valor);
      $prod_desc=$_POST['prod_desc'];
      $prod_img=$_FILES['prod_img'];


      if ($_FILES['prod_img']['name'] > '0'){

        $extensao =  strtolower(substr($prod_img['name'], -4)); 
        $novo_nome = md5(time()) . $extensao; 
        $diretorio = Config::SITE_UPLOAD_IMG;
        move_uploaded_file($prod_img['tmp_name'], $diretorio.$novo_nome);

      }
/*      var_dump($_FILES['prod_img']);
foreach ($_FILES['prod_img'] as  $value) {
  echo $value."<br>";
};
die($novo_nome);*/
if (isset($prod_nome) || ($prod_valor) || ($prod_desc) || ($prod_img)){

  if (isset($novo_nome)) {

    $sql = "CALL UpdProd('$prod_nome', '$prod_valor', '$prod_desc', '$novo_nome')";
  }else{

    $sql = "CALL UpdProd('$prod_nome', '$prod_valor', '$prod_desc')";
  }


  die($sql);

  $oDados = mysqli_query($con, $sql);

  if ($dados === TRUE) {
    $_SESSION['success-upd-prod'] = "<div class='container'><div class='alert alert-success'>Produto editado com sucesso!</div></div>";

    header('location:sorvete.php');

  }else{
    $_SESSION['danger-upd-prod']= "<div class='container'><div class='alert alert-danger'>Erro: ".mysqli_error($con)."</div></div>";

    header('location:sorvete.php');

  }


}


}

function del_prod($con,$prod_id){

  $sql = "CALL DelProd(". $_POST['prod_id'].")";
  //die($sql);

  $oDados = mysqli_query($con, $sql);


  if ($oDados === TRUE) {


    $con->commit();

    echo '<script>
    document.location.href="sorvete.php";
    alert("Produto excluido com sucesso!");                
    </script>';
  }else{

    echo '<script>
    document.location.href="sorvete.php";
    alert("Não foi possível excluir produto!");    
    </script>';
   
  }


}


?>