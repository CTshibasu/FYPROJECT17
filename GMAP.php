<?php
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(-1);

  // this PHP file will have the Google Map API code that will extract co-ordinates
  // from every "tag" marker and place on the Google Map by location

?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Marker Clustering</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map-canvas {
        height: 100%;
      }
      #bside{
        width: 700px;
        height: 700px;
        display: inline-block;
        margin-left: 20px;

      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .map-control {
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 2px 2px rgba(33, 33, 33, 0.4);
        font-family: 'Roboto','sans-serif';
        margin: 10px;
        /* Hide the control initially, to prevent it from appearing
           before the map loads. */
        /*display: none;*/
      }
      /* Display the control once it is inside the map. */
      #map .map-control { display: block; }

      .selector-control {
        font-size: 14px;
        line-height: 30px;
        padding-left: 5px;
        padding-right: 5px;
      }

    </style>
    <script sync src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoyi_PAvI2I9r_s8RnqH1qNp_xyKGggPE&v=3.29"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
  </head>
    <body>
      <!-- <div> -->
        <div id="style-selector-control"  class="map-control">
          <select id="style-selector" class="selector-control">
            <option value="default">Default</option>
            <option value="silver">Silver</option>
            <option value="night">Night mode</option>
            <option value="retro" selected="selected">Retro</option>
            <option value="hiding">Hide features</option>
          </select>
        </div>
        <div id="map-canvas"></div>
        <div id ="bside">
          <br>
            <h2>Type:</h2>
            <select id="type" onchange="filterMarkers(this.value);">
              <option value="">All</option>
              <option value="sessions">Sessions</option>
              <option value="events">Events</option>
            </select>
      <!-- </div> -->
    </body>
  <script>

      // for labelling types 
       var customLabel = {
          events: {
            label: 'E'
          },
          sessions: {
            label: 'S'
          }
        };

      // this is for the populated markers
      var gmarkers = [];

      // just a blank info window
      var infowindow = new google.maps.InfoWindow({maxWidth:200});

      /* This function here initializes the function initMap() */
      function initialize() {

        /* create new map object, with option of a zoom of 3
         * the default also starts around the Australia Region. */
        map = new google.maps.Map(document.getElementById('map-canvas'), {
          zoom: 3,
          center: {lat: 53.3128599, lng: -6.419280699999945}
        });
        // slight tilt
        // map.setTilt(45);

        // Add a style-selector control to the map.
        var styleControl = document.getElementById('style-selector-control');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(styleControl);

        // Set the map's style to the initial value of the selector.
        var styleSelector = document.getElementById('style-selector');
        map.setOptions({styles: styles[styleSelector.value]});

        // Apply new JSON when the user selects a different style.
        styleSelector.addEventListener('change', function() {
          map.setOptions({styles: styles[styleSelector.value]});
        });

        // Add a style-selector control to the map.
        var styleControl = document.getElementById('style-selector-control');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(styleControl);

        // Set the map's style to the initial value of the selector.
        var styleSelector = document.getElementById('style-selector');
        map.setOptions({styles: styles[styleSelector.value]});

        // Apply new JSON when the user selects a different style.
        styleSelector.addEventListener('change', function() {
          map.setOptions({styles: styles[styleSelector.value]});
        });

        // Create an array of alphabetical characters used to label the markers.
        // var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        // var markers = locations.map(function(location, i) {
        //   return new google.maps.Marker({
        //     position: location,
        //     label: labels[i % labels.length]
        //   });
        // });
        
        // ------------- NEWER PART -------------------
        // call the downloadUrl function on this
        // this is the link for one of the parameters of the downloadUrl function
        var xmlUrl = 'http://localhost:8886/SessionCURL/xml_gen.php';
        downloadUrl(xmlUrl, function(data){
          // call on the data from php file named above
          var xml = data.responseXML;
          markers = xml.documentElement.getElementsByTagName("marker");

          // alternative to Array.prototype.map() method
          for(i = 0; i < markers.length; i++){
              addMarker(markers[i]);
            }

            // Add a marker clusterer to manage the markers.
            markerCluster = new MarkerClusterer(map, gmarkers,
              {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
          });
      }
        
      var styles = {
        default: null,
        silver: [
          {
            elementType: 'geometry',
            stylers: [{color: '#f5f5f5'}]
          },
          {
            elementType: 'labels.icon',
            stylers: [{visibility: 'off'}]
          },
          {
            elementType: 'labels.text.fill',
            stylers: [{color: '#616161'}]
          },
          {
            elementType: 'labels.text.stroke',
            stylers: [{color: '#f5f5f5'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'labels.text.fill',
            stylers: [{color: '#bdbdbd'}]
          },
          {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [{color: '#eeeeee'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#757575'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry',
            stylers: [{color: '#e5e5e5'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#ffffff'}]
          },
          {
            featureType: 'road.arterial',
            elementType: 'labels.text.fill',
            stylers: [{color: '#757575'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#dadada'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'labels.text.fill',
            stylers: [{color: '#616161'}]
          },
          {
            featureType: 'road.local',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'geometry',
            stylers: [{color: '#e5e5e5'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'geometry',
            stylers: [{color: '#eeeeee'}]
          },
          {
            featureType: 'water',
            elementType: 'geometry',
            stylers: [{color: '#c9c9c9'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
          }
        ],

        night: [
          {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
          {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
          {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
          {
            featureType: 'administrative.locality',
            elementType: 'labels.text.fill',
            stylers: [{color: '#d59563'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#d59563'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry',
            stylers: [{color: '#263c3f'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#6b9a76'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#38414e'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry.stroke',
            stylers: [{color: '#212a37'}]
          },
          {
            featureType: 'road',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9ca5b3'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#746855'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [{color: '#1f2835'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'labels.text.fill',
            stylers: [{color: '#f3d19c'}]
          },
          {
            featureType: 'transit',
            elementType: 'geometry',
            stylers: [{color: '#2f3948'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'labels.text.fill',
            stylers: [{color: '#d59563'}]
          },
          {
            featureType: 'water',
            elementType: 'geometry',
            stylers: [{color: '#17263c'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#515c6d'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.stroke',
            stylers: [{color: '#17263c'}]
          }
        ],

        retro: [
          {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
          {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
          {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
          {
            featureType: 'administrative',
            elementType: 'geometry.stroke',
            stylers: [{color: '#c9b2a6'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'geometry.stroke',
            stylers: [{color: '#dcd2be'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'labels.text.fill',
            stylers: [{color: '#ae9e90'}]
          },
          {
            featureType: 'landscape.natural',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#93817c'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry.fill',
            stylers: [{color: '#a5b076'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#447530'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#f5f1e6'}]
          },
          {
            featureType: 'road.arterial',
            elementType: 'geometry',
            stylers: [{color: '#fdfcf8'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#f8c967'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [{color: '#e9bc62'}]
          },
          {
            featureType: 'road.highway.controlled_access',
            elementType: 'geometry',
            stylers: [{color: '#e98d58'}]
          },
          {
            featureType: 'road.highway.controlled_access',
            elementType: 'geometry.stroke',
            stylers: [{color: '#db8555'}]
          },
          {
            featureType: 'road.local',
            elementType: 'labels.text.fill',
            stylers: [{color: '#806b63'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'labels.text.fill',
            stylers: [{color: '#8f7d77'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'labels.text.stroke',
            stylers: [{color: '#ebe3cd'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'water',
            elementType: 'geometry.fill',
            stylers: [{color: '#b9d3c2'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#92998d'}]
          }
        ],

        hiding: [
          {
            featureType: 'poi.business',
            stylers: [{visibility: 'off'}]
          },
          {
            featureType: 'transit',
            elementType: 'labels.icon',
            stylers: [{visibility: 'off'}]
          }
        ]
      };

      // addMarker function
      function addMarker(markerElem){

        // adding the id of the session
        var id = markerElem.getAttribute('id');
        var name_link = markerElem.getAttribute('url');
        var member_id = markerElem.getAttribute('member-id');
        var member_name = markerElem.getAttribute('member-name');
        var member_url = markerElem.getAttribute('member-url');
        var date = markerElem.getAttribute('date');
        var venue_id = markerElem.getAttribute('venue-id');
        var venue_name = markerElem.getAttribute('venue-name');
        var venue_phone = markerElem.getAttribute('venue-phone');
        var venue_email = markerElem.getAttribute('venue-email');
        var venue_website = markerElem.getAttribute('venue-website');
        var town_id = markerElem.getAttribute('town-id');
        var town_name = markerElem.getAttribute('town_name');
        var country_id = markerElem.getAttribute('country-id');
        var country_name = markerElem.getAttribute('country-name');
        var type = markerElem.getAttribute('type');

        // takes care of co-ordinating the position of each markers by session
        var pos = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lon')));

        // var linker = markerElem.getAttribute('link_info');
        // var pic = markerElem.getAttribute('img_info');
        // var link_copy = linker;

        // now I create a div
        var contentBox = document.createElement('div');
        var strong = document.createElement('strong');

        strong.textContent = venue_name + " @ " + date;
        contentBox.appendChild(strong);
        contentBox.appendChild(document.createElement('br'));

        // successfully included the link in the content box
        var text = document.createElement('strong');
        text.textContent = "Host: ";
        contentBox.appendChild(text);
        var memURL = document.createElement('a');
        memURL.href = member_url;
        memURL.textContent = member_name;
        contentBox.appendChild(memURL);
        contentBox.appendChild(document.createElement('br'));

        // the website for the venue
        var venueText = document.createElement('strong');
        venueText.textContent = "Venue Website: ";
        contentBox.appendChild(venueText);
        var venueURL = document.createElement('a');
        venueURL.href = venue_website;
        venueURL.textContent = "Visit Venue";
        contentBox.appendChild(venueURL);
        contentBox.appendChild(document.createElement('br'));

        // now create a link for the locations
        contentBox.appendChild(document.createElement('br'));
        var linkURL = document.createElement('a');
        linkURL.href = name_link;
        linkURL.textContent = "Check Session.org!";
        contentBox.appendChild(linkURL);

        // create another div that holds information about the host and details
        // var hostBox = document.createElement('div');
        // var hostStrong = document.createElement('strong');

        // hostStrong.textContent = "Host: " + member_name;
        // hostBox.appendChild(hostStrong);
        // hostBox.appendChild(document.createElement('br'));


        // contentBox.appendChild(document.createElement('br'));
        // second line of marker
        // var text = document.createElement('text');
        // text.textContent = member_id
        // contentBox.appendChild(text);
        // contentBox.appendChild(document.createElement('br'));
        // contentBox.appendChild(document.createElement('br'));

        // other element
        // var container = document.createElement('div');
        // container.style.textAlign = "center";
        // var link = document.createElement('a');
        // var img = document.createElement('img');
        // link.href = linker;
        // img.src = pic;
        // img.height = 100;
        // img.width = 100;
        // link.appendChild(img);
        // container.appendChild(link);
        // contentBox.appendChild(container);
        // contentBox.appendChild(document.createElement('br'));

        // // add prompt for click, place at the bottom of the infoWindow
        // var linkText = document.createTextNode("Click Here for more info");
        // // make a copyLink
        // var copyLink = document.createElement('a');
        // copyLink.appendChild(linkText);
        // copyLink.title = 'Click Here';
        // copyLink.href = link_copy;
        // copyLink.textContent = 'Click Here for More';
        // contentBox.appendChild(copyLink);

        // contentBox.appendChild(document.createElement('br'));
        // var img = document.createElement("img");
        // img.src = pic;
        // img.height = 200;
        // img.width = 300;
        // contentBox.appendChild(img);

        var icon = customLabel[type] || {};

        // var content = contextBox;

        marker1 = new google.maps.Marker({
            title: venue_name,
            // secondTitle: member_id,
            position: pos,
            category: type,
            map: map,
            label: icon.label,
            // url: name_link,
            // image: img,
            animation: google.maps.Animation.DROP
            
        });

        gmarkers.push(marker1);

        // markers click listener
        google.maps.event.addListener(marker1, 'click', (function (marker1, contentBox) {
          return function () {
            console.log('Gmarker 1 gets pushed');
            infowindow.setContent(contentBox);
            infowindow.open(map, marker1);
            map.panTo(this.getPosition());
          }
        })(marker1, contentBox));
        // marker1.addListener('click', toggleBounce);

      }

       function toggleBounce() {
        if (marker1.getAnimation() !== null) {
          marker1.setAnimation(null);
        } else {
          marker1.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
      
      /**
       * Function to filter markers by category
       */
      filterMarkers = function (category) {
          // probably from here it may be ideal to clear the markerclusters
          markerCluster.clearMarkers();

          for (i = 0; i < markers.length; i++) {
              marker = gmarkers[i];

              // If is same category or category not picked
              if((typeof marker.category == 'string' && marker.category.indexOf(category) >= 0) || category.length == 0){
                  marker.setVisible(true);
                  markerCluster.addMarker(marker);
              }
              // Categories don't match 
              else {
                  marker.setVisible(false);
              }

              // now.....
          }
      }

      // --------------- NEWER PART --------------------- 
      // insert the downloadUrl function into the program
      function downloadUrl(url, callback) {  
        var request = window.ActiveXObject ? 
            new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;   
        request.onreadystatechange = function() {    
            if (request.readyState == 4) {            
                callback(request, request.status);    
            } 
        };   
        request.open('GET', url, true);  
        request.send(null); 
    }

    // ---------------- NEWER PART ---------------------
    // Init map
    initialize();
    function doNothing() {}
  </script>
</html>