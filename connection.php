<?php
    error_reporting(0);
    $servername="localhost";
    $username= "root";
    $password = "";
    $dbname = "hogwarts";
    $conn = mysqli_connect($servername,$username,$password,$dbname);

    if($conn)
    {
        //echo("Connection Created");
    }
    else
    {
        die("connection not created due to : ".mysqli_connect);
    }
?>