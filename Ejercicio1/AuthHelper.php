<?php


class AuthHelper{

    public function __construct(){

    }

    public function isAdmin(){
        session_start();
        if(!isset($_SESSION['isAdmin'])){
            header("Location: Login");
            die();
        }
    }



    public function estaLogueado(){
        session_start();
        if(!isset($_SESSION['password'])){
            header("Location: Login");
            die();
        }

    }

}