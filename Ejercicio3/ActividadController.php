<?php


class ActividadController{

    private $actividadModel;
    private $clienteModel;
    private $view;
    private $authHelper;



    public function __construct(){
        $this->actividadModel = new ActividadModel();
        $this->clienteModel = new ClienteModel();
        $this->view = new ActividadView();
        $this->authHelper = new AuthHelper();
    }


    public function hacerTransferencia(){
        $this->authHelper->estaLogueado();
        if(isset($_POST['dniDestinatario']) && $_POST['dniClienteOriginario']){
            $clienteDestinatario = $this->clienteModel->getClientebyDni($_POST['dniDestinatario']);
            $clienteOriginario = $this->clienteModel->getClientebyDni($_POST['dniDestinatario']);
            $actividadClienteOriginario = $this->actividadModel->getActividadbyCliente($clienteOriginario->id);
            if(isset($clienteDestinatario){
                if($actividadClienteOriginario->kms != 0){
                    $this->actividadModel->insertActividad($actividadClienteOriginario->kms,$_POST['fecha'],$_POST['tipo_operacion'],$clienteDestinatario->id);
                }else{
                    $this->view->showError("Fondos insuficientes");
                }
            }else{
                $this->view->showError("No existe el cliente destinatario");
            }
        
        }
    }


}