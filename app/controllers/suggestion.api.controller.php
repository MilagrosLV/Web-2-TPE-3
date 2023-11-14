<?php
    require_once 'app/controllers/api.controller.php';
    require_once 'app/models/suggestion.model.php';
    require_once 'app/views/api.view.php';

    class SuggestionApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new SuggestionModel();
        }

        function get($params = []) {

            if (empty($params)){
                $sugerencias = $this->model->getSuggestions();
                $this->view->response($sugerencias, 200);

                //Petición GET con filtro
                /*$filterTitle = false;

                if(isset($_GET['titulo'])) {
                    $filterTitle = _GET['titulo'] == true;
                }*/

            } else {
                $sugerencia = $this->model->getSuggestion($params[':ID']);

                if (empty($sugerencia)) {
                    $this->view->response(['No se solicitó un id'], 400);
                } else {
                    $this->view->response(['La sugerencia con el id='.$id.' no existe.'], 404);
                }
                
                if($sugerencia) {
                    $this->view->response($sugerencia, 200);

                    /*if($params[':subrecurso']) {
                        switch ($params[':subrecurso']) {
                            case 'titulo':
                                $this->view->response($sugerencia->titulo, 200); //Poner un igual =
                                break;
                            case 'genero':
                                $this->view->response($sugerencia->genero, 200);
                                break;
                            case 'descripción':
                                $this->view->response($sugerencias->descripción, 200);
                                break;
                                
                            default:
                                $this->view->response(['La sugerencia no contiene '.$params[':subrecurso'].'.'], 404);
                                break;
                        }
                    }*/
                } 
            }
        }

        function create($params = []) {
            $body = $this->getData();

            $titulo = $body->titulo;
            $genero = $body->genero;
            $descripción = $body->descripción;
            $prioridad = $body->prioridad;

            if (empty($titulo) || empty($genero) || empty($descripción) || empty($prioridad)) {
                $this->view->response(["Complete los datos"], 400);
            } else {
                $id = $this->model->insertSuggestion($titulo, $genero, $descripción, $prioridad);

                $sugerencia = $this->model->getSuggestion($id);
                $this->view->response(['La sugerencia fue insertada exitosamente con el id='.$id, 201]); //Devuelve el recurso creado.
            }            
        }

        function update($params = []) {
            $id = $params[':ID'];
            $sugerencia = $this->model->getSuggestion($id);

            if($sugerencia) {
                $body = $this->getData();

                $titulo = $body->titulo;
                $genero = $body->genero;
                $descripción = $body->descripción;
                $prioridad = $body->prioridad;
                
                $this->model->updateSuggestionData($id, $titulo, $genero, $descripción, $prioridad);

                $this->view->response(['La sugerencia con id='.$id.' ha sido modificada con éxito.'], 201);

                if($id) {
                    $this->view->response(['Ocurrió un error al intentar modificar la sugerencia.'], 500);
                }

                if(empty($id)) {
                    $this->view->response(['No se proporconó una sugerencia para modificar'], 400);
                }

                if (empty($id) || empty($titulo) || empty($genero) || empty($descripción) || empty($prioridad)) {
                    $this->view->response(["Faltó modificar algun campo"], 400);
                } 


            } else {
                $this->view->response(['La sugerencia con id='.$id.' no existe.'], 404);
            } 
            /* else {
                $this->view->response('Solicitud incorrecta de la sugerencia con id='.$id.'.', 400);
            }*/
        }

        function delete($params = []) {
            $id = $params[':ID'];
            $sugerencia = $this->model->getSuggestion($id);

            if($sugerencia) {
                $this->view->response('La sugerencia se ha eliminado con éxito.', 200);
            } else {
                $this->view->response('La sugerencia con id='.$id.' no existe.', 404);
            } 
            
            if(empty($sugerencia)) {
                $this->view->response(['Error en la solicitud de id'], 400);
            } else {
                $this->view->response([
                    'La sugerencia con id='.$id.' no se pudo eliminar debido a un error en el servidor.']
                    , 500);
            }
        }
    }
?>