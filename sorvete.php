<!DOCTYPE html>
<html lang="pt-BR">
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title>IceLab</title>

  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" ></script>
  <!-- Google fonts-->

  <!-- Core theme CSS (includes Bootstrap)-->
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
          <label for="prod_descricao" class="col-sm-2 col-form-label">
            Descrição
          </label>
          <div class="col-sm-10">
            <textarea id="prod_descricao" name="prod_descricao" class="form-control" minlength="3" required>
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

<br>

<div class="container">   
  <table class="table">
    <thead>
      <tr>
        <td></td>
        <td>Nome</td>
        <td>Valor</td>
        <td>Descrição</td>
        <td colspan="2">Editar</td>
        <td colspan="2">Excluir</td>
      </tr>
    </thead>
    <tbody>

      <?php 
      include_once(dirname(__FILE__) . '/Config.class.php');
      include_once(dirname(__FILE__) . '/conexao.php');

      ?>

      <?php


      $cSQL = "SELECT * FROM " .Config::BD_PREFIX. "produto";



      $oDados = mysqli_query($con, $cSQL);

      while ($registro = mysqli_fetch_assoc($oDados)) {

                                                //listar sorvete
        echo '



        <li class="list-group-item">
        <h5 class="list-group-item-heading">'
        .$registro['prod_nome'].
        '</h5>

        <p class="list-group-item-text">'.$registro['prod_descricao'].'

        </p>
        ';

                                                //botao de exclusao

        echo '

        <div class="pull-right">
        <button data-toggle="modal" data-target="#excluir_prod'.$registro['prod_id'].'" class="btn btn-danger">
        <i class="pe-7s-trash"></i>
        </button>
        </div>

        ';

                                                //modal de exclusao

        echo '

        <div class="modal" id="excluir_prod'.$registro['prod_id'].'">
        <div class="modal-dialog">
        <div class="modal-content">


        <div class="modal-header">
        <h4 class="modal-title">Você deseja excluir essa tarefa?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>


        <div class="modal-body">
        '.$registro['prod_nome'].' - '.$registro['prod_descricao'].'

        </div>



        <div class="modal-footer">
        <form action="excluir.php" method="post">

        <button class="btn btn-danger">Excluir</button>
        <input type="hidden" name="action" value="excluir_prod">
        <input type="hidden" name="prod_id" value="'.$registro['prod_id'].'">
        </form>
        </div>

        </div>
        </div>
        </div>



        ';

                                                //botao de edicao

        echo '

        <div class="pull-right">
        <button type="button" class="btn btn-warning  btn-toggle" data-element="#'.$registro['prod_id'].'" value="">
        <i class="pe-7s-note"></i>

        </button>
        </div>

        ';

                                                //form de edicao

        echo '

        <div class="form-group" id="'.$registro['prod_id'].'" style="display:none">

        <form action="edita.php" method="post">
        <div class="form-row">

        <div class="col-md-6">
        <div class="position-relative form-group">
        <label for="prod_nome" class="">
        Tarefa
        </label>
        <input name="prod_nome" id="prod_nome" placeholder="Nome da Tarefa" type="text" class="form-control" minlength="3" required value="'.$registro['prod_nome'].'">
        </div>
        </div>


        <div class="col-md-10">
        <div class="position-relative form-group">
        <label for="prod_descricao" class="">
        Descrição
        </label>

        <textarea id="prod_descricao" name="prod_descricao" class="form-control"  minlength="3" required>

        '.$registro['prod_descricao'].'

        </textarea>

        </div>
        </div>

        </div>

        <button class="mt-2 btn btn-success">Editar</button>

        <input type="hidden" name="action" value="edita_prod">
        <input type="hidden" name="prod_id" value="'.$registro['prod_id'].'">

        </form>

        </div>
        </li>




        '
        ;




      }


      ?>



    </tbody>
  </table>
</div>


</body>
</html>