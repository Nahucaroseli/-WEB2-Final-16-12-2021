<?php

require_once "ClienteModel.php";
require_once "TarjetaModel.php";
require_once "ActividadModel.php";
require_once "AuthHelper.php";
require_once "ClienteView.php";
require_once "CardHelper.php";



class ClienteController{

    private $clienteModel;
    private $tarjetaModel;
    private $authHelper;
    private $actividadModel;
    private $view;
    private $cardHelper;


    public function __construct(){
        $this->clienteModel = new ClienteModel();
        $this->authHelper = new AuthHelper();
        $this->cardHelper = new CardHelper();
        $this->tarjetaModel = new TarjetaModel();
        $this->actividadModel = new ActividadModel();
        $this->view = new ClienteView();

    }


    public function agregarCliente(){
        $this->authHelper->isAdmin();
        if(isset($_POST['dni']) && isset($_POST['nombre'] && isset($_POST['telefono'] && isset($_POST['direccion'] && isset($_POST['ejecutivo']){
            $clientes = $this->clienteModel->getClientes($_POST['dni']));
            if(empty($clientes)){
                $this->clienteModel->insertCliente($_POST['dni'],$_POST['nombre'],$_POST['telefono'],$_POST['direccion'],$_POST['ejecutivo']);
                $kms_cliente = 200;
                $cliente_nuevo = $this->model->getClientebyDni($_POST['dni']);
                $this->actividadModel->insertActividad($kms_cliente,$_POST['fecha'],$_POST['tipo_operacion'],$cliente_nuevo->id);
                if(isset($cliente_nuevo) && $cliente_nuevo->ejecutivo == true){
                    $bussinesCard = $this->cardHelper->getBussinesCard();
                    $this->tarjetaModel->insertTarjeta($bussinesCard->fecha_alta,$bussinesCard->nro_tarjeta,$bussinesCard->fecha_vencimiento,$bussinesCard->tipo_tarjeta,$cliente_nuevo->id);
                }else{
                    // Aca si no es ejecutivo, pense q habia que agregar un tarjeta igual
                    $this->tarjetaModel->insertTarjeta($_POST['fecha_alta'],$_POST['nro_tarjeta'],$_POST['fecha_vencimiento'],$_POST['tipo_tarjeta'],$cliente_nuevo->id);
                }
                
            }else{
                $this->view->showError("Existe un cliente con su mismo dni");
            }
        }else{
            $this->view->showError("No especifico los datos");
        }
       


    }

}