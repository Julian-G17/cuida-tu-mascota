<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate rutinas object
include_once '../objects/rutinas.php';
// include_once '../token/validatetoken.php';
$database = new Database();
$db = $database->getConnection();
 
$rutinas = new Rutinas($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
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
 
    // create the rutinas
    if($rutinas->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("status" => "success", "code" => 1,"message"=> "Created Successfully","document"=> ""));
    }
 
    // if unable to create the rutinas, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
		echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to create rutinas","document"=> ""));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to create rutinas. Data is incomplete.","document"=> ""));
}
?>
