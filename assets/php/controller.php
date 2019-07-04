<?php 
include 'precos.php';
include 'class/queryClasses.php';

global $relatorio;
global $pessoasEscolhidas;
global $pessoasEscolhidasFinal;

$relatorio = array();
$pessoasEscolhidasFinal = array();


if (isset($_POST['computar'])) {

    $query = new Query();

    $servico = $precos[$_POST['tipo_servico']];

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
    $orcamento           = ceil(array_sum($requisitosTotal));
    $orcamentoMargem     = ceil($orcamento * 0.95);

    $tempoMin        = ceil($servico['tempo'] * $orcamento);
    $tempoMinMargem  = ceil($tempoMin * 0.95);

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
                "ReactNative" => 2
            );
            break;
    }

    // Problemas:
    // 1 - Orcamento Abaixo da Margem de 5% para o tipo de projeto
    // 2 - Prazo impraticavel para a empresas para o tipo de porjeto 
    // 3 - Membros não podem ser alocados no projeto
    // 4 - Prazo e Orcamentos acima, mas sem membros => realizar processo de contratacao

    $problema = array();

    if($orcamentoSolicitado > $orcamento){

        if(verficaTempo($tempoSolicitado, $tempoMin, $tempoMinMargem) == 1){
            // nesse caso estamos em cenário ideal, onde o orcamento é maior e prazo também
            
            if(verificaEquipe(1, $query, $squad, $tempoInicio, $tempoFinal)){
                // se existe equipe pronta pra assunir o projeto => alocar pessoas e realizar projeto
                filtrarPessoas();
                fecharProjeto();

            }else{
                // não existe equipe para o projeto, nesse caso, um processo seletivo é recomendado => Problema 4 

                array_push($problema, 4);
            
            }

        }elseif(verficaTempo($tempoSolicitado, $tempoMin, $tempoMinMargem) == 2){
            // nesse caso temos o cenário onde o tempo está na margem de 5% e o orcamento acima do previsto  
            
            if(verificaEquipe(2, $query, $squad, $tempoInicio, $tempoFinal)){
                // se existe equipe, mas temos um tempo mais curto => alocar
                filtrarPessoas();
                fecharProjeto();
            
            }else{
                // não possuimos equipe, mas temos um tempo mais curto => Problema 2
                array_push($problema, 2);
            }
        }else{
            // possui prazo inferior a margem de 5% => Problema 2
            array_push($problema, 2);
        
        }

    }elseif($orcamentoSolicitado > $orcamentoMargem){
        // cenario onde o orcamento esta na margem de 5%

        if(verficaTempo($tempoSolicitado, $tempoMin, $tempoMinMargem) == 1){
            // nesse caso estamos em cenário onde o orcamento esta na margem e prazo na maergem correta 

            if(verificaEquipe(3, $query, $squad, $tempoInicio, $tempoFinal)){
                // se existe equipe pronta pra assunir o projeto => alocar pessoas e realizar projeto
                filtrarPessoas();
                fecharProjeto();

            }else{
                // se não existe equipe e orcamento esta na margem de 5% mesmo com prazo ok => Problema 1 e 3

                array_push($problema, 1);
                array_push($problema, 3);
            }

        }elseif(verficaTempo($tempoSolicitado, $tempoMin, $tempoMinMargem) == 2){
            // nesse caso temos o cenário onde o tempo está na margem de 5% e o orcamento esta na mergem de 5% => Problema 1 e 2
            // não verifica a equipe

            array_push($problema, 1);
            array_push($problema, 2);

        }else{
            // possui prazo inferior a margem de 5% e prazo inferior a 5% => Problema 1 e 2

            array_push($problema, 1);
            array_push($problema, 2);

        }

    }else{  // orcamento abaixo da margem de 5%
        array_push($problema, 1);
    }

}

function verficaTempo($tempoSolicitado, $tempoMin, $tempoMinMargem){

    // verifica os prazos do projeto

    if($tempoSolicitado > $tempoMin){   // se o tempo solocitado for maior que o tempo minimo => cenário ideal
        return 1;
    }elseif($tempoSolicitado > $tempoMinMargem){    // se o tempo solicitadoe estiver na margem de 5% => cenário médio
        return 2;
    }else{      // cenário onde o tempo é inferior a margem de 5% => verificar data de disponibilidade
        return 3;       
    }

}


function verificaEquipe($cenario ,$query, $squad, $tempoInicio, $tempoFinal){
    $habilidadesFinal = array();

    foreach($squad as $key => $s){
        if($s >= 1){
            array_push($habilidadesFinal, $key);
        }
    }

    $pessoasFinal = array();

    foreach($habilidadesFinal as $h){
        $pessoas = $query->getPessoasDisponiveisPorHabilidade(array(":habilidade" => $h, ":data_inicio" => $tempoInicio->format("%Y-%m-%d"), ":data_fim" => $tempoFinal->format("%Y-%m-%d")));
        if($pessoas){ // se existe pessoas para aquela habilidade
            array_push($pessoasFinal, $pessoas);
        }else{  // se não existe => verificar
            if($cenario == 1){
                array_push($GLOBALS['relatorio'], "O projeto tem grande potencial, vamos abrir um processo seletivo para a habilidade : " . $h);
                return false;
            }else{
                return false;
            }
        }
    }
    $GLOBALS['pessoasEscolhidas'] = $pessoasFinal;
    return true;
    
}

function filtrarPessoas(){

    foreach ($GLOBALS['pessoasEscolhidas'] as $hab) {
        array_push($GLOBALS['pessoasEscolhidasFinal'], $hab[0]);
    }
}

function fecharProjeto(){

    $squad = array(
        "PHP" => 2,
        "MySql" => 3,
        "Java" => 2,
        "JavaScript" => 2,
        "Design" => 1,
        "Infraestrutura" => 4,
        "Gerência" => 4,
        "HTML" => 6,
        "CSS" => 6,
        "ReactNative" => 1
    );

    $tipo_projeto = 0;

    switch($_POST['tipo_servico']){
        case 'site':
            $tipo_projeto = 3;
            break;
        case 'sistema':
            $tipo_projeto = 4;
            break;
        case 'aplicacao_web':
            $tipo_projeto = 2;
            break;
        case 'aplicativo':
            $tipo_projeto = 1;
            break;
    }

    $query =  new Query();
    $result = $query->assinaProjeto(array(
        ":tipo_projeto" => $tipo_projeto,
        ":requ1"        => $_POST['requisito1'],
        ":requ2"        => $_POST['requisito2'],
        ":requ3"        => $_POST['requisito3'],
        ":reqnf"        => $_POST['requisito_no_f'],
        ":inicio"       => $_POST['data_inicio'],
        ":fim"          => $_POST['data_final'],
        ":valor"        => $_POST['orcamento']
    ));

    if($result){
        foreach ($GLOBALS['pessoasEscolhidasFinal'] as $alocadas) {
            $query->inserePessoaProjeto(array(
                ":proj_id" => $result,
                ":func_id"=> $alocadas->id,
                ":func" => $squad[$alocadas->nome]
            ));
        }

        $_SESSION['grupo_projeto'] = $query->getPessoasPorProjeto(array(":projeto_id" => $result));

    }
}

?>