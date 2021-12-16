<?php


class ClienteModel{

    private $db;



    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;','dbname=db_ypf;charset=utf8','root','');
    }

    public function getClientebyDni($dni){
        $query = $this->db->prepare("SELECT * FROM cliente WHERE dni=?");
        $query->execute(array($dni));
        return $query->fetch(PDO::FETCH_OBJ);

    }

}