<?php
class Mascota{
 
    // database connection and table name
    private $conn;
    private $table_name = "mascota";
	private $pageNo = 1;
	private  $no_of_records_per_page=30;
    // object properties
	
public $id_mascota;
public $nombre;
public $edad;
public $animal;
public $raza;
public $foto_mascota;
public $id_usuario;
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read mascota
	function read(){
		if(isset($_GET["pageNo"])){
		$this->pageNo=$_GET["pageNo"];
		}
		$offset = ($this->pageNo-1) * $this->no_of_records_per_page; 
		// select all query
		$query = "SELECT  t.* FROM ". $this->table_name ." t  WHERE id_usuario LIKE ". $this->id_usuario ." LIMIT ".$offset." , ". $this->no_of_records_per_page."";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	// create mascota
	function create(){
	 
		// query to insert record
		$query ="INSERT INTO ".$this->table_name." SET nombre=:nombre,edad=:edad,animal=:animal,raza=:raza,foto_mascota=:foto_mascota,id_usuario=:id_usuario";

		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		
$this->nombre=htmlspecialchars(strip_tags($this->nombre));
$this->edad=htmlspecialchars(strip_tags($this->edad));
$this->animal=htmlspecialchars(strip_tags($this->animal));
$this->raza=htmlspecialchars(strip_tags($this->raza));
$this->foto_mascota=htmlspecialchars(strip_tags($this->foto_mascota));
$this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
	 
		// bind values
		
$stmt->bindParam(":nombre", $this->nombre);
$stmt->bindParam(":edad", $this->edad);
$stmt->bindParam(":animal", $this->animal);
$stmt->bindParam(":raza", $this->raza);
$stmt->bindParam(":foto_mascota", $this->foto_mascota);
$stmt->bindParam(":id_usuario", $this->id_usuario);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
	
	// used when filling up the update mascota form
	function readOne(){
	 
		// query to read single record
		$query = "SELECT  t.* FROM ". $this->table_name ." t  WHERE t.id_mascota = ? LIMIT 0,1";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id_mascota);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		
$this->id_mascota = $row['id_mascota'];
$this->nombre = $row['nombre'];
$this->edad = $row['edad'];
$this->animal = $row['animal'];
$this->raza = $row['raza'];
$this->foto_mascota = $row['foto_mascota'];
$this->id_usuario = $row['id_usuario'];
	}
	
	// update the mascota
	function update(){
	 
		// update query
		$query ="UPDATE ".$this->table_name." SET nombre=:nombre,edad=:edad,animal=:animal,raza=:raza,foto_mascota=:foto_mascota,id_usuario=:id_usuario WHERE id_mascota = :id_mascota";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		
$this->nombre=htmlspecialchars(strip_tags($this->nombre));
$this->edad=htmlspecialchars(strip_tags($this->edad));
$this->animal=htmlspecialchars(strip_tags($this->animal));
$this->raza=htmlspecialchars(strip_tags($this->raza));
$this->foto_mascota=htmlspecialchars(strip_tags($this->foto_mascota));
$this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
$this->id_mascota=htmlspecialchars(strip_tags($this->id_mascota));
	 
		// bind new values
		
$stmt->bindParam(":nombre", $this->nombre);
$stmt->bindParam(":edad", $this->edad);
$stmt->bindParam(":animal", $this->animal);
$stmt->bindParam(":raza", $this->raza);
$stmt->bindParam(":foto_mascota", $this->foto_mascota);
$stmt->bindParam(":id_usuario", $this->id_usuario);
$stmt->bindParam(":id_mascota", $this->id_mascota);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	// delete the mascota
	function delete(){
	 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id_mascota = ? ";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id_mascota));
	 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id_mascota);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
}


?>
