<?php

class Banco extends PDO{
    
    public function __construct(){ 
        parent::__construct('mysql:host=localhost;dbname=banco', 'root', '123', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
        try{ 
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }
        catch (PDOException $e){
            die($e->getMessage());
        }  
    }
    
    public function fetchAssoc($sql, $params=array()){
       try{
          $stmt = $this->prepare($sql);
          $params = is_array($params) ? $params : array($params);
          $stmt->execute($params);

          return $stmt->fetchAll(PDO::FETCH_ASSOC);
       }
       catch (Exception $e){
          throw new Exception(
                __METHOD__ . 'Exceção do SQL: ' . var_export($sql, true) .
                ' Parâmetros: ' . var_export($params, true) .
                ' Mensagem de Erro: ' . var_export($this->errorInfo(), true),
                0,
                $e);
       }
    }
    
    public function query($sql, $params=array()){
       try{
          $stmt = $this->prepare($sql);
          $params = is_array($params) ? $params : array($params);
          $stmt->execute($params);
          return true;
       }
       catch (Exception $e){
          throw new Exception(
                __METHOD__ . 'Exceção do SQL: ' . var_export($sql, true) .
                ' Parâmetros: ' . var_export($params, true) .
                ' Mensagem de Erro: ' . var_export($this->errorInfo(), true),
                0,
                $e);
          return false;
       }
    }    
    
    public function numRows($sql){
        $stmt = parent::prepare($sql);
        if($stmt){
            $stmt->execute();
            return $stmt->rowCount();
        }else{
            return $this->errorInfo();
        }
    }
    
} 