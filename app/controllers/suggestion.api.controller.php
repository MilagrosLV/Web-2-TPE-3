<?php
    require_once 'app/controllers/api.controller.php';
    require_once 'app/models/suggestion.model.php';
    require_once 'app/view/api.view.php';

    class SuggestionApiController extends ApiController {
        private $view;
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new SuggestionModel();
            $this->view = new ApiView();
        }

        function get($params = []) {
            if (empty($params)){
                $sugerencias = $this->model->getSuggestions();
                $this->view->response($sugerencias, 200);
            } else {
                $sugerencia = $this->model->getSuggestion($params[':ID']);
                if(!empty($sugerencia)) {
                    if($params[':subrecurso']) {
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
                            $this->view->response(
                                'La sugerencia no contiene '.$params[':subrecurso'].'.'
                                , 404);
                                break;
                        }
                    } else
                        $this->view->response($sugerencia, 200);
                } else {
                    $this->view->response(
                        'La sugerencia con el id='.$params[':ID'].' no existe.'
                        , 404);
                }
            }
        }

        function delete($params = []) {
            $id = $params[':ID'];
            $sugerencia = $this->model->getSuggestion($id);

            if($sugerencia) {
                $this->model->deleteSuggestion($id);
                $this->view->response('La sugerencia con id='.$id.' ha sido borrada.', 200);
            } else {
                $this->view->response('La sugerencia con id='.$id.' no existe.', 404);
            }
        }
        //hay que hacer el DELETE de una sugerencia de libro.

        function create($params = []) {
            $body = $this->getData();

            $titulo = $body->titulo;
            $genero = $body->genero;
            $descripción = $body->descripción;
            $prioridad = $body->prioridad;

            if (empty($titulo) || empty($prioridad)) {//Cuales campos dejar en vacio?
                $this->view->response("Complete los datos", 400);
            } else {
                $id = $this->model->insertSuggestion($titulo, $genero, $descripción, $prioridad); //Cambiar los nombres porque son código robado

                //en una API REST es buena práctica devolver el recurso creado
                $sugerencia = $this->model->getSuggestion($id);
                $this->view->response($sugerencia, 201);
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

                $this->model->updateSuggestion($id);

                $this->view->response('La sugerencia con id='.$id.' ha sido modificada.', 200 or 201);
            }else {
                $this->view->response('La sugerencia con id='.$id.' no existe.', 400 or 404);
            }
        }
    }