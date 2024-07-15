<?php
    $servername="localhost";
    $username = "root";
    $password = "";
    $database = "nexus_events";

    $conn= mysqli_connect($servername,$username,$password,$database);

   if(!$conn){
       echo "connection fail";

   }
    else
   {
        // echo "success connection";
    }
?>