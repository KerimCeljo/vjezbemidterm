<?php

class MidtermDao {

    private $conn;

    /**
    * constructor of dao class
    */
    public function __construct(){

      
        try {

        /** TODO
        * List parameters such as servername, username, password, schema. Make sure to use appropriate port
        */
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $schema = "vjezbemidterm";

        /*options array neccessary to enable ssl mode - do not change*/
        $options = array(
        	PDO::MYSQL_ATTR_SSL_CA => 'https://drive.google.com/file/d/1g3sZDXiWK8HcPuRhS0nNeoUlOVSWdMAg/view?usp=share_link',
        	PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,

        );

        /** TODO
        * Create new connection
        * Use $options array as last parameter to new PDO call after the password
        */
          $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password, $options);
        // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully form constructor";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
        
    }

    /** TODO
    * Implement DAO method used to get cap table
    */
    public function cap_table(){

      $stmt = $this->conn->prepare("SELECT * FROM cap_table");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /** TODO
    * Implement DAO method used to get summary
    */
    public function summary(){
      $stmt = $this->conn->prepare("SELECT investor_id, SUM(diluted_shares) AS total
      FROM cap_table cp
      GROUP BY investor_id;"
      );
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);      


    }

    /** TODO
    * Implement DAO method to return list of investors with their total shares amount
    */
    public function investors(){

      $stmt = $this->conn->prepare("SELECT i.id,i.first_name, SUM(diluted_shares) AS total FROM investors i LEFT JOIN cap_table ct ON i.id= ct.investor_id GROUP BY i.first_name, i.id");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}
?>
