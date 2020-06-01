<?php 
include_once(dirname(__FILE__) . '/session.php');
include_once(dirname(__FILE__) . '/Config.class.php');
include_once(dirname(__FILE__) . '/conexao.php');



if((!isset ($_SESSION['txtLogin'])))
{
  unset($_SESSION['txtLogin']);
  header('location:login.php');
}

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title>IceLab</title>

  <script src="asset/js/all.js" ></script>
  <script src="asset/js/jquery-3.5.1.min.js"></script>
  <script src="asset/js/bootstrap.js"></script>
  <link rel="stylesheet" href="asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="asset/css/styles.css">
  <link rel="stylesheet" type="text/css" href="asset/css/estilo.css">
  <link rel="shortcut icon" href="asset/img/favicon.png">

  <script>


    $(function() {
      $(".btn-toggle").click(function(e) {
        e.preventDefault();
        el = $(this).data('element');
        $(el).toggle();
      });
    });


  </script>
</head>

<nav class="navbar navbar-light bg-light">
  <span class="navbar-brand mb-0 h1"><a class="navbar-brand js-scroll-trigger" href="index.php"> 
    <img src="asset/img/icon.svg" width="7%">&nbsp;Icelab 
  </a>
</span>
<ul class="navbar-nav ml-auto"> 
  <li class="nav-item">
    <a class="nav-link js-scroll-trigger" href="sair.php">Sair
    </a>
  </li>
</ul>
</nav>



<!-- INICIO ÁREA CADASTRO -->

<div class="container">

  <br>
  <div class="form-group">
    <button type="button" class="btn btn-success  btn-toggle" data-element="#cad_prod">
      Cadastrar Produto&nbsp;

    </button>
  </div>
  <div class="form-group" id="cad_prod" style="display:none; margin-left: -1%">

    <div class="main-card mb-3 card">
      <form action="crud.php" method="post" enctype="multipart/form-data">


        <div class="position-relative row form-group">
          <label for="prod_nome" class="col-sm-2 col-form-label">
            Nome
          </label>
          <div class="col-sm-10">
            <input name="prod_nome" id="prod_nome" placeholder="Nome do Produto" type="text" class="form-control" minlength="3" required="">
          </div>
        </div>


        <div class="position-relative row form-group">
          <label for="prod_valor" class="col-sm-2 col-form-label">
            Valor
          </label>
          <div class="col-sm-10">
            <input name="prod_valor" id="prod_valor" placeholder="Valor do Produto" type="text" class="form-control" required>
          </div>
        </div>


        <div class="position-relative row form-group">
          <label for="prod_desc" class="col-sm-2 col-form-label">
            Descrição
          </label>
          <div class="col-sm-10">
            <textarea id="prod_desc" name="prod_desc" class="form-control" minlength="3" required>
            </textarea>
          </div>
        </div>

        <div class="position-relative row form-group">
          <label for="prod_img" class="col-sm-2 col-form-label ">
            Imagem
          </label>
          <div class="col-sm-10">
            <input name="prod_img" id="prod_img" type="file" class="form-control icefile" required>
          </div>
        </div>


        <div class="position-relative row form-check">
          <div class="col-sm-10 offset-sm-2">
            <button class="btn btn-success">Cadastrar</button>
            <input type="hidden" name="action" value="cad_prod">
          </div>
        </div>

      </form>

    </div>
  </div>     
</div>

<hr>

<!-- FIM AREA CADASTRO -->

<br>


