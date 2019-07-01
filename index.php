<?php

if (isset($_POST['computar'])) {
  var_dump($_POST);
}

?>


<!doctype html>
<html lang="pt-br">

<head>
  <title>GROP</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-kit.css?v=2.0.5" rel="stylesheet" />
</head>

<body class="index-page sidebar-collapse">
  <nav class="navbar navbar-color-on-scroll navbar-transparent fixed-top navbar-expand-lg" color-on-scroll="100">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="https://demos.creative-tim.com/material-kit/index.html">
          GROP </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="material-icons">apps</i> Template
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('assets/img/bg3.jpg')">
    <div class="container">
      <div class="row">
        <div class="col-md-12 ml-auto mr-auto">
          <div class="brand text-center">
            <h1>GROP</h1>
            <h3 class="title text-center">Gerenciamento de Recursos para Otimização de Projetos</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="main main-raised">
    <div class="container">
      <div class="row py-5">
        <div class="col-md-12">
          <div class="card card-nav-tabs">
            <div class="card-header card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <ul class="nav nav-tabs mx-auto" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#projeto" data-toggle="tab">
                        <i class="material-icons">build</i> Projeto
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#requisitos" data-toggle="tab">
                        <i class="material-icons">dashboard</i> Requisitos
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#enviar" data-toggle="tab">
                        <i class="material-icons">email</i> Enviar
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body py-5">
              <form action="index.php" method="post">
                <div class="tab-content">
                  <div class="tab-pane active" id="projeto">
                    <div class="row">
                      <div class="col-md-4">
                        <p> Tipo de Projeto</p>
                        <div class="form-group text-left">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="tipo_servico" value="site"> Web Site
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="tipo_servico" value="aplicacao_web"> Aplicação Web
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="tipo_servico" value="sistema"> Sistema
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="tipo_servico" value="aplicativo"> Aplicativo
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <p> Orçamento</p>
                        <div class="form-group text-left">
                          <label for="orcamento" class="bmd-label-floating">Quanto está disposto a pagar ?</label>
                          <input type="text" class="form-control" name="orcamento">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-left">

                          <label for="datainicio" class="bmd-label-floating">Data de Início</label>
                          <input type="date" class="form-control" name="datainicio">

                          <br>
                          <br>
                         <label for="datafinal" class="bmd-label-floating">Data Final</label>
                            <input type="date" class="form-control" name="datafinal">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="requisitos">
                    <div class="row">
                      <div class="col-md-3">
                        <p> Requisitos Funcionais Básicos</p>
                        <div class="form-group text-left">
                          <input type="text" class="form-control" name="rbasico">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <p> Requisitos Funcionais Intermediários</p>
                        <div class="form-group text-left">
                          <input type="text" class="form-control" name="rinter">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <p> Requisitos Funcionais Avançados</p>
                        <div class="form-group text-left">
                          <input type="text" class="form-control" name="ravancado">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <p> Requisitos Não Funcionais</p>
                        <div class="form-group text-left">
                          <input type="text" class="form-control" name="rnaofuncional">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="enviar">
                    <div class="row">
                      <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg" name="computar">Submit</button>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer footer-default">
    <div class="container">
      <nav class="float-left">
        <ul>
          <li>
            <a href="#">
              G.R.O.P.
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>,Feito com <i class="material-icons">favorite</i>
      </div>
    </div>
  </footer>
</body>

<script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>

</html>