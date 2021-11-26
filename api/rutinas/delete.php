<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/rutinas.php';
// include_once '../token/validatetoken.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare rutinas object
$rutinas = new Rutinas($db);
 
// get rutinas id
$data = json_decode(file_get_contents("php://input"));
 
// set rutinas id to be deleted
$rutinas->id_rutina = $data->id_rutina;
 
// delete the rutinas
if($rutinas->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
	echo json_encode(array("status" => "success", "code" => 1,"message"=> "Rutinas was deleted","document"=> ""));
    
}
 
// if unable to delete the rutinas
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to delete rutinas.","document"=> ""));
}
?>
