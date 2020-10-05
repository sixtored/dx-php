<?php
    class Response{
        
        // Retorna un array con la estructura de respuesta.
        public function getResponse($status, $data, $code, $message){
            return array(
                "status" => $status,
                "data" => $data,
                "code" => $code,
                "message" => $message
            );
        }
    }
?>
