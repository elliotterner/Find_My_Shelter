<?php
// Name of File: db.php
// Purpose of File: this file simply connects to the database the system is storing
// shelter information on. It connects to the database using the mysqli_connect() function
// along with all of the necessary information required to connect to the DB
// Creation date: 03/08/23
// Authors: Elliot Terner

//connect to database 
$con = mysqli_connect("ix.cs.uoregon.edu", "FindMyShelter","FindMyShelter!","shelter", "3561");

//check connection
if(!$con){
    die("Connection Error");
}



?>