<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/rutinas.php';
// include_once '../token/validatetoken.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare rutinas object
$rutinas = new Rutinas($db);
 
// set ID property of record to read
$rutinas->id_rutina = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of rutinas to be edited
$rutinas->readOne();
 
if($rutinas->id_rutina!=null){
    // create array
    $rutinas_arr = array(
        
"id_rutina" => $rutinas->id_rutina,
"nombre" => $rutinas->nombre,
"descripcion" => html_entity_decode($rutinas->descripcion),
"fecha" => $rutinas->fecha,
"hora" => $rutinas->hora,
"id_mascota" => $rutinas->id_mascota
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
   echo json_encode(array("status" => "success", "code" => 1,"message"=> "rutinas found","document"=> $rutinas_arr));
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user rutinas does not exist
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "rutinas does not exist.","document"=> ""));
}
?>
