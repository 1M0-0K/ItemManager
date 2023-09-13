<?php
	
	DEFINE("HOST", "localhost");
	DEFINE("USER", "root");
	DEFINE("PASSWORD", "123456789");
	DEFINE("DATABASE", "item_manager");

    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    if(!$connection){
        echo "Database connection error ".mysqli_connect_error()."\n";
    }

?>
