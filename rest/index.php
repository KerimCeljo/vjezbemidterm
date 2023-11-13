<?php

require "../vendor/autoload.php";
require "./services/MidtermService.php";


Flight::route('/', function () {
    // echo 'hello world!';

    echo "<table style='border: solid 1px black;'>";
    echo "<tr><th>Id</th><th>ShareClassId</th><th>ShareClassCategoryId</th> <th>InvestorId</th><th>dilutedShares</th> </tr>";

    class TableRows extends RecursiveIteratorIterator {
        function __construct($it)
        {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current()
        {
            return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
        }

        function beginChildren()
        {
            echo "<tr>";
        }

        function endChildren()
        {
            echo "</tr>" . "\n";
        }
    }




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
        $conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password, $options);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


    $stmt = $conn->prepare("SELECT * FROM cap_table");
    $stmt->execute();


    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
        echo $v;
    }

});


require 'routes/MidtermRoutes.php';

Flight::start();
?>