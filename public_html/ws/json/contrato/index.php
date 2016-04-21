<?php 
    include "../../../../PDO/Banco.php"; 
    include "../../../../controller/Sistema.php"; 
    include "../../../../model/Contrato.php"; 
    include "../../../../controller/CContrato.php"; 
   
    $s = new CContrato(null);
    $s->setLista();
    
    $r = "{ \"contratos\":[\n";
    foreach($s->getLista() as $lista){
        $i++;
        $r .= "  {";
        $r .= "\"id\":{$lista["id"]}, ";
        $r .= "\"cliente\":\"{$lista["cliente"]}\", ";
        $r .= "\"servico\":\"{$lista["servico"]}\", ";
        $r .= "\"inicio\":\"{$lista["data_inicio"]}\", ";
        $r .= "\"termino\":\"{$lista["data_fim"]}\"";
        $r .= ($i<count($s->getLista())) ? "},\n" : "}\n";
    }
    $r .=  "]}";
    echo utf8_decode($r);