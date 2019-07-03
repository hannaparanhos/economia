<?php

    $precos = array(

        $reqApp = 191.57,
        "aplicativo" => array(
            "tempo" => 0.018,
            "requisito_no_f" => 79.90,
            "requisito1" => $reqApp,
            "requisito2" => $reqApp * 1.7,
            "requisito3" => $reqApp * 2.3,
        ),

        $reqAppWeb = 153.25,
        "aplicacao_web" => array(
            "requisito_no_f" => 69.90,
            "tempo" => 0.0144,
            "requisito1" => $reqAppWeb,
            "requisito2" => $reqAppWeb * 1.7,
            "requisito3" => $reqAppWeb * 2.3
        ),
    
        $reqSistema = 134.09,
        "sistema" => array(
            "requisito_no_f" => 59.90,
            "tempo" => 0.0126,
            "requisito1" => $reqSistema,
            "requisito2" => $reqSistema * 1.7,
            "requisito3" => $reqSistema * 2.3
        ),
        $reqSite = 57.47,
        "site" => array(
            "requisito_no_f" => 49.90 ,
            "tempo" => 0.01,
            "requisito1" => $reqSite,
            "requisito2" => $reqSite * 1.7,
            "requisito3" => $reqSite * 2.3,
        ),
    );
?>