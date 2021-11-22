<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/eventos.php';
 //include_once '../token/validatetoken.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare eventos object
$eventos = new Eventos($db);
 
// set ID property of record to read
$eventos->id_eventos = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of eventos to be edited
$eventos->readOne();
 
if($eventos->id_eventos!=null){
    // create array
    $eventos_arr = array(
        
"id_eventos" => $eventos->id_eventos,
"nombre" => $eventos->nombre,
"descripción" => html_entity_decode($eventos->descripción),
"fecha" => $eventos->fecha,
"hora" => $eventos->hora,
"id_mascota" => $eventos->id_mascota
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
   echo json_encode(array("status" => "success", "code" => 1,"message"=> "eventos found","document"=> $eventos_arr));
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user eventos does not exist
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "eventos does not exist.","document"=> ""));
}
?>
