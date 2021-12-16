<?php


class AuthHelper{

    public function __construct(){

    }

    public function estaLogueado(){
        session_start();
        if(!isset($_SESSION['password'])){
            header("Location: Login");
            die();
        }

    }

}