<!--
Name of File: findMyShelter.php
Purpose of File: Contains all frontend elements of the main page
Creation date: 03/03/23
Authors: Andrew Liu (AL), Connor Maclachlan (CM), Elliot Terner (ET), Ryan Heise (RH)
-->

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
        <a href="view.php">Admin Portal</a>
      </div>
      <h1 class="top-of-page">Find my Shelter</h1>
    </header>


    <!--
      Top Page Links
    -->
    <nav>
      <ul>
        <li><a href="findMyShelter.php">Home</a></li>
        <li><a href="coldWeatherPage.html">Emergency Cold Weather Shelter</a></li>
        <li><a href="aboutPage.html">About</a></li>
        <li><a href="contactPage.html">Contact</a></li>
      </ul>
    </nav>

    <!--
      Main contents of home page
    -->
    <div class="inner">

      <!--
        Sidebar
      -->
      <div id="sidebar">
        <!--
          Filters
        -->
        <h2>Filters</h2>
        <div>
          <p style="color: #7a003c; margin-left: 10px; margin-top: 20px; margin-bottom:5px; font-size: 16px;">Policies</p>
          <label>
            <input type="checkbox" class="options" name="domestic-violence-survivor" value="Domestic violence survivors">
            Domestic and sexual violence survivors 
          </label>
          <label>
            <input type="checkbox" class="options" name="families" value="Families with children">
            Families with children
          </label>
          <label>
            <input type="checkbox" class="options" name="over-18" value="18+">
            18+
          </label>
          <label>
            <input type="checkbox" class="options" name="u18"  value="Under 18">
            Under 18
          </label>
          <label>
            <input type="checkbox" class="options" name="drug-test" value="Drug test">
            Drug test
          </label>
          <label>
            <input type="checkbox" class="options" name="background-check" value="Background check">
            Background check
          </label>
          

          <p style="color: #7a003c; margin-left: 10px; margin-top: 20px; margin-bottom:5px; font-size: 16px;">Accommodations</p>
          <label>
            <input type="checkbox" class="options" name="tmp-housing" value="Temporary housing">
            Temporary housing
          </label>
          <label> 
            <input type="checkbox" class="options" name="group-homes" value="Group homes">
            Group homes
          </label>
          <label>
            <input type="checkbox" class="options" name="emergency-shelter" value="Emergency shelter">
            Emergency shelter
          </label>
          <label>
            <input type="checkbox" class="options" name="safe-parking" value="24/7 safe parking location">
            24/7 safe parking location
          </label>
          <label>
            <input type="checkbox" class="options" name="crisis-hotline" value="24-hour crisis hotline">
            24-hour crisis hotline
          </label>
          <label> 
            <input type="checkbox" class="options" name="food" value="Food">
            Food
          </label>
          <label>
            <input type="checkbox" class="options" name="bathroom" value="Bathroom">
            Bathroom
          </label>
          <label>
            <input type="checkbox" class="options" name="heating" value="Heating">
            Heating
          </label>
          <label> 
            <input type="checkbox" class="options" name="healthcare" value="Healthcare">
            Healthcare
          </label>
          <label>
            <input type="checkbox" class="options" name="case-management" value="Case management">
            Case management
          </label>
          <label>
            <input type="checkbox" class="options" name="peer-counseling" value="Peer counseling">
            Peer counseling
          </label>
          <label> 
            <input type="checkbox" class="options" name="child-care" value="Child care">
            Child care
          </label>
          <label>
            <input type="checkbox" class="options" name="rehabilitation" value="Rehabilitation">
            Rehabilitation
          </label>
          <label>
            <input type="checkbox" class="options" name="immigration-services" value="Immigration legal services">
            Immigration legal services
          </label>
          <label> 
            <input type="checkbox" class="options" name="re-housing" value="Re-housing assistance">
            Re-housing assistance
          </label>
          <label>
            <input type="checkbox" class="options" name="workout" value="Workout facilities">
            Workout facilities
          </label>
          <label>
            <input type="checkbox" class="options" name="chapel" value="Chapel">
            Chapel
          </label>
          <label> 
            <input type="checkbox" class="options" name="tv" value="TV">
            TV
          </label>
          <label>
            <input type="checkbox" class="options" name="transportation-vouchers" value="Transportation vouchers">
            Transportation vouchers
          </label>


          <button id="clear-btn" type="clear">Clear filters</button>
        </div>

        <hr class="divider">

        <!--
          Google Maps API
        -->
        <div id="map"></div>
      </div> <!-- End of Side Bar -->
      
      <!--
        Safe sleeping site content
      -->
      <div id="content">
        <h2>Enter Current Sleeping Location</h2>

        <!-- Adding search bar to manually input location-->
        <div>
          <input id="search-bar" type="text" name="curr-address" placeholder="1234 5th street">
          <button id="search-btn" type="search">Search</button>
        </div>
  
        <button id="curr-location" class="curr-location">Use Current Location</button>

        <hr class="divider"> <!-- Divider to separate input from output -->

        <!--
          Safe sleeping site cards

          This contains:
            Shelter name
            Description
            Link to reserve a spot
            Number of spots available
            Ammount of miles away
            Directions to shelter
        -->
        <div id="box-container">
          <?php include('shelters.php'); ?>
        </div>
        
        <footer>
          <span><p>&copy; 2023 Find My Shelter</p></span>
        </footer>
      </div> <!-- End of Content -->
        
      

    <script
      src="https://maps.googleapis.com/maps/api/js?key=keyhere&callback=initMap&v=weekly"
      defer
    ></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=keyhere&callback=initMap&libraries=places&v=weekly"
      defer
    ></script>
    <script src="shelter_cards.js"></script>
    <script src="scripts.js"></script> 
  </body>
</html>
