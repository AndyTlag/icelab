<?php

include_once(dirname(__FILE__) . '/session.php');


if((!isset ($_SESSION['txtLogin'])))
{
  unset($_SESSION['txtLogin']);
  header('location:login.php');
}

$logado = $_SESSION['txtLogin'];
$usu_id = $_SESSION['usu_id'];
$usu_nome = $_SESSION['usu_nome'];



?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
       
        <title>IceLab</title>
        
        <script src="asset/js/all.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="asset/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="asset/css/estilo.css">
        <link rel="shortcut icon" href="asset/img/favicon.png" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">IceLab</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#sobre">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#sorvete">Sorvetes</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contato">Contato</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="sorvete.php">Adicionar Sorvete</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="sair.php">Sair</a></li>


                


                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 text-uppercase">ICELAB</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Dinheiro não compra a felicidade, mas compra sorvete...</h2>
                    <a class="btn btn-primary js-scroll-trigger" href="#sobre">Ver mais</a>
                </div>
            </div>
        </header>
        <!-- sobre-->
        <section class="sobre-section text-center" id="sobre">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-white mb-4">Andressa Lima</h2>
                        <p class="text-white-50">Trabalho de Banco de Dados para o Professor Wellington Cidade</p>
                    </div>
                </div>
                <img class="img-fluid" src="asset/img/iceballs.png"/>
            </div>
        </section>

          <div class="row align-items-center no-gutters mb-4 mb-lg-5">
        
            <div class="col-xl-8 col-lg-7"></div>
                    
        </div>










        <!-- sorvete -->
        <div id="sorvete"></div>
        <div class="container">
            <div class="row">

                <?php


                    $sql = "SELECT * FROM " .Config::BD_PREFIX. "produto";

                    $oDados = mysqli_query($con, $sql);


                    if (mysqli_num_rows($oDados) === 0) {
                        echo("<h3>Não há produtos cadastrados ainda.</h3>");
                    }else{

                        while ($registro = mysqli_fetch_assoc($oDados)) {

                            echo '
                            <div class="col-md-4">

                                <div class="card" style="width: 18rem;">
                                  <img align="center" class="card-img-top prod_img" src="'.Config::SITE_UPLOAD_IMG.$registro['prod_img'].'">
                                  <div class="card-body">
                                    <h5 class="card-title">'.$registro['prod_nome'].'</h5>
                                    <p class="card-text">'.$registro['prod_desc'].'</p>
                                    <p class="card-text">R$'.$registro['prod_valor'].'</p>
                                    <a href="#" class="btn btn-primary">Comprar</a>
                                  </div>

                                </div>
                            </div>

                            
                            ';
                        }
                    }

                ?>
            </div>
        </div>

                
        <!-- sorvete -->










        <div class="row align-items-center no-gutters mb-4 mb-lg-5">
        
            <div class="col-xl-8 col-lg-7"></div>
                    
        </div>


        <!-- Novidades -->
        <section class="signup-section" id="signup">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto text-center">
                        <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                        <h2 class="text-white mb-5">Receber Novidades!</h2>
                        <form class="form-inline d-flex"><input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" type="email" placeholder="Insira seu melhor E-mail..." /><button class="btn btn-primary mx-auto" type="submit">Cadastrar</button></form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contato -->
        <section class="contact-section bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Endereço</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">Avenida Guaipá</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50"><a href="#!">icelab@icelab.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Telefone</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">(11) 9 7076-3349</div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </section>

        <?php 


          //ENCERRA A CONEXAO COM A BASE DE DADOS
          mysqli_close($con);


        ?>

        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © IceLab 2020</div></footer>
        <script src="asset/js/jquery-3.5.1.min.js"></script>
        <script src="asset/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="asset/js/scripts.js"></script>
    </body>
</html>
