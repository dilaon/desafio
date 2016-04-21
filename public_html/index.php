<?php
    include 'bootstrap.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Desafio Técnico</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.ui.css" />
        
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="js/jquery.ui.js"></script>
        <script type="text/javascript" src="js/jquery.ui.core.js"></script>
        <script type="text/javascript" src="js/sistema.js"></script>
        <script type="text/javascript" src="js/<?=$_GET["p"]?>.js"></script>
    </head>
    <body>
        <div id="menu">
            <ul>
                <li><a href="?p=cliente">Clientes</a></li>
                <li><a href="?p=servico">Serviços</a></li> 
                <li><a href="?p=contrato">Contratos</a></li> 
                <li><a href="sair.php">Sair</a></li> 
            </ul>
        </div>
<?php include "{$_GET["p"]}.php"; ?>
    </body>
</html>