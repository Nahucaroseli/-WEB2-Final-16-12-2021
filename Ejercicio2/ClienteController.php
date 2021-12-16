<?php

require_once "ClienteModel.php";
require_once "TarjetaModel.php";
require_once "ActividadModel.php";

class ClienteController{


    private $clienteModel;
    private $tarjetaModel;
    private $actividadModel;
    private $view;


    public function __construct(){
        $this->clienteModel = new ClienteModel();
        $this->tarjetaModel = new TarjetaModel();
        $this->actividadModel = new ActividadModel();
        $this->view = new ClienteView();

    }


    public function obtenerDatosCliente(){
        $kilometrosCliente = new ArrayObject();
        $tarjetasCliente = new ArrayObject();
        if(isset($_POST['dni'])){
            $cliente = $this->clienteModel->getClientebyDni($_POST['dni']);
            if(isset($cliente)){
                $tarjetasCliente = $this->tarjetModel->getTarjetasbyCliente($cliente->id);
                if(isset($tarjetaCliente)){
                    $actividadesCliente = $this->actividadModel->getActividadbyCliente($cliente->id);
                    if(isset($actividadesCliente){
                        foreach($actividadesCliente as $actividadCliente){
                            $tipo_operacion = $actividadCliente->tipo_operacion;
                            $kms = $actividadCliente->kms;
                            $fecha = $actividadCliente->fecha;
                            $kilometrosCliente->append(array($tipo_operacion,$kms,$fecha));
                        }
                        foreach($tarjetasCliente as $tarjetaCliente){
                            $numeroTarjeta = $tarjetaCliente->nro_tarjeta;
                            // aca supuse  que la fecha que aparece en la tabla en la parte de las tarjetas es la fecha de vencimiento de la tarjeta
                            $fechaVencimiento = $tarjetaCliente->fecha_vencimiento;
                            $tarjetasCliente->append(array($numeroTarjeta,$fechaVencimiento));
                        }  
                        
                    }else{
                        $this->view->showError("El cliente no tiene actividades");
                    }
                }else{
                    $this->view->showError("El cliente no tiene tarjetas asociadas");
                }
                $this->view->mostrarDatos($kilometrosCliente,$tarjetasCliente);
            }else{
                $this->view->showError("No existe cliente con ese DNI");
            }
           
        }else{
            $this->view->showError("No puso el dni del cliente");
        }
        
    }

}