<div class="col-md-12">
  <div class="card-body">
    <h5 class="card-title">Lista de Produtos</h5>

    <?php


    $cSQL = "SELECT * FROM " .Config::BD_PREFIX. "produto ORDER BY prod_id DESC";



    $oDados = mysqli_query($con, $cSQL);


    if (mysqli_num_rows($oDados) === 0) {
     echo("<h3>Não há produtos cadastrados ainda.</h3>");
    }else{

    while ($registro = mysqli_fetch_assoc($oDados)) {

                                                //listar sorvete
      echo '

      <div class="card mb-3">
      <div class="row">




      <div class="col-md-4">
      <div class="card" style="width: 18rem;">
      <img class="card-img-top prod_img" src="'.Config::SITE_UPLOAD_IMG.$registro['prod_img'].'">
      <div class="card-body">
      <h5 class="card-title">'.$registro['prod_nome'].'</h5>
      <h6 class="card-subtitle mb-2 text-muted">R$ '.$registro['prod_valor'].'</h6>
      <p class="card-text">'.$registro['prod_desc'].'</p>


      ';

                                                //botao de exclusao

      echo '

      <button data-toggle="modal" data-target="#del_prod'.$registro['prod_id'].'" class=" btn-danger btndel">
      <i class="fa fa-trash"></i>
      </button>

      ';

                                                //modal de exclusao

      echo '

      <div class="modal" id="del_prod'.$registro['prod_id'].'">
      <div class="modal-dialog">
      <div class="modal-content">


      <div class="modal-header">
      <h4 class="modal-title">Você deseja excluir esse produto?</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>


      <div class="modal-body">
      <img width="8%"  src="'.Config::SITE_UPLOAD_IMG.$registro['prod_img'].'">
      '.$registro['prod_nome'].' - R$'.$registro['prod_valor'].'

      </div>



      <div class="modal-footer">
      <form action="crud.php" method="post">

      <button class=" btn-danger">Excluir</button>
      <input type="hidden" name="action" value="del_prod">
      <input type="hidden" name="prod_id" value="'.$registro['prod_id'].'">
      <input type="hidden" name="prod_img" value="'.$registro['prod_img'].'">
      </form>
      </div>

      </div>
      </div>
      </div>



      ';

                                                //botao de edicao

      echo '

      <button type="button" class=" btn-warning btn-toggle btnedit" data-element="#'.$registro['prod_id'].'" value="">
      <i class="fa fa-edit"></i>

      </button>

      </div> 
      </div>
      </div>

      ';
      
      //As 3 ultimas divs acima fecham o card de listar o produto

                                                //form de edicao

      echo '
      <div class="col-md-8">
      <div class="form-group" id="'.$registro['prod_id'].'" style="display:none">

      <form action="crud.php" method="post" enctype="multipart/form-data">


      <div class="position-relative row form-group">
      <label for="prod_nome" class="col-sm-2 col-form-label">
      Nome
      </label>
      <div class="col-sm-10">
      <input name="prod_nome" id="prod_nome" placeholder="Nome do Produto" type="text" class="form-control" minlength="3" required value="'.$registro['prod_nome'].'">
      </div>
      </div>


      <div class="position-relative row form-group">
      <label for="prod_valor" class="col-sm-2 col-form-label">
      Valor
      </label>
      <div class="col-sm-10">
      <input name="prod_valor" id="prod_valor" placeholder="Valor do Produto" type="text" class="form-control" required value="'.$registro['prod_valor'].'">
      </div>
      </div>


      <div class="position-relative row form-group">
      <label for="prod_desc" class="col-sm-2 col-form-label">
      Descrição
      </label>
      <div class="col-sm-10">
      <textarea id="prod_desc" name="prod_desc" class="form-control" minlength="3" required>
      '.$registro['prod_desc'].'
      </textarea>
      </div>
      </div>

      <div class="position-relative row form-group">
      <label for="prod_img" class="col-sm-2 col-form-label ">
      Imagem
      </label>
      <div class="col-sm-10">
      <input name="prod_img" id="prod_img" type="file" class="form-control icefile"  value="0">
      </div>
      </div>



      <button class="mt-2 btn btn-success">Editar</button>

      <input type="hidden" name="action" value="upd_prod">
      <input type="hidden" name="prod_id" value="'.$registro['prod_id'].'">
      <input type="hidden" name="prod_img" value="'.$registro['prod_img'].'">

      </form>

      </div>
      </div>
      </div>



      </div>




      '
      ;




    }
    }


    ?>

  </div>
</div>


</body>
</html>