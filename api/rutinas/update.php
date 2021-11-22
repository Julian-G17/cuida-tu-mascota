<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/rutinas.php';
 //include_once '../token/validatetoken.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare rutinas object
$rutinas = new Rutinas($db);
 
// get id of rutinas to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of rutinas to be edited
$rutinas->id_rutina = $data->id_rutina;

if(
!empty($data->nombre)
&&!empty($data->descripcion)
&&!empty($data->fecha)
&&!empty($data->hora)
&&!empty($data->id_mascota)
){
// set rutinas property values

$rutinas->nombre = $data->nombre;
$rutinas->descripcion = $data->descripcion;
$rutinas->fecha = $data->fecha;
$rutinas->hora = $data->hora;
$rutinas->id_mascota = $data->id_mascota;
 
// update the rutinas
if($rutinas->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
	echo json_encode(array("status" => "success", "code" => 1,"message"=> "Updated Successfully","document"=> ""));
}
 
// if unable to update the rutinas, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to update rutinas","document"=> ""));
    
}
}
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to update rutinas. Data is incomplete.","document"=> ""));
}
?>
