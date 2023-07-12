/* 
Name of File: scripts.js
Purpose of File: Contains various scripts relating to the Google Maps API
Creation date: 03/06/23
Authors: Andrew Liu (AL), Connor Maclachlan (CM), Ryan Heise (RH)
*/


/**
 * Initializes the map on the main page.
 */



function initMap(){
    /* Initializes map on website, given the provided options*/

    var options = {
        zoom:8,
        center:{lat:44.0521,lng:-123.0868}
    }
    // Map element
    const map = new google.maps.Map(document.getElementById("map"), options);

    // Origin location marker initialization
    var originMK = new google.maps.Marker({map:map});

    // Linking current location event listener to current location button in html
    const currentLoc = document.getElementById("curr-location");
    currentLoc.addEventListener("click", () => {

        // Current location function call
        useCurrLoc(map,originMK);
        setDirections(originMK);
    });
    
    // Options for formatting address autocomplete
    const autocomp_opts = {
        fields: ["formatted_address", "geometry", "name"],
        strictBounds: false,
        types: []
    };

    // Address autocomplete initializer and html connection
    const autocomplete = new google.maps.places.Autocomplete(
        document.getElementById("search-bar"),
        autocomp_opts
    );

    // Autocomplete event listener and function call
    autocomplete.addListener("place_changed", () => {

        // When location changes, set marker to invisible and call autocomplete function
        originMK.setVisible(false);
        manualLocation(autocomplete, map, originMK);
        calcDistance(originMK);
        setDirections(originMK);

        }
    )

    const searchBtn = document.getElementById('search-btn');
    searchBtn.addEventListener('click', () => {
        updateCards(originMK);
      });
}


/**
 * Update cards on the webpage with new data from the backend. This gets search parameters from the 
 * @param originMK the origin address of the distance query
 * @param isAddressString whether the input is a string corresponding to an address or not; defaults
 *                        to false which means it will treat the input as a coordinate
 */
function calcDistance(originMK, isAddressString = false) {
    /* Finds the calculated distance between the origin point and all shelter locations in the database
     * Also modifies existing HTML elements
     */
    const origin = isAddressString ? originMK : originMK.position;
    let directionsService = new google.maps.DirectionsService();
    const cardsList = document.querySelectorAll(".box");
    // Iterate over existing card elements
    cardsList.forEach(function(element, index) {
        // setTimeout adds a 1000 ms delay after 10 API queries due to a rate limit
        setTimeout(() => {
            // Get the route for the current card's address from the input location
            const dest = element.getElementsByClassName("address")[0].textContent;
            const route = {
                origin: origin,
                destination: dest,
                travelMode: 'DRIVING'
            }
            directionsService.route(route, function(response) {
                var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
                if (!directionsData) {
                    window.alert('Distance request failed');
                }
                else {
                    // Replace existing HTML elements
                    element.getElementsByClassName("miles")[0].textContent = directionsData.distance.text + "les away";
                }
            });
        }, index > 8 ? 1000 * (index - 8) : 0);
    });
}

function setDirections(origin){
    var numberOfElements = document.getElementById("box-container").children.length;
    for (let i = 1; i < numberOfElements; i++) {
        let dest = document.getElementById('address-'+i).textContent.slice(9);
        let link = document.getElementById('directions-'+i);
        link.href = 'https://maps.google.fr/maps?saddr=' + origin.position + '&daddr=' + dest;
        link.target = "_blank";
      }
}

/**
 * This function uses the browser to request geolocation access from the user. If successful,
 * sets the map's focus to the user's current location.
 * @param map A reference to the map to update
 * @param marker The marker corresponding to the user's location
 */
function useCurrLoc(map, marker){
    /** 
     *  Assigns browser geolocation to the origin map marker
     */
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setZoom(18);
                marker.setPosition(pos);
                map.setCenter(pos);
                calcDistance(marker);
                setDirections(marker);
            },

            () => {
                currentLocError(true);
            }
        );
    } 
    else {
        currentLocError(false);
    }
}

/** 
 * Handles errors for the current location function. 
 * @param hasLocation Boolean corresponding to whether the geolocation was successful or not
 */
function currentLocError(hasLocation) {
    if(hasLocation){
        alert("Error: Could not access current location.");
    } else {
        alert("Error: Your browser doesn't support the use of device location.");
    }
}

/** 
 * Gets location input from the user.
 * @param autocomplete whether the function should use autocomplete for suggestions
 * @param map A reference to the map to update
 * @param marker The marker corresponding to the user's location
 */
function manualLocation(autocomplete, map, marker){
    // Function takes in autocomplete element
    const place = autocomplete.getPlace();
    // Assigns origin to location manually entered by user
    if (place.name.length == 0) {
        // Returns error if location empty
        window.alert("Please enter a location or use your current location");
        return;
    }

    if (!place.geometry || !place.geometry.location) {
        // Returns error if location could not be found
        window.alert("Error: Could not find " + place.name);
        return;
    }

    if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
    } else {

        map.setCenter(place.geometry.location);
        map.setZoom(18);
    }

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
}

// waits for the clear button to be clicked in filters, then clears all active checkboxes
document.getElementById('clear-btn').addEventListener('click', function() {
    // Get all checkboxes
    const checkboxes = document.querySelectorAll('#sidebar input[type="checkbox"]');

    // Uncheck all checkboxes
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });
});