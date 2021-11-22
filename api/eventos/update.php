<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/eventos.php';
 //include_once '../token/validatetoken.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare eventos object
$eventos = new Eventos($db);
 
// get id of eventos to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of eventos to be edited
$eventos->id_eventos = $data->id_eventos;

if(
!empty($data->nombre)
&&!empty($data->descripción)
&&!empty($data->fecha)
&&!empty($data->hora)
&&!empty($data->id_mascota)
){
// set eventos property values

$eventos->nombre = $data->nombre;
$eventos->descripción = $data->descripción;
$eventos->fecha = $data->fecha;
$eventos->hora = $data->hora;
$eventos->id_mascota = $data->id_mascota;
 
// update the eventos
if($eventos->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
	echo json_encode(array("status" => "success", "code" => 1,"message"=> "Updated Successfully","document"=> ""));
}
 
// if unable to update the eventos, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to update eventos","document"=> ""));
    
}
}
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to update eventos. Data is incomplete.","document"=> ""));
}
?>
