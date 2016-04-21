<?php
class Cliente extends Sistema{
    
    private $id;
    private $nome;
    private $sexo;
    private $cpf;
    private $telefone;
    private $telefone2;
    private $endereco_cep;
    private $endereco_numero;
    private $endereco_complemento;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function select(){
        if($this->id>0){
            $arr = $this->fetchAssoc("select * from cliente where id = ?", $this->id);
            foreach($arr[0] as $k=>$v){
                 $this->$k=$v;
            }
        }
    }
    
    public function selectAll(){
        return $this->fetchAssoc("select * from cliente");
    }
    
    public function update(){
        return $this->query("update cliente set nome=?, sexo=?, cpf=?, telefone=?, telefone2=?, "
                          . "endereco_cep=?, endereco_numero=?, endereco_complemento=? "
                          . "where id = ?",

                            array($this->nome, $this->sexo, $this->cpf, $this->telefone, $this->telefone2,
                                  $this->endereco_cep, $this->endereco_numero, $this->endereco_complemento,
                                  $this->id));
    }
    
    public function insert(){
        return $this->query("insert into cliente (nome, sexo, cpf, telefone, telefone2, "
                          . "endereco_cep, endereco_numero, endereco_complemento) "
                          . "values (?,?,?,?,?,?,?,?)",
            
                            array($this->nome, $this->sexo, $this->cpf, $this->telefone, $this->telefone2,
                                  $this->endereco_cep, $this->endereco_numero, $this->endereco_complemento));
    }
    
    public function delete(){
        return $this->query("delete from cliente where id=?",$this->id);
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getTelefone2() {
        return $this->telefone2;
    }

    function getEndereco_cep() {
        return $this->endereco_cep;
    }

    function getEndereco_numero() {
        return $this->endereco_numero;
    }

    function getEndereco_complemento() {
        return $this->endereco_complemento;
    }

    function setId($id=null) {
        $this->id = (is_numeric($id)) ? $id : (($_POST["id"]) ? $_POST["id"] : $_GET["id"]);
        if($this->id>0){
            $n = $this->numRows("select 'x' from cliente where id = {$this->id}");
            $this->id = ($n==1) ? $this->id : null;
        }
    }

    function setNome() {
        $this->nome = $_POST["nome"];
    }

    function setSexo() {
        $this->sexo = $_POST["sexo"];
    }

    function setCpf() {
        $this->cpf = $_POST["cpf"];
    }

    function setTelefone() {
        $this->telefone = $_POST["telefone"];
    }

    function setTelefone2() {
        $this->telefone2 = $_POST["telefone2"];
    }

    function setEndereco_cep() {
        $this->endereco_cep = $_POST["endereco_cep"];
    }

    function setEndereco_numero() {
        $this->endereco_numero = $_POST["endereco_numero"];
    }

    function setEndereco_complemento() {
        $this->endereco_complemento = $_POST["endereco_complemento"];
    }




    
}
