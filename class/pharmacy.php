<?php
    class Pharmacy{

        // conn
        private $conn;

        // table
        private $dbTable = 'farmacias';

        // col
        public $id;
        public $nombre;
        public $direccion;
        public $latitud;
        public $longitud;
      

        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        // GET Pharmacy
        public function getPharmacy(){
            $sqlQuery = "SELECT id, nombre, direccion, latitud, longitud FROM " . $this->dbTable . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE Pharmacy
        public function createPharmacy(){
            $sqlQuery = "INSERT INTO
                        ". $this->dbTable ."
                    SET
                        nombre = :nombre, 
                        direccion = :direccion, 
                        latitud = :latitud, 
                        longitud = :longitud";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nombre=htmlspecialchars(strip_tags($this->nombre));
            $this->direccion=htmlspecialchars(strip_tags($this->direccion));
            $this->latitud=htmlspecialchars(strip_tags($this->latitud));
            $this->longitud=htmlspecialchars(strip_tags($this->longitud));
            
        
            // bind data
            
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":direccion", $this->direccion);
            $stmt->bindParam(":latitud", $this->latitud);
            $stmt->bindParam(":longitud", $this->longitud);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // GET Pharmacy
        public function getSinglePharmacy(){
            $sqlQuery = "SELECT
                        id, 
                        nombre, 
                        direccion, 
                        latitud, 
                        longitud
                      FROM
                        ". $this->dbTable ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nombre = $dataRow['nombre'];
            $this->direccion = $dataRow['direccion'];
            $this->latitud = $dataRow['latitud'];
            $this->longitud = $dataRow['longitud'];
        }        

        // UPDATE Pharmacy
        public function updatePharmacy(){
            $sqlQuery = "UPDATE
                        ". $this->dbTable ."
                    SET
                        nombre = :nombre, 
                        direccion = :direccion, 
                        latitud = :latitud, 
                        longitud = :longitud
                       
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nombre=htmlspecialchars(strip_tags($this->nombre));
            $this->direccion=htmlspecialchars(strip_tags($this->direccion));
            $this->latitud=htmlspecialchars(strip_tags($this->latitud));
            $this->longitud=htmlspecialchars(strip_tags($this->longitud));
           
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nombre", $this->nombre);
            
            $stmt->bindParam(":direccion", $this->direccion);
            $stmt->bindParam(":latitud", $this->latitud);
            $stmt->bindParam(":longitud", $this->longitud);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE User
        function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->dbTable . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

