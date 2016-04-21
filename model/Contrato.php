<?php
class Contrato extends Sistema{
    
    private $id;
    private $id_cliente;
    private $id_servico;
    private $data_inicio;
    private $data_fim;


    public function __construct() {
        parent::__construct();
    }
    
    public function select(){
        if($this->id>0){
            $arr = $this->fetchAssoc("select id_cliente, id_servico, "
                                   . "date_format(data_inicio, '%d/%m/%Y') as data_inicio, "
                                   . "date_format(data_fim, '%d/%m/%Y') as data_fim "
                                   . "from contrato where id = ?", $this->id);
            foreach($arr[0] as $k=>$v){
                 $this->$k=$v;
            }
        }
    }
    
    public function selectAll(){
        return $this->fetchAssoc("select Ct.id, Cl.nome as cliente, S.nome as servico, "
                               . "date_format(Ct.data_inicio, '%d/%m/%Y') as data_inicio, "
                               . "date_format(Ct.data_fim, '%d/%m/%Y') as data_fim "
                               . "from contrato Ct "
                               . "inner join cliente Cl on Cl.id = Ct.id_cliente "
                               . "inner join servico S on S.id = Ct.id_servico");
    }
    
    public function update(){
        return $this->query("update contrato set id_cliente=?, id_servico=?, data_inicio=?, data_fim=? "
                          . "where id = ?",

                            array($this->id_cliente, $this->id_servico, 
                                  $this->dataPrepare($this->data_inicio), $this->dataPrepare($this->data_fim),
                                  $this->id));
    }
    
    public function insert(){
        return $this->query("insert into contrato (id_cliente, id_servico, data_inicio, data_fim) "
                          . "values (?,?,?,?)",
            
                            array($this->id_cliente, $this->id_servico, 
                                  $this->dataPrepare($this->data_inicio), $this->dataPrepare($this->data_fim)));
    }
    
    public function delete(){
        return $this->query("delete from contrato where id=?",$this->id);
    }

    function getId() {
        return $this->id;
    }
    
    function getId_cliente() {
        return $this->id_cliente;
    }

    function getId_servico() {
        return $this->id_servico;
    }

    function getData_inicio() {
        return $this->data_inicio;
    }

    function getData_fim() {
        return $this->data_fim;
    }

    function setId($id=null) {
        $this->id = (is_numeric($id)) ? $id : (($_POST["id"]) ? $_POST["id"] : $_GET["id"]);
        if($this->id>0){
            $n = $this->numRows("select 'x' from contrato where id = {$this->id}");
            $this->id = ($n==1) ? $this->id : null;
        }
    }
    
    function setId_cliente() {
        $this->id_cliente = $_POST["id_cliente"];
    }
    
    function setId_servico() {
        $this->id_servico = $_POST["id_servico"];
    }

    function setData_inicio() {
        $this->data_inicio = $_POST["data_inicio"];
    }

    function setData_fim() {
        $this->data_fim = $_POST["data_fim"];
    }





    
}
