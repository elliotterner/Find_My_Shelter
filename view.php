<?php
// Name of File: view.php
// Purpose of File: the purpose of this file is to connect to the database, query all of the information stored in the DB
// then display all of the DB information within the embeddedd HTML
// Creation date: 03/08/23
// Authors: Elliot Terner


//connect to database
require_once("config/db.php");
// pass in query to be used
//in this case we are looking to grab all of the inforamtion in the DB which is reflected in the following query:
$query = "select * from shelter_data";
$result = mysqli_query($con,$query);


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
    <!--create header-->
    <header>
      <div class="login">
      <a href="view.php">Admin Portal</a>
      </div>
      <h1 class="top-of-page">Find my Shelter</h1>
    </header>
<!--navigation links to other pages within system-->
    <nav>
      <ul>
        <li><a href="findMyShelter.php">Home</a></li>
        <li><a href="coldWeatherPage.html">Emergency Cold Weather Shelter</a></li>
        <li><a href="aboutPage.html">About</a></li>
        <li><a href="contactPage.html">Contact</a></li>
      </ul>
    </nav>


  <h1>Shelter Admin Portal</h1>
  <p style="text-align: center;">Click "Edit" to alter any values in the database</p>


    <div>
        <div>
            <div>
                <div class="table-container">
                    <table class="data-table">
                        <tr>
                            <td style="padding-left:20px; padding-right:20px">ID</td>
                            <td style="padding-left:20px; padding-right:20px">Name</td>
                            <td style="padding-left:20px; padding-right:20px">Address</td>
                            <td style="padding-left:20px; padding-right:20px">Phone</td>
                            <td style="padding-left:20px; padding-right:20px">Website</td>
                            <td style="padding-left:20px; padding-right:20px">Policies</td>
                            <td style="padding-left:20px; padding-right:20px;">Reservation</td>
                            <td style="padding-left:20px; padding-right:20px;">Aaccomodations</td>
                        </tr>
                        <?php
                        //loop through results returned from query, in this case it is every row of database
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $SID = $row['id'];
                                $SName = $row['name'];
                                $SAddress = $row['address'];
                                $SPhone = $row['phone'];
                                $SWebsite = $row['website'];
                                $SPolicies = $row['policies'];
                                $SReservation = $row['reservation'];
                                $SAccomodations = $row['accomodations'];

                        ?>
                            <tr>
                                <td style="padding-left:20px; padding-right:20px"><?php echo $SID ?></td>
                                <td style="padding-left:20px; padding-right:20px"><?php echo $SName ?></td>
                                <td style="padding-left:20px; padding-right:20px"><?php echo $SAddress ?></td>
                                <td style="padding-left:20px; padding-right:20px"><?php echo $SPhone ?></td>
                                <td style="padding-left:20px; padding-right:20px"><a href="<?php echo $SWebsite ?>"><?php echo strtok($SWebsite, "/") ?></a></td>
                                <td style="padding-left:20px; padding-right:20px"><?php echo $SPolicies ?></td>
                                <td style="padding-left:20px; padding-right:20px;"><?php echo $SReservation ?></td>
                                <td style="padding-left:20px; padding-right:20px;"><?php echo $SAccomodations ?></td>
                                <!-- store ID of shelter user is wishing to edit-->
                                <td style="padding-left:20px; padding-right:20px;"><a href="editDB.php?GetID=<?php echo $SID?>">Edit</a></td>
                            </tr>
                            <?php
                                    }
                            ?>
                            
                    </table>
                </div>
            </div>
        </div>
    </div>



    <footer>
      <p>&copy; 2023 Safe Sleeping Sites</p>
    </footer>
  </body>
</html>