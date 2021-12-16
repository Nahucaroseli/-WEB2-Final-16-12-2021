<?php


class ClienteModel{

    private $db;



    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;','dbname=db_ypf;charset=utf8','root','');
    }



    public function insertCliente($dni,$nombre,$telefono,$direccion,$ejecutivo){
        $query = $this->db->prepare("INSERT INTO cliente(nombre,dni,telefono,direccion,ejecutivo) VALUES (?,?,?,?,?)");
        $query->execute(array($dni,$nombre,$telefono,$direccion,$ejecutivo));
    }

    public function getClientebyDni($dni){
        $query = $this->db->prepare("SELECT * FROM cliente WHERE dni=?");
        $query->execute(array($dni));
        return $query->fetch(PDO::FETCH_OBJ);

    }
    public function getClientes($dni){
        $query = $this->db->prepare("SELECT * FROM cliente WHERE dni=?");
        $query->execute(array($dni));
        return $query->fetchAll(PDO::FETCH_OBJ);

    }
}