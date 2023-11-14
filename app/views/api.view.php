<?php
    class ApiView {
        public function response($data, $status = 200) {
            header('Content-type: application/json');
            header('HTTP/1.1 '.$status." ".$this->_requestStatus($status));
            echo json_encode($data);
        }



        private function _requestStatus($code) { 
            $status = array(
            //Success
                200 => "OK",
                201 => "Created", //Creado
            //Client Error
                400 => "Bad Request", //Solicitud incorrecta 
                404 => "Not found", //Solicitud no encontrada
            //Server Error
                500 => "Internal server error", //Error interno del servidor
            );
            return (isset($status[$code])) ? $status[$code] : $status[500];
        }

    }