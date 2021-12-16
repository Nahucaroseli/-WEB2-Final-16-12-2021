<?php


class ActividadApiController{

    private $actividadesModel;

    private $view;



        public function __construct(){
            $this->actividadesModel = new ActividadModel();
            $this->view = new ApiView();
        }
        public  function getHistorialActividades($params = []){
            $this->authHelper->estaLogueado();
            $id = $params[':ID'];
            if(isset($_POST['primerfecha']) && $_POST['segundaFecha']){
                $actividades = $this->actividadesModel->getActividadesbyFechas($_POST['primerfecha']),$_POST['segundaFecha']);
                if($actividades){
                    $this->view->response($actividades,200);
                }else{
                    $this->view->response([],404);
                }
            }else{
                $this->view->response("No puso las fechas",404);
            }
        }


}