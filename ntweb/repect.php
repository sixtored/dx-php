<?php

// crear un registro en la tabla categoria (POST) body->raw->json
    // Declaraciones de librerias
// require '../config/Database.php';
 //require '../models/Categoria.php';
require '../utils/Response.php';

    // CREATE TABLE categorias (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, codigo VARCHAR(10) NOT NULL, descripcion VARCHAR(60) NOT NULL,  // create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    // deleted_at TIMESTAMP NULL) ENGINE=INNODB, CHARSET = utf8
    
    $res = new Response();

    // Evaluar el método
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST");
        header("Content-Type: application/json, charset=utf-8");
        // obtener el body (cuerpo) de la petición.
        // file_get_contents("php://input") => obtiene el cuerpo de la petición            
         MercadoPago\SDK::setAccessToken("TEST-1491103792399277-100219-ba53f79570c6591431f83ae8d1b36a26-78486616");
        $data = json_decode(file_get_contents("php://input"));


    switch($_POST["type"]) {
        case "payment":
            $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
            http_response_code(201); // created
            echo json_encode($res->getResponse("OK", $payment, 201, "Pago Creado"));
            break;
        case "plan":
            $plan = MercadoPago\Plan.find_by_id($_POST["id"]);
            http_response_code(201); // created
            echo json_encode($res->getResponse("OK", $plan, 201, "Pago Creado"));
            break;
        case "subscription":
            $plan = MercadoPago\Subscription.find_by_id($_POST["id"]);
            http_response_code(201); // created
            echo json_encode($res->getResponse("OK", $plan, 201, "Pago Creado"));
            break;
        case "invoice":
            $plan = MercadoPago\Invoice.find_by_id($_POST["id"]);
            http_response_code(201); // created
            echo json_encode($res->getResponse("OK", $plan, 201, "Pago Creado"));
            break;
    }
}
    			


/*
payment			payment.created				Creación de un pago
payment			payment.updated				Actualización de un pago
mp-connect		application.deauthorized	Desvinculación de una cuenta
mp-connect		application.authorized		Vinculación de una cuenta
plan			application.authorized		Vinculación de una cuenta
subscription	application.authorized		Vinculación de una cuenta
invoice			application.authorized		Vinculación de una cuenta
*/
// FORMATO DE NOTIFICACION DE MP
/*
{
    "id": 12345,
    "live_mode": true,
    "type": "payment",
    "date_created": "2015-03-25T10:04:58.396-04:00",
    "application_id": 123123123,
    "user_id": 44444,
    "version": 1,
    "api_version": "v1",
    "action": "payment.created",
    "data": {
        "id": "999999999"
    }
}
Cuando recibas una notificación en tu plataforma, Mercado Pago espera una respuesta para validar que la recibiste correctamente. Para esto, debes devolver un HTTP STATUS 200 (OK) ó 201 (CREATED).

Es recomendable que respondas a la notificación antes de ejecutar lógica de negocio o previo al acceso de recursos externos para no exceder los tiempos estimados de respuesta.
Luego de esto, tienes que obtener la información completa del recurso notificado accediendo al endpoint correspondiente de la API:

payment			https://api.mercadopago.com/v1/payments/[ID]		Ver documentación
plan			https://api.mercadopago.com/v1/plans/[ID]			-
subscription	https://api.mercadopago.com/v1/subscriptions/[ID]	-
invoice			https://api.mercadopago.com/v1/invoices/[ID]		Ver documentación

*/

				

?>