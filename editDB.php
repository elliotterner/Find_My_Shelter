<?php

// Name of File: editDB.php
// Purpose of File: The purpose of this file is to provide input fields for the user to put in any information that they are 
// wishing to alter to the database. Once the user is satisifed with the changes they have made, they can click the "update" button,
// which will pass all of the input fields (within a form element) using the POST method to update.php
// Creation date: 03/08/23
// Authors: Elliot Terner



//connect to DB
require_once("config/db.php");
//grab shelter ID that user selected on view.php
$SID = $_GET['GetID'];
//pass in ID to query, get information from DB only from selected shelter ID
$query = "select * from shelter_data where id='".$SID."'";
$result = mysqli_query($con,$query);


//store shelter row info in local variables
while($row=mysqli_fetch_assoc($result))
{
    $SID = $row['id'];
    $SName = $row['name'];
    $SAddress = $row['address'];
    $SPhone = $row['phone'];
    $SWebsite = $row['website'];
    $SPolicies = $row['policies'];
    $SReservation = $row['reservation'];
    $SAccomodations = $row['accomodations'];
}


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Find My Shelter</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet"> 
  </head>
  <body>
    <header>
      <div class="login">
        <a href="login.html">Shelter Staff Login</a>
      </div>
      <h1 class="top-of-page">Find my Shelter</h1>
    </header>

    <nav>
      <ul>
        <li><a href="findMyShelter.php">Home</a></li>
        <li><a href="coldWeatherPage.html">Emergency Cold Weather Shelter</a></li>
        <li><a href="aboutPage.html">About</a></li>
        <li><a href="contactPage.html">Contact</a></li>
      </ul>
    </nav>
<!--pass in DB information to populate input fields-->
    <div class="form-container">
      <!--Send input field inforamtion to update.php using POST method-->
      <form action="update.php?ID=<?php echo $SID ?>" method="POST" class="form">
        <label for="name">Name:</label>
        <input id="name" name="name" type="text" placeholder="Name" value="<?php echo $SName ?>">
        <label for="address">Address:</label>
        <input id="address" name="address" type="text" placeholder="Address" value="<?php echo $SAddress ?>">
        <label for="phone">Phone:</label>
        <input id="phone" name="phone" type="text" placeholder="Phone" value="<?php echo $SPhone ?>">
        <label for="website">Website:</label>
        <input id="website" name="website" type="text" placeholder="Website" value="<?php echo $SWebsite ?>">
        <label for="policies">Policies:</label>
        <input id="policies" name="policies" type="text" placeholder="Policies" value="<?php echo $SPolicies ?>">
        <label for="reservation">Reservation:</label>
        <input id="reservation" name="reservation" type="text" placeholder="Reservation" value="<?php echo $SReservation ?>">
        <label for="accomodations">Accommodations:</label>
        <input id="accomodations" name="accomodations" type="text" placeholder="Accommodations" value="<?php echo $SAccomodations ?>">
        <button name="update">Update</button>
      </form>
    </div>
      <p></p>

    </form>

    <footer>
      <p>&copy; 2023 Safe Sleeping Sites</p>
    </footer>
  </body>
</html>