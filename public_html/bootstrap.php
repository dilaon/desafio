<?php
    $_GET["p"] = ($_GET["p"]) ? $_GET["p"] : 'cliente';
    $c = ucfirst($_GET["p"]);
    
    include "../PDO/Banco.php"; 
    include "../controller/Sistema.php"; 
    
    include "../model/{$c}.php"; 
    include "../controller/C{$c}.php"; 
    
    eval ("\$s = new C{$c}(\$_POST[\"acao\"]);");
    unset($c);
    
    $s->checkLogin();  