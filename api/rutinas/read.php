<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/rutinas.php';
 //include_once '../token/validatetoken.php';
// instantiate database and rutinas object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$rutinas = new Rutinas($db);
 
// read rutinas will be here

// query rutinas
$stmt = $rutinas->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    //rutinas array
    $rutinas_arr=array();
    $rutinas_arr["records"]=array();
 
    // retrieve our table contents
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $rutinas_item=array(
            
"id_rutina" => $id_rutina,
"nombre" => $nombre,
"descripcion" => html_entity_decode($descripcion),
"fecha" => $fecha,
"hora" => $hora,
"id_mascota" => $id_mascota
        );
 
        array_push($rutinas_arr["records"], $rutinas_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show rutinas data in json format
	echo json_encode(array("status" => "success", "code" => 1,"message"=> "rutinas found","document"=> $rutinas_arr));
    
}else{
 // no rutinas found will be here

    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no rutinas found
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "No rutinas found.","document"=> ""));
    
}
 


