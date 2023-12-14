<?php
class Database 
{
   	  // Database Details
         private const DBHOST = 'localhost';
         private const DBUSER = 'root';
         private const DBPASS = '';
         private const DBNAME = 'demos';
         // Data Source Network
         private $pdo = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME . '';
         // conn variable
         protected $conn = null;


	  // Constructor Function
	  public function __construct() {
	    try {
	      $this->conn = new PDO($this->pdo, self::DBUSER, self::DBPASS);
	      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	    } catch (PDOException $e) {
	    //   die('Connectionn Failed : ' . $e->getMessage());
        header('Content-Type: application/json');
          echo json_encode(array( 
            "status" => "error", 
            "message" => 'Connectionn Failed : ' . $e->getMessage()
        ), JSON_PRETTY_PRINT);
	    }
	    // return $this->conn;
	  }

  
}      
?>