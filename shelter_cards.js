/* 
Name of File: shelter_cards.js
Purpose of File: Event listener for the search button on the main page. Responsible for backend queries.
Creation date: 03/08/23
Authors: Andrew Liu (AL), Ryan Heise (RH) Connor Maclachlan (CM)
*/

// Get relevant HTML elements to update
const boxContainer = document.getElementById('box-container');
const searchBoxes = document.querySelectorAll(".options");

// Add event listener for search button so cards update when clicked

/*
 * Update cards on the webpage with new data from the backend. This gets search parameters from the 
 * checkboxes on the main page as well as the text input for the address.
 */
function updateCards(origin) {
  // This function updates the cards with existing search data
  // Process input arguments
  const searchParameters = document.querySelectorAll(".options");
  var args = "";
  // Concatenates inputs in a way that the shelter search function can understand
  searchParameters.forEach(element => {
    if (element.checked) {
      if (args != "") {
        args += ","
      }
      args += element.value;
    }
  });
  // Update shelter cards
  const fetchUrl = args == "" ? "shelters.php" : "shelters.php?search=" + encodeURIComponent(args);
  fetch(fetchUrl, {
    method:'post'
  })
  // Update the existing HTML
  .then(function (response) {
    return response.text();
  })
  .then(function (body) {
    boxContainer.innerHTML = body;
    return boxContainer;
  })
  // Update cards with location data
  .then(function(cards) {
    // Get the inputted location
    searchString = null;
    if (document.getElementById("search-bar").value.replace(/\s+/g, '') != "") {
      searchString = document.getElementById("search-bar").value;
    }
    if (searchString != null && searchString != "") {
      // Set the HTML elements corresponding to distance with distance calculations
      calcDistance(searchString, true);

      // Update the card hyperlinks
      setDirections(origin);
    }
  });
}