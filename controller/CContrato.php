<?php
class CContrato extends Contrato {
    
    private $metodo;
    private $lista;
    
    public function __construct($acao){
        
        parent::__construct();
        
        $this->setMetodo();
        $this->setId($_GET["id"]);
        
        if($this->getMetodo()=='form'){

            switch($acao){
                case 'E':
                    $this->excluir();
                    break;
                case 'G':
                    $this->gravar();
                default:
                    $this->carregar();
            }
        }else{
            $this->setLista();
        }
        
    }

    public function carregar(){
        parent::select();
    }

    public function gravar(){
        
        /* consistencia de dados */
        if(!$this->dataCheck($_POST["data_inicio"]))
            $this->setErro("Data de início inválida.");
        
        if(!$this->dataCheck($_POST["data_fim"]))
            $this->setErro("Data de término inválida.");
        
        if(!$this->dataCmp($_POST["data_inicio"],$_POST["data_fim"]))
            $this->setErro("Intervalo de datas inválido.");
        
        $this->setId_cliente();
        $this->setId_servico();
        $this->setData_inicio();
        $this->setData_fim();
        
        if(!$this->getErro()){
            if($this->getId()){
                if($this->update()){
                    $this->setAlerta("Contrato atualizado com sucesso!");
                }
            }else{
                if($this->insert()){
                    $this->setId(parent::lastInsertId());
                    $this->setAlerta("Contrato inserido com sucesso!");
                }
            }
        }
    }
    
    public function excluir(){
        if($this->delete()){
            $this->setId(0);
            $this->setAlerta("Contrato excluído com sucesso!");  
        }
    }

    public function optionCliente(){
        $rs = $this->fetchAssoc("select id, nome from cliente order by nome");
        foreach($rs as $r){
            $return .= "<option value=\"{$r['id']}\"";
            if($this->getId_cliente()==$r["id"]) $return .= " selected=\"selected\"";
            $return .= ">{$r['nome']}</option>\n";
        }
        return $return;
    }
    
    public function optionServico(){
        $rs = $this->fetchAssoc("select id, nome from servico order by nome");
        foreach($rs as $r){
            $return .= "<option value=\"{$r['id']}\"";
            if($this->getId_servico()==$r["id"]) $return .= " selected=\"selected\"";
            $return .= ">{$r['nome']}</option>\n";
        }
        return $return;
    }
    
    function getMetodo(){
        return $this->metodo;
    }

    function setMetodo(){
        $this->metodo = ($_GET["metodo"]=='pesquisa') ? 'pesquisa' : 'form';
    }

    function getLista(){
        return $this->lista;
    }

    function setLista(){
        $this->lista = $this->selectAll();
    }


    
}
