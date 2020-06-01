<?php

include_once(dirname(__FILE__) . '/Config.class.php');
include_once(dirname(__FILE__) . '/conexao.php');

if ($_POST['action'] == "cad_prod") {
	cad_prod($con);
}

if ($_POST['action'] == "upd_prod") {
	upd_prod($con, $_POST['prod_id'], $_POST['prod_img']);
}

if ($_POST['action'] == "del_prod") {
	del_prod($con, $_POST['prod_id'], $_POST['prod_img']);
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
          '<script>
          document.location.href=sorvete.php";
          alert("Produto cadastrado com sucesso!");                
          </script>';

          header('location:sorvete.php');

        }else{
         '<script>
         document.location.href=sorvete.php";
         alert("'.mysqli_error($con).'");                
         </script>';

         header('location:sorvete.php');

       }


     }

   }

   function upd_prod($con, $prod_id, $prod_img){

    $prod_nome=$_POST['prod_nome'];
    $prod_valor=$_POST['prod_valor'];
    $prod_valor= str_replace(",", ".", $prod_valor);
    $prod_desc=$_POST['prod_desc'];
    $prod_img=$_FILES['prod_img'];


    if ($_FILES['prod_img']['name'] > '0'){

     $arquivo = Config::SITE_UPLOAD_IMG.$_POST['prod_img'];
     //die($arquivo);

     if(file_exists($arquivo)){
      array_map( "unlink", glob($arquivo));     
    }

    $extensao =  strtolower(substr($prod_img['name'], -4)); 
    $novo_nome = md5(time()) . $extensao; 
    $diretorio = Config::SITE_UPLOAD_IMG;
    move_uploaded_file($prod_img['tmp_name'], $diretorio.$novo_nome);

  }

  if (isset($prod_nome) || ($prod_valor) || ($prod_desc) || ($prod_img)){

      //$sqlimg= "CALL SelProd(". $_POST['prod_id'].")"; Esse funciona, mas a função não aceita chamar 2 procedures, senão a procedure de update retorna falso. Se deixar o select direto, o update retorna true
    $sqlimg= "SELECT * FROM ".Config::BD_PREFIX."produto 
    WHERE prod_id=".$_POST['prod_id'];

    $dadosimg = mysqli_query($con, $sqlimg);

    $nome_anterior = mysqli_fetch_assoc($dadosimg);

    $nome_anterior=$nome_anterior['prod_img'];


    if (isset($novo_nome)) {

      $sql = "CALL UpdProd('". $_POST['prod_id']."','$prod_nome', '$prod_valor', '$prod_desc', '$novo_nome')";
    }else{

      $sql = "CALL UpdProd('". $_POST['prod_id']."', '$prod_nome', '$prod_valor', '$prod_desc', '$nome_anterior')";
    }


    $oDados = mysqli_query($con, $sql);

    if ($oDados === TRUE) {

     '<script>
     document.location.href=sorvete.php";
     alert("Produto editado com sucesso!");                
     </script>';

     header('location:sorvete.php');

   }else{

    '<script>
    document.location.href=sorvete.php";
    alert("'.mysqli_error($con).'");                
    </script>';


    header('location:sorvete.php');

  }


}


}

function del_prod($con,$prod_id,$prod_img){

  $sql = "CALL DelProd(". $_POST['prod_id'].")";


  $oDados = mysqli_query($con, $sql);


  if ($oDados === TRUE) {


    $arquivo = Config::SITE_UPLOAD_IMG.$_POST['prod_img'];

    if(file_exists($arquivo)){
      array_map( "unlink", glob($arquivo));     
    }


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