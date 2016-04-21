<?php
class CCliente extends Cliente {
    
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
        parent::setServicos();
    }

    public function gravar(){
        
        /* consistencia de dados */
        if(strlen($_POST["nome"])<4 || strlen($_POST["nome"])>64)
            $this->setErro("Digite o nome completo, utilizando de 4 até 64 caracteres.");
        
        if(!in_array($_POST["sexo"],array('M','F')))
            $this->setErro("Sexo inválido.");
        
        if(strlen($_POST["cpf"])!=14)
            $this->setErro("CPF Inválido.");
        
        if(!in_array(strlen($_POST["telefone"]),array(13,14)))
            $this->setErro("Telefone inválido.");
            
        if(!in_array(strlen($_POST["telefone2"]),array(0,13,14)))
            $this->setErro("Telefone secundário inválido.");
        
        if(strlen($_POST["endereco_cep"])!=9)
            $this->setErro("CEP inválido.");
        
        $this->setNome();
        $this->setSexo();
        $this->setCpf();
        $this->setTelefone();    
        $this->setTelefone2();
        $this->setEndereco_cep();
        $this->setEndereco_complemento();
        $this->setEndereco_numero();
        
        if(!$this->getErro()){
            if($this->getId()){
                if($this->update()){
                    $this->setAlerta("Cliente atualizado com sucesso!");
                }
            }else{
                if($this->insert()){
                    $this->setId(parent::lastInsertId());
                    $this->setAlerta("Cliente inserido com sucesso!");
                }
            }
        }
    }
    
    public function excluir(){
        $n = $this->numRows("select 'x' from contrato where id_cliente = {$this->getId()}");
        if($n>0){
            $this->setErro("Este cliente não pode ser excluído pois está sendo utilizado em contrato(s).");
            $this->carregar();
        }elseif($this->delete()){
            $this->setId(0);
            $this->setAlerta("Cliente excluído com sucesso!");
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
