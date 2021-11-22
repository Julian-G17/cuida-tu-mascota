<?php
class Usuario{
 
    // database connection and table name
    private $conn;
    private $table_name = "usuario";
	private $pageNo = 1;
	private  $no_of_records_per_page=30;
    // object properties
	
	public $id_usuario;
	public $username;
	public $contrasena;
	public $nombre;
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read usuario
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
	
	// create usuario
	function create(){
	 
		// query to insert record
		$query ="INSERT INTO ".$this->table_name." SET username=:username,contrasena=:contrasena,nombre=:nombre";

		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		
$this->username=htmlspecialchars(strip_tags($this->username));
$this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
$this->nombre=htmlspecialchars(strip_tags($this->nombre));
	 
		// bind values
		
$stmt->bindParam(":username", $this->username);
$stmt->bindParam(":contrasena", $this->contrasena);
$stmt->bindParam(":nombre", $this->nombre);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
	
	// used when filling up the update usuario form
	function readOne(){
	 
		// query to read single record
		$query = "SELECT  t.* FROM ". $this->table_name ." t  WHERE t.id_usuario = ? LIMIT 0,1";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id_usuario);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		
$this->id_usuario = $row['id_usuario'];
$this->username = $row['username'];
$this->contrasena = $row['contrasena'];
$this->nombre = $row['nombre'];
	}
	
	// update the usuario
	function update(){
	 
		// update query
		$query ="UPDATE ".$this->table_name." SET username=:username,contrasena=:contrasena,nombre=:nombre WHERE id_usuario = :id_usuario";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		
$this->username=htmlspecialchars(strip_tags($this->username));
$this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
$this->nombre=htmlspecialchars(strip_tags($this->nombre));
$this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
	 
		// bind new values
		
$stmt->bindParam(":username", $this->username);
$stmt->bindParam(":contrasena", $this->contrasena);
$stmt->bindParam(":nombre", $this->nombre);
$stmt->bindParam(":id_usuario", $this->id_usuario);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	// delete the usuario
	function delete(){
	 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE id_usuario = ? ";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id_usuario));
	 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id_usuario);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}

	///login user
	function login(){
		
		/// user query
		$query = "SELECT * FROM " . $this->table_name . " WHERE username LIKE '" . $this->username . "' AND contrasena LIKE '" . $this->contrasena . "'";

		$stmt = $this->conn->prepare($query);

		if($stmt->execute()){
		
			// get retrieved row
			$result = $stmt -> fetchAll();

			if(sizeof($result) == 1){
				return array(	"nombre" => $result[0]["nombre"],
								"id" => $result[0]["id_usuario"]);
			}else{
				return null;
			}

		}else{
			return null;
		}
		
	}
}


?>
