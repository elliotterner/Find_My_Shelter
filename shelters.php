<!-- 
Name of File: shelters.php
Purpose of File: The purpose of this file is to expose a backend query API for the database, which will return valid HTML to be rendered.
Usage: Querying with Javascript's Fetch API, e.g. fetch("shelters.php?search=parameter1,parameter2", {method:'post'})
Creation date: 03/07/23
Authors: Andrew Liu (AL), Connor Maclachlan (CM), Ryan Heise (RH)
 -->

<head>
  <script type="text/javascript" src="scripts.js"></script>
</head>

<?php

  // Get page arguments, or use empty args array if none are present
  // These should be formatted as comma delineated arguments, spaces
  $args = isset($_GET["search"]) ? explode(",", $_GET["search"]) : [];

  $results = "";
  $i = 1;
  foreach(searchByParameter($args) as $row) {
    // Populate HTML elements with corresponding data
    echo '<div class="box">';
    echo '<div class="left-box">';
    echo '<span class="id-circle" name="id">' . $i . '</span>';
    echo '<p class="name" name="shelter-name"><a href="' . $row["website"] . '" name="website">' . $row["name"] . '</a></p>';
    echo '<p name="phone"><b>Phone: </b>' . $row["phone"] . '</p>';
    echo '<p class="requirements" name="policies"><b>Policies: </b>' . $row["policies"] . '</p>';
    echo '<p class="requirements" name="accomodations"><b>Accommodations: </b>' . $row["accomodations"] . '</p>';
    echo '<p><b>Reservation: </b>' . $row["reservation"] . '</p>';
    echo '</div>';
    echo '<div class="right-box">';
    $spots_available = $row["spots_available"];
    $bg_color = ($spots_available == 0) ? 'background-color: red;' : '';
    echo '<span class="spots-available" name="spots-available" style="'.$bg_color.'">' . $spots_available . '</span>';    echo '<p class="spots" >Spots Available</p>';
    echo '<p class="miles" name="miles-away-' . $i . '">' . '<span class="distance" id="distance-' . $i . '"></span>'.'</p>';
    echo '<p class="address" name="address" id="address-'. $i .'">Address: ' . $row["address"] . '</p>';
    echo '<p><a id="directions-'. $i .'" href="#">Directions</a></p>';
    echo '</div>';
    echo '</div>';
    $i++;
  }
  $results .= "</pre>";
  echo $results;
  
  /**
   * Connects and searches the database for rows matching the given parameters.
   * @param params An array of provided parameters; default to an empty array
   * @return results An array of matching rows
   */
  function searchByParameter($params = []) {
    // Connect to database
    include('connectionData.txt');
    $conn = mysqli_connect($server, $user, $pass, $dbname, $port);

    // Error handling for a failed connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    // Query database for all data, with error handling, and close after finished
    $result = $conn->query("SELECT * FROM shelter_data") or die(mysqli_error($conn));
    $conn->close();

    $results = [];

    if ($result->num_rows > 0) {
      // Begin main loop, iterating over returned results if any
      while($row = $result->fetch_assoc()) {
        $reqs = explode(", ", $row["policies"]);
        $accomodations = explode(", ", $row["accomodations"]);
        // Add matching elements if filters are provided
        if (count($params) == 0) {
          $results[] = $row;
        }
        // Otherwise add all elements in the database
        else {
          $isValid = true;
          foreach ($params as &$param) {
            if (!in_array($param, $reqs) && !in_array($param, $accomodations)) {
              $isValid = false;
            }
          }
          if ($isValid) {
            $results[] = $row;
          }
        }
      }
    }

    return $results;
  }
?>
