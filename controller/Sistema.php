<?php

class Sistema extends Banco{
    
    public $erro = array();
    public $alerta = null;
    
    public function checkLogin(){
        session_start();
        if($_SESSION["user"]["id"])
            return true;
        session_destroy();
        header("Location: login.php");
        return false;
    }
    
    public function userLogin(){
        session_start();
        if(empty($_SESSION['captcha']) || trim(strtolower($_POST["captcha_input"])) != $_SESSION['captcha']){
            $this->setErro("A palavra-chave não foi digitada corretamente, digite como a lê na imagem.");
            return false;
        }
        
        $arr = $this->fetchAssoc("select id, nome from usuario where nome=? and senha=md5(?)", 
                                 array($_POST["nome"], $_POST["senha"]));

        if(!$this->getErro() && $arr[0]["id"]>0){
            session_start();
            /* duração: 1 ano */
            if($_POST["manter_conectado"]=='S')
                session_cache_expire(525600); 
            
            $_SESSION["user"]["id"]   = $arr[0]["id"];
            $_SESSION["user"]["nome"] = $arr[0]["nome"];
            session_write_close();  
            return true;
        }
        $this->setErro("Login inválido.");
        return false;
    }
    
    public function userLogout(){
        session_start();
        session_destroy();
        header("Location: login.php");
    }
    
    public function dataCheck($data){ 
        $d = explode('/', $data);
        if(count($d)==3)
            if(@checkdate($d[1], $d[0], $d[2]))
                return true;
        return false;
    }
    
    public function dataCmp($data1, $data2){ 
        $d1 = explode('/', $data1);
        $d2 = explode('/', $data2);
        $d1 = (int) "{$d1[2]}{$d1[1]}{$d1[0]}"; 
        $d2 = (int) "{$d2[2]}{$d2[1]}{$d2[0]}";
        if($d1<=$d2)
            return true;
        return false;
    }
    
    public function dataPrepare($data){ 
        $d = explode('/', $data);
        return "{$d[2]}-{$d[1]}-{$d[0]}"; 
    }
    
    function getErro() {
        if(!empty($this->erro))
            return "<label>O envio falhou:<ul><li>".(implode('</li><li>',$this->erro))."</li></ul></label>";
        return null;
    }

    function setErro($erro) {
        $this->erro[] = $erro;
    }

    function getAlerta() {
        if(!empty($this->alerta))
            return "<label>{$this->alerta}</label>";
        return null;
    }

    function setAlerta($alerta) {
        $this->alerta = $alerta;
    }

}