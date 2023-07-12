<?php
// Name of File: update.php
// Purpose of File: The purpose of this file is to update the database with the information passed to update.php from
// editDB.php. This information is stored within local variables within this file, then passed into a query which updates each
// attribute within the database that the user has altered
// Creation date: 03/08/23
// Authors: Elliot Terner



//connect to DB
require_once("config/db.php");

//store updated shelter values from editDB.php in local variables. Obtained used $_GET
if(isset($_POST['update']))
{
    $SID = $_GET['ID'];
    $SName = $_POST['name'];
    $SAddress = $_POST['address'];
    $SPhone = $_POST['phone'];
    $SWebsite = $_POST['website'];
    $SPolicies = $_POST['policies'];
    $SReservation = $_POST['reservation'];
    $SAccomodations = $_POST['accomodations'];

    // Prepare the query with placeholders
    $query = "UPDATE shelter_data SET 
              name = ?,
              address = ?,
              phone = ?,
              website = ?,
              policies = ?,
              reservation = ?,
              accomodations = ?
              WHERE ID = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($con, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sssssssi", $SName, $SAddress, $SPhone, $SWebsite, $SPolicies, $SReservation, $SAccomodations, $SID);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if($result)
    {
        header("location:view.php");
    }
    else
    {
        echo 'Please check the query.';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
else
{
    header("location:view.php");
}
?>