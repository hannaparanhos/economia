<?php 
include_once 'precos.php';


if (isset($_POST['computar'])) {

    $servico = $precos[$_POST['tipo_servico']];

    $tempo           = $servico['tempo_max'];
    $tempoInicio     = new DateTime($_POST['data_inicio']);
    $tempoFinal      = new DateTime($_POST['data_final']);
    $tempoSolicitado = $tempoInicio->diff($tempoFinal)->format('%a');

    $requ1 = $_POST['requisito1'];
    $requ2 = $_POST['requisito2'];
    $requ3 = $_POST['requisito3'];
    $rnfun = $_POST['requisito_no_f'];

    $requisitosTotal = array(
        "requ1Total" => $requ1 * $servico['requisito1'],
        "requ2total" => $requ2 * $servico['requisito2'],
        "requ3total" => $requ3 * $servico['requisito3'],
        "rnfuntotal" => $rnfun * $servico['requisito_no_f'],
    );

    $orcamentoSolicitado = $_POST['orcamento'];
    $orcamento           = array_sum($requisitosTotal);

    $squad = array();

    switch($_POST['tipo_servico']){
        case 'site':
            $squad = array(
                "PHP" => 1,
                "MySql" => 1,
                "Java" => 0,
                "JavaScript" => 1,
                "Design" => 1,
                "Infraestrutura" => 0,
                "Gerência" => 1,
                "HTML" => 1,
                "CSS" => 1,
                "ReactNative" => 0
            );
            break;

        case 'sistema':
            $squad = array(
                "PHP" => 0,
                "MySql" => 1,
                "Java" => 2,
                "JavaScript" => 0,
                "Design" => 1,
                "Infraestrutura" => 1,
                "Gerência" => 1,
                "HTML" => 0,
                "CSS" => 0,
                "ReactNative" => 0
            );
            break;

        case 'aplicacao_web':
            $squad = array(
                "PHP" => 2,
                "MySql" => 1,
                "Java" => 0,
                "JavaScript" => 1,
                "Design" => 1,
                "Infraestrutura" => 1,
                "Gerência" => 1,
                "HTML" => 1,
                "CSS" => 1,
                "ReactNative" => 0
            );

            break;
        case 'aplicativo':
            $squad = array(
                "PHP" => 0,
                "MySql" => 1,
                "Java" => 0,
                "JavaScript" => 2,
                "Design" => 1,
                "Infraestrutura" => 1,
                "Gerência" => 1,
                "HTML" => 0,
                "CSS" => 0,
                "ReactNative" => 3
            );
            break;
    }

}




?>