<?php
    require_once 'vendor/autoload.php'; // You have to require the library from your Composer vendor folder
?>
<!doctype html>
<html>
  <head>
    <title>Pagar</title>
  </head>

<?php 
    MercadoPago\SDK::setAccessToken("APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398"); // Either Production or SandBox AccessToken

    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();

    // Crea un ítem en la preferencia
   $item1 = new MercadoPago\Item();
  $item1->id = "00001";
  $item1->title = "item"; 
  $item1->quantity = 1;
  $item1->unit_price = 100;
  
  $item2 = new MercadoPago\Item();
  $item2->id = "00001";
  $item2->title = "item"; 
  $item2->quantity = 1;
  $item2->unit_price = 400;
/*
 Mis datos de items a comprar
  */
  $preference->items = array($item1, $item2);
// Preferencias de Pagos..
 // Excluimos pagos por cajero automatico atm 
  // solo pago hasta 6 cuotas

  $preference->payment_methods = array(
  "excluded_payment_methods" => array(
    array("id" => "amex")
  ),
  "excluded_payment_types" => array(
    array("id" => "atm")
  ),
  "installments" => 6
);
  /*
  $preference->payment_methods = array(
    "excluded_payment_types" => array(
      array("id" => "atm")
    ),
    "installments" => 6 
  );
  // Excluimos Tarjeta credito American Expres.
 $preference->payment_methods = array(
    "excluded_payment_methods" => array(
      array("id" => "amex")
  )
  );
  */

  $preference->external_reference = "NUMERO ORDEN EXTERNA";
  

//echo "<a href='$preference->init_point'> Pagar </a>";
    // Comprador

    $payer = new MercadoPago\Payer();
      $payer->name = "Lalo";
      $payer->surname = "Landa";
      $payer->email = "test_user_63274575@testuser.com";
      $payer->date_created = "";
      $payer->phone = array(
        "area_code" => "11",
        "number" => "22223333"
      );
      
      $payer->identification = array(
        "type" => "DNI",
        "number" => "12345678"
      );
      
      $payer->address = array(
        "street_name" => "False",
        "street_number" => 123,
        "zip_code" => "1111");


    $preference->back_urls = array(
    "success" => "succes.php",
    "failure" => "failure.php",
    "pending" => "pending.php"
    );
    $preference->auto_return = "approved";



     print_r($payer) ;
     echo "<br><br>" ;
     print_r($preference) ;

    $preference->save(); # Save the preference and send the HTTP Request to create
   
    echo "<br>Json<br>" ;
    $json = json_encode($payer);
    echo $json ;
    echo "<br>" ;
    $jsonpre = json_encode( $preference);
    echo $jsonpre ;


  ?>

  <body>
    <form action="/procesar-pago" method="POST">
  <script
   src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js"
   data-preference-id="<?php echo $preference->id; ?>">
  </script>
</form>
    <a href="<?php echo $preference->init_point; ?>">Pagar con Mercado Pago</a>
  </body>


  
</html>
