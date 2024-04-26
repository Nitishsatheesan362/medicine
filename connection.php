<?php

    $database= new mysqli("localhost:5050","root","","edoc");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>