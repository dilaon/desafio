<?php
class CServico extends Servico {
    
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
        if(strlen($_POST["nome"])<4 || strlen($_POST["nome"])>64)
            $this->setErro("Digite o nome do serviço.");

        $this->setNome();
        
        if(!$this->getErro()){
            if($this->getId()){
                if($this->update()){
                    $this->setAlerta("Serviço atualizado com sucesso!");
                }
            }else{
                if($this->insert()){
                    $this->setId(parent::lastInsertId());
                    $this->setAlerta("Serviço inserido com sucesso!");
                }
            }
        }
    }
    
    public function excluir(){
        $n = $this->numRows("select 'x' from contrato where id_servico = {$this->getId()}");
        if($n>0){
            $this->setErro("Este serviço não pode ser excluído pois está sendo utilizado em contrato(s).");
            $this->carregar();
        }elseif($this->delete()){
            $this->setId(0);
            $this->setAlerta("Serviço excluído com sucesso!");  
        }
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
