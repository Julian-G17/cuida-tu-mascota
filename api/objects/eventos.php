<?php
class Eventos{
 
    // database connection and table name
    private $conn;
    private $table_name = "eventos";
	private $pageNo = 1;
	private  $no_of_records_per_page=30;
    // object properties
	
public $id_eventos;
public $nombre;
public $descripción;
public $fecha;
public $hora;
public $id_mascota;
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read eventos
	function read(){
		if(isset($_GET["pageNo"])){
		$this->pageNo=$_GET["pageNo"];
		}
		$offset = ($this->pageNo-1) * $this->no_of_records_per_page; 
		// select all query
		$query = "SELECT  t.* FROM ". $this->table_name ." t  LIMIT ".$offset." , ". $this->no_of_records_per_page."";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	// create eventos
	function create(){
	 
		// query to insert record
		$query ="INSERT INTO ".$this->table_name." SET nombre=:nombre,descripción=:descripción,fecha=:fecha,hora=:hora,id_mascota=:id_mascota";

		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		
$this->nombre=htmlspecialchars(strip_tags($this->nombre));
$this->descripción=htmlspecialchars(strip_tags($this->descripción));
$this->fecha=htmlspecialchars(strip_tags($this->fecha));
$this->hora=htmlspecialchars(strip_tags($this->hora));
$this->id_mascota=htmlspecialchars(strip_tags($this->id_mascota));
	 
		// bind values
		
$stmt->bindParam(":nombre", $this->nombre);
$stmt->bindParam(":descripción", $this->descripción);
$stmt->bindParam(":fecha", $this->fecha);
$stmt->bindParam(":hora", $this->hora);
$stmt->bindParam(":id_mascota", $this->id_mascota);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
	
	// used when filling up the update eventos form
	function readOne(){
	 
		// query to read single record
		$query = "SELECT  t.* FROM ". $this->table_name ." t  WHERE t.id_eventos = ? LIMIT 0,1";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id_eventos);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		
$this->id_eventos = $row['id_eventos'];
$this->nombre = $row['nombre'];
$this->descripción = $row['descripción'];
$this->fecha = $row['fecha'];
$this->hora = $row['hora'];
$this->id_mascota = $row['id_mascota'];
	}
	
	// update the eventos
	function update(){
	 
		// update query
		$query ="UPDATE ".$this->table_name." SET nombre=:nombre,descripción=:descripción,fecha=:fecha,hora=:hora,id_mascota=:id_mascota WHERE id_eventos = :id_eventos";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		
$this->nombre=htmlspecialchars(strip_tags($this->nombre));
$this->descripción=htmlspecialchars(strip_tags($this->descripción));
$this->fecha=htmlspecialchars(strip_tags($this->fecha));
$this->hora=htmlspecialchars(strip_tags($this->hora));
$this->id_mascota=htmlspecialchars(strip_tags($this->id_mascota));
$this->id_eventos=htmlspecialchars(strip_tags($this->id_eventos));
	 
		// bind new values
		
$stmt->bindParam(":nombre", $this->nombre);
$stmt->bindParam(":descripción", $this->descripción);
$stmt->bindParam(":fecha", $this->fecha);
$stmt->bindParam(":hora", $this->hora);
$stmt->bindParam(":id_mascota", $this->id_mascota);
$stmt->bindParam(":id_eventos", $this->id_eventos);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	// delete the eventos
	function delete(){
	 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id_eventos = ? ";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id_eventos));
	 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id_eventos);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
}


?>
