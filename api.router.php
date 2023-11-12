<?php
    require_once 'config.php';
    require_once 'libs/router.php';

    require_once 'app/controllers/suggestion.api.controller.php';

    $router = new Router();

    //                 endpoint        verbo(verb)     controller             método(method)
    $router->addRoute('sugerencias',     'GET',    'SuggestionApiController', 'getAll'   );
    $router->addRoute('sugerencias',     'POST',   'SuggestionApiController', 'create');
    $router->addRoute('sugerencias/:ID', 'GET',    'SuggestionApiController', 'get'   );
    $router->addRoute('sugerencias/:ID', 'PUT',    'SuggestionApiController', 'update');
    $router->addRoute('sugerencias/:ID', 'DELETE', 'SuggestionApiController', 'delete');
    
    $router->addRoute('sugerencias/:ID/:subrecurso', 'GET', 'SuggestionApiController', 'get'   ); //Si es filtrar, va como query para ?titulo=algo (en la petición va el GET, no usar /)
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);

?>