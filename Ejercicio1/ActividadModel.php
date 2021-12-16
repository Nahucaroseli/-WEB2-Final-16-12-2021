<?php


class ActividadModel{

    private $db;



    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;','dbname=db_ypf;charset=utf8','root','');
    }



    public function getActividadbyCliente($id_cliente){
        $query = $this->db->prepare("SELECT * FROM actividad WHERE id_cliente=?");
        $query->execute(array($id_cliente));
        return $query->fetchAll(PDO::FETCH_OBJ);

    }
}