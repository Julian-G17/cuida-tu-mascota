<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/mascota.php';
// include_once '../token/validatetoken.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare mascota object
$mascota = new Mascota($db);
 
// get id of mascota to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of mascota to be edited
$mascota->id_mascota = $data->id_mascota;

if(
!empty($data->nombre)
&&!empty($data->edad)
&&!empty($data->animal)
&&!empty($data->raza)
&&!empty($data->foto_mascota)
&&!empty($data->id_usuario)
){
// set mascota property values

$mascota->nombre = $data->nombre;
$mascota->edad = $data->edad;
$mascota->animal = $data->animal;
$mascota->raza = $data->raza;
$mascota->foto_mascota = $data->foto_mascota;
$mascota->id_usuario = $data->id_usuario;
 
// update the mascota
if($mascota->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
	echo json_encode(array("status" => "success", "code" => 1,"message"=> "Updated Successfully","document"=> ""));
}
 
// if unable to update the mascota, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to update mascota","document"=> ""));
    
}
}
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to update mascota. Data is incomplete.","document"=> ""));
}
?>
