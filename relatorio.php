<?php
require_once 'assets/php/controller.php';
$pro = array(
  1 => '<li class="nav-item mx-auto">
          <a class="nav-link active show" href="#dashboard-1" role="tab" data-toggle="tab" aria-selected="true">
            <i class="material-icons">attach_money</i> Orçamento
          </a>
        </li> @ <div class="tab-pane active show" id="dashboard-1">
          Infelizmente o orçamento apontado não é compatível com nossos preços.
          <br>
          Tente aumentar o seu orcamento e realize novamente o GROP.
        </div>',
  2 => '<li class="nav-item mx-auto">
          <a class="nav-link" href="#schedule-1" role="tab" data-toggle="tab" aria-selected="false">
            <i class="material-icons">schedule</i> Prazo
          </a>
        </li> @ <div class="tab-pane" id="schedule-1">
          O prazo que você apontou infelizmente é impraticável pela empresa.
          <br>
          Realize uma nova pesquisa com um prazo maior.
        </div>',
  3 => '<li class="nav-item mx-auto">
          <a class="nav-link" href="#tasks-1" role="tab" data-toggle="tab" aria-selected="false">
            <i class="material-icons">list</i> Equipe
          </a>
        </li> @ <div class="tab-pane" id="tasks-1">
        Nossa equipe não consegue atender solicitação no momento.
        <br>
        Tente aumentar o seu orcamento e prazo e realize novamente o GROP.
      </div>'
)
?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Relatório
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-kit.css?v=2.0.5" rel="stylesheet" />
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-color-on-scroll navbar-transparent fixed-top navbar-expand-lg" color-on-scroll="100">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="index.php">
          GROP </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
      </div>
    </div>
  </nav>
  <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('./assets/img/bg2.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1 class="text-center">Seu Relatório</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main main-raised">
    <div class="container">
      <div class="section text-center">

        <!-- Ixi, não da pra fazer -->
        <?php if (!empty($problema)) { ?>
          <div class="alert alert-danger">
            <div class="container">
              <div class="alert-icon">
                <i class="material-icons">error_outline</i>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
              </button>
              <b>Desculpe!</b> Infelizmente não podemos realizar seu projeto pelas seguintes razões :
            </div>
          </div>
          <?php if ($problema[0] != 4) { ?>
            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills nav-pills-info nav-pills-icons" role="tablist">
                  <? foreach ($problema as $p) {
                    echo explode('@', $pro[$p])[0];
                  } ?>
                </ul>
                <div class="tab-content tab-space">
                  <? foreach ($problema as $p) {
                    echo explode('@', $pro[$p])[1];
                  } ?>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="row">
              <div class="col-md-12">
                <i class="material-icons">show_chart</i>
                <?php foreach ($GLOBALS['relatorio'] as $hab) {
                  echo $hab;
                } ?>
              </div>
            </div>
          <?php } ?>
          <!-- Fim do não da pra fazer -->
        <?php } ?>

        <?php if (isset($_SESSION['grupo_projeto'])) { ?>
          <!-- Deu pra fazer -->
          <div class="alert alert-success">
            <div class="container">
              <div class="alert-icon">
                <i class="material-icons">check</i>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
              </button>
              <b>Successo:</b> Conseguimos separar uma equipe fenomenal para realizar seu projeto!
            </div>
          </div>

          <div class="row py-5">
            <?php foreach ($_SESSION['grupo_projeto'] as $key => $p) { ?>
              <div class="col-md-3">
                <div class="card card-login">
                  <div class="card-header card-header-primary text-center">
                    <h4 class="card-title"><?= $key ?></h4>
                    <img src="<?= $p[0]['foto'] ?>" alt="Circle Image" class="rounded-circle img-fluid w-50">
                  </div>
                  <div class="card-body">
                    <?php foreach ($p as $h) {
                      $nivel = ceil($h['nivel'] * 33.33);
                      ?>
                      <span class="bmd-form-group">
                        <?= $h['hab_nome'] ?>
                        <div class="progress progress-line-primary">
                          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?= ($nivel) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= ($nivel) ?>%;">
                            <span class="sr-only">60% Complete</span>
                          </div>
                        </div>
                      </span>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>

        <!-- Fim deu pra fazer -->

      </div>
    </div>
  </div>
  <footer class="footer footer-default">
    <div class="container">
      <nav class="float-left">
        <ul>
          <li>
            <a href="https://www.creative-tim.com/">
              G.R.O.P.
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
        <script>
          document.write(new Date().getFullYear())
        </script>, feito com <i class="material-icons">favorite</i>
      </div>
    </div>
  </footer>


  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>

</body>

</html>