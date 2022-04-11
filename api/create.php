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

    $item = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->nombre = $data->nombre;
    $item->direccion = $data->direccion;
    $item->latitud = $data->latitud;
    $item->longitud = $data->longitud;
    
    
    if($item->createPharmacy()){
        echo 'Pharmacy created.';
    } else{
        echo 'Pharmacy was not created.';
    }
?>