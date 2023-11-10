<?php
    require_once 'config.php';
    require_once 'libs/router.php';

    require_once 'app/controllers/task.api.controller.php';

    $router = new Router();

    //                 endpoint          verbo     controller           método
    $router->addRoute('sugerencias',     'GET',    'TaskApiController', 'get'   );
    $router->addRoute('sugerencias',     'POST',   'TaskApiController', 'create');
    $router->addRoute('sugerencias/:ID', 'GET',    'TaskApiController', 'get'   );
    $router->addRoute('sugerencias/:ID', 'PUT',    'TaskApiController', 'update');
    $router->addRoute('sugerencias/:ID', 'DELETE', 'TaskApiController', 'delete');
    
    $router->addRoute('sugerencias/:ID/:subrecurso', 'GET',    'TaskApiController', 'get'   ); //Si es filtrar, va como query para ?titulo=algo (en la petición va el GET, no usar /)
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);

?>