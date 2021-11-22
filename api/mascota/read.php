<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/mascota.php';
// include_once '../token/validatetoken.php';
// instantiate database and mascota object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$mascota = new Mascota($db);
$id_usuario_mascota = $_GET["id_usuario"];
$mascota->id_usuario = $id_usuario_mascota;
 
// read mascota will be here

// query mascota
$stmt = $mascota->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    //mascota array
    $mascota_arr=array();
    $mascota_arr["records"]=array();
 
    // retrieve our table contents
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $mascota_item=array(
            
        "id_mascota" => $id_mascota,
        "nombre" => $nombre,
        "edad" => $edad,
        "animal" => $animal,
        "raza" => $raza,
        "foto_mascota" => html_entity_decode($foto_mascota)
        );
 
        array_push($mascota_arr["records"], $mascota_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show mascota data in json format
    echo json_encode(array($mascota_arr));
	// echo json_encode(array("status" => "success", "code" => 1,"message"=> "mascota found","document"=> $mascota_arr));
    
}else{
 // no mascota found will be here

    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no mascota found
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "No mascota found.","document"=> ""));
    
}
 


