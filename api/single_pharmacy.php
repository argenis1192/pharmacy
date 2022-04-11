<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/pharmacy.php';

    $database = new DB();
    $db = $database->getConnection();

    $item = new Pharmacy($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSinglePharmacy();

    if($item->nombre != null){
        $pharm_Arr = array(
            "id" =>  $item->id,
            "nombre" => $item->nombre,
            "direccion" => $item->direccion,
            "latitud" => $item->latitud,
            "longitud" => $item->longitud
        );
      
        http_response_code(200);
        echo json_encode($pharm_Arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Pharmacy record not found.");
    }
?>