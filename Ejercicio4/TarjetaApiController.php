<?php


class TarjetaApiController{

    private $model;
    private $view;

    public function __construct(){
        $this->model = new TarjetasModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php: //input");
    }


    public function getData(){
        return json_decode($this->data);
    }

    public function darBajaTarjeta($params= []){
        $this->authHelper->estaLogueado();
        $id = $params[':ID'];
        
        $body = $this->getData();
        if($body){
            $this->model->darbaja($body->fecha_alta,$body->nro_tarjeta,$body->fecha_vencimiento,$body->tipo_tarjeta,$body->id_cliente);
        }else{
            $this->view->response("No existe el body",404);
        }

    }
    
    public function getTarjetasCliente($params = []){
        $this->authHelper->estaLogueado();
        $id = $params[':ID'];
        $tarjetas = $this->tarjetasModel->getTarjetasCliente($id);
        if($tarjetas){
            $this->view->response($tarjetas,200);
        }else{
            $this->view->response([],200);
        }
    }

}