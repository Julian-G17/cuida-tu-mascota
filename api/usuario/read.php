<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/usuario.php';
 //include_once '../token/validatetoken.php';
// instantiate database and usuario object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$usuario = new Usuario($db);
 
// read usuario will be here

// query usuario
$stmt = $usuario->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    //usuario array
    $usuario_arr=array();
    $usuario_arr["records"]=array();
 
    // retrieve our table contents
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $usuario_item=array(
            
"id_usuario" => $id_usuario,
"username" => $username,
"contrasena" => $contrasena,
"nombre" => $nombre
        );
 
        array_push($usuario_arr["records"], $usuario_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show usuario data in json format
	echo json_encode(array("status" => "success", "code" => 1,"message"=> "usuario found","document"=> $usuario_arr));
    
}else{
 // no usuario found will be here

    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no usuario found
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "No usuario found.","document"=> ""));
    
}
 


