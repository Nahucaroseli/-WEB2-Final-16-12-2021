<?php


class TarjetaModel{

    private $db;



    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;','dbname=db_ypf;charset=utf8','root','');
    }



    public function insertTarjeta($fecha_alta,$nro_tarjeta,$fecha_vencimiento,$tipo_tarjeta,$cliente_id){
        $query = $this->db->prepare("INSERT INTO tarjeta(fecha_alta,nro_tarjeta,fecha_vencimiento,tipo_tarjeta,id_cliente) VALUES (?,?,?,?,?)");
        $query->execute(array($fecha_alta,$nro_tarjeta,$fecha_vencimiento,$tipo_tarjeta,$cliente_id)));
    }

}
