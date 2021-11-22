<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/mascota.php';
 //include_once '../token/validatetoken.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare mascota object
$mascota = new Mascota($db);
 
// set ID property of record to read
$mascota->id_mascota = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of mascota to be edited
$mascota->readOne();
 
if($mascota->id_mascota!=null){
    // create array
    $mascota_arr = array(
        
"id_mascota" => $mascota->id_mascota,
"nombre" => $mascota->nombre,
"edad" => $mascota->edad,
"animal" => $mascota->animal,
"raza" => $mascota->raza,
"foto_mascota" => html_entity_decode($mascota->foto_mascota),
"id_usuario" => $mascota->id_usuario
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode(array($mascota_arr));

}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user mascota does not exist
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "mascota does not exist.","document"=> ""));
}
?>
