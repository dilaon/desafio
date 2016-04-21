<?php
    include "../PDO/Banco.php"; 
    include "../controller/Sistema.php";
    $s = new Sistema;
        
    if($_POST)
        $s->userLogin();
    
    if($_SESSION["user"]["id"])
        header('Location: index.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Desafio Técnico - Login</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
        <script type="text/javascript" src="js/sistema.js"></script>
    </head>
    <body>
        <form method="post" action="">
            <div class="box"> 
		<h1>Login</h1>
                <label>
                    Utilize usuário = 'tester' e senha = '1234'
                </label>
                <?=($s->getErro()) ? $s->getErro() : ''?>
                <label>
                    <span class="prompt">Usuário:</span>
                    <input class="campo" type="text" name="nome" id="nome" value="<?=$_POST["nome"]?>" />
                </label>
                <label>
                    <span class="prompt">Senha:</span>
                    <input class="campo" type="password" name="senha" id="senha" />
                </label>
                <label class="centro">
                    <img class="captcha" id="captcha" src="captcha.php"/><br />
                    <button type="button" onclick="captchaReload()">Trocar palavra</button>
                </label>
                <label>
                    <span class="prompt">Captcha:</span>
                    <input name="captcha_input" type="text" id="captcha_input" maxlength="14" />
                </label>
                <label class="centro">
                    <input name="manter_conectado" value="S" type="checkbox" id="manter_conectado"<?=($_POST["manter_conectado"]=='S') ?' checked="checked"':''?> />
                    Manter conectado
                </label>
                <label class="centro">
                    <button type="submit">Entrar</button>
                </label>
            </div>
        </form> 
        <div class="box">
            <h1>Web Service</h1>
            <label>Exportação dos registros de contratações (JSON): <a target="_blank" href="ws/json/contrato">/ws/json/contrato</a></label>
        </div> 
    </body>
</html>