<?php
class Servico extends Sistema{
    
    private $id;
    private $nome;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function select(){
        if($this->id>0){
            $arr = $this->fetchAssoc("select * from servico where id = ?", $this->id);
            foreach($arr[0] as $k=>$v){
                 $this->$k=$v;
            }
        }
    }
    
    public function selectAll(){
        return $this->fetchAssoc("select * from servico");
    }
    
    public function update(){
        return $this->query("update servico set nome=? where id=?", array($this->nome, $this->id));
    }
    
    public function insert(){
        return $this->query("insert into servico (nome) values (?)", $this->nome);
    }
    
    public function delete(){
        return $this->query("delete from servico where id=?", $this->id);
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id=null) {
        $this->id = (is_numeric($id)) ? $id : (($_POST["id"]) ? $_POST["id"] : $_GET["id"]);
        if($this->id>0){
            $n = $this->numRows("select 'x' from servico where id = {$this->id}");
            $this->id = ($n==1) ? $this->id : null;
        }
    }

    function setNome() {
        $this->nome = $_POST["nome"];
    } 
}
