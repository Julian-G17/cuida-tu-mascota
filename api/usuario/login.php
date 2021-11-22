<?php

    
    
    // get database connection
    include_once '../config/database.php';
    
    // instantiate persona object
    include_once '../objects/usuario.php';
    // include_once '../token/validatetoken.php';
    $database = new Database();
    $db = $database->getConnection();
    
    $usuario = new Usuario($db);
    
    // get posted data
    $data = json_decode(file_get_contents('php://input'));

    if(!empty($data->username)
    && !empty($data->contrasena)){

        $usuario->username = $data->username;
        $usuario->contrasena = $data->contrasena;
		//hash('sha256', $data->contrasena);
        $id = $usuario->login();

        if(!is_null($id)){
 
            // set response code - 200 created
            http_response_code(200);
            
            // tell the user
            echo json_encode(array("status" => "success", "code" => 200,"message"=> "Logged Successfully","document"=> "", "id_usuario" => $id["id"], "nombre" => $id["nombre"]));
        }
     
        // if unable to create the persona, tell the user
        else{
     
            // set response code - 404 user not found
            http_response_code(404);
     
            // tell the user
            echo json_encode(array("status" => "error", "code" => 404,"message"=> "Unable to login persona. User not found","document"=> ""));
        }
    }else{
        // set response code - 400 bad request
        http_response_code(400);
    
        // tell the user
        echo json_encode(array("status" => "error", "code" => 400,"message"=> "Unable to login. Data is incomplete.","document"=> ""));
    }

?>