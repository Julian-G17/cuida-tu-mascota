<?php
    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/eventos.php';
    //include_once '../token/validatetoken.php';
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    // prepare eventos object
    $eventos = new Eventos($db);
    
    // get eventos id
    $data = json_decode(file_get_contents('php://input'));

    // set eventos id to be deleted
    $eventos->id_eventos = $data->id_eventos;
    
    // delete the eventos
    if($eventos->delete()){
    
        // set response code - 200 ok
        http_response_code(200);
    
        // tell the user
        echo json_encode(array("status" => "success", "code" => 1,"message"=> "Eventos was deleted","document"=> ""));
        
    }
    
    // if unable to delete the eventos
    else{
    
        // set response code - 503 service unavailable
        http_response_code(503);
    
        // tell the user
        echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to delete eventos.","document"=> ""));
    }
?>
