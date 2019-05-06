<?php

get_header();

while (have_posts()) {
  the_post(); ?>

  <section class="intro">
    <div class="outer-container">
      <div class="flex flex-40-60">
        <div class="content">
          <h1 class="text-center">Cider Finder</h1>
          <form>
              <input id="zip" name="zip" type="text" pattern="[0-9]*">
              <select id="brand" name="brand">
                <option value="draft">Draft</option>
                <option value="br pear">Pear</option>
                <option value="br apple">BR Apple</option>
                <option value="br india pressed apple">IPA</option>
                <option value="br premium dry">Premium Dry</option>
                <option value="br rose">Rose</option>
              </select>
            </form>
          <div class="container">
              <button type="button" class="btn btn-primary center-block" onclick="getResults('22904', 'draft')">Get Locations</button>
              <div id="locationResults"></div>
            </div>
        </div>
        <div class="map-wrap">
          <div id="map" style="height: 600px"></div>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">
  var locationResults = document.querySelector('#locationResults');
  var mapArea = document.getElementById('map');
  var infowindow = new google.maps.InfoWindow({})
  var styledMapType = new google.maps.StyledMapType(
	[{
		"elementType": "geometry",
		"stylers": [{
			"color": "#1d2c4d"
		}]
	}, {
		"elementType": "labels.text.fill",
		"stylers": [{
			"color": "#8ec3b9"
		}]
	}, {
		"elementType": "labels.text.stroke",
		"stylers": [{
			"color": "#1a3646"
		}]
	}, {
		"featureType": "administrative.country",
		"elementType": "geometry.stroke",
		"stylers": [{
			"color": "#4b6878"
		}]
	}, {
		"featureType": "administrative.land_parcel",
		"elementType": "labels.text.fill",
		"stylers": [{
			"color": "#64779e"
		}]
	}, {
		"featureType": "administrative.province",
		"elementType": "geometry.stroke",
		"stylers": [{
			"color": "#4b6878"
		}]
	}, {
		"featureType": "landscape.man_made",
		"elementType": "geometry.stroke",
		"stylers": [{
			"color": "#334e87"
		}]
	}, {
		"featureType": "landscape.natural",
		"elementType": "geometry",
		"stylers": [{
			"color": "#023e58"
		}]
	}, {
		"featureType": "poi",
		"elementType": "geometry",
		"stylers": [{
			"color": "#283d6a"
		}]
	}, {
		"featureType": "poi",
		"elementType": "labels.text.fill",
		"stylers": [{
			"color": "#6f9ba5"
		}]
	}, {
		"featureType": "poi",
		"elementType": "labels.text.stroke",
		"stylers": [{
			"color": "#1d2c4d"
		}]
	}, {
		"featureType": "poi.business",
		"stylers": [{
			"visibility": "off"
		}]
	}, {
		"featureType": "poi.park",
		"elementType": "geometry.fill",
		"stylers": [{
			"color": "#023e58"
		}]
	}, {
		"featureType": "poi.park",
		"elementType": "labels.text",
		"stylers": [{
			"visibility": "off"
		}]
	}, {
		"featureType": "poi.park",
		"elementType": "labels.text.fill",
		"stylers": [{
			"color": "#3C7680"
		}]
	}, {
		"featureType": "road",
		"elementType": "geometry",
		"stylers": [{
			"color": "#304a7d"
		}]
	}, {
		"featureType": "road",
		"elementType": "labels.text.fill",
		"stylers": [{
			"color": "#98a5be"
		}]
	}, {
		"featureType": "road",
		"elementType": "labels.text.stroke",
		"stylers": [{
			"color": "#1d2c4d"
		}]
	}, {
		"featureType": "road.highway",
		"elementType": "geometry",
		"stylers": [{
			"color": "#2c6675"
		}]
	}, {
		"featureType": "road.highway",
		"elementType": "geometry.stroke",
		"stylers": [{
			"color": "#255763"
		}]
	}, {
		"featureType": "road.highway",
		"elementType": "labels.text.fill",
		"stylers": [{
			"color": "#b0d5ce"
		}]
	}, {
		"featureType": "road.highway",
		"elementType": "labels.text.stroke",
		"stylers": [{
			"color": "#023e58"
		}]
	}, {
		"featureType": "transit",
		"elementType": "labels.text.fill",
		"stylers": [{
			"color": "#98a5be"
		}]
	}, {
		"featureType": "transit",
		"elementType": "labels.text.stroke",
		"stylers": [{
			"color": "#1d2c4d"
		}]
	}, {
		"featureType": "transit.line",
		"elementType": "geometry.fill",
		"stylers": [{
			"color": "#283d6a"
		}]
	}, {
		"featureType": "transit.station",
		"elementType": "geometry",
		"stylers": [{
			"color": "#3a4762"
		}]
	}, {
		"featureType": "water",
		"elementType": "geometry",
		"stylers": [{
			"color": "#0e1626"
		}]
	}, {
		"featureType": "water",
		"elementType": "labels.text.fill",
		"stylers": [{
			"color": "#4e6d70"
		}]
	}], {
		name: 'Styled Map'
	});
  getLocation = () => {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(displayLocation)
	} else {
		console.log('problem');
	}
}
// displayLocation
displayLocation = (position) => {
	const lat = position.coords.latitude;
	const lng = position.coords.longitude;
	const latlng = {
		lat,
		lng
	}
	showMap(latlng, lat, lng);
	createMarker(latlng);
	mapArea.style.display = "block";
}
showMap = (latlng, lat, lng) => {
	let mapOptions = {
		center: latlng,
		zoom: 17
	};
	Gmap = new google.maps.Map(mapArea, mapOptions);
  //Associate the styled map with the MapTypeId and set it to display.
	Gmap.mapTypes.set('styled_map', styledMapType);
	Gmap.setMapTypeId('styled_map');
}

// Creates marker on the screen
createMarker = (latlng) => {
	let markerOptions = {
		position: latlng,
		map: Gmap,
		clickable: true
		// draggable: true
	};
	Gmarker = new google.maps.Marker(markerOptions);
}

getLocation();
  function buildQuery() {
    var selected = document.querySelector('select[name="brand"]');
    console.log(selected.value);
  }
  function getResults(zip, brand){
    var b = document.querySelector('#brand');
    var z = document.querySelector('#zip');

      var zip_p = 'zip=' + z.value;
      var brand_p = 'brand=' + b.value;
      var paramString = zip_p + '&' + brand_p;
      console.log(paramString);
      var xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = function() {
          if (xhttp.readyState==4 && xhttp.status==200) {
              var response = JSON.parse(xhttp.responseText);
              var results = response.locations.location;
              displayList(results);
          }
      };
      xhttp.open('get', 'http://localhost:3000/ciderFinder/index.php?' + paramString, true);

      xhttp.send();
  }

  function toTitleCase(str) {
      return str.replace(/\w\S*/g, function(txt){
          return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
      });
  }
  function displayList(locations) {
    var output = '';
    var returnedLocs = {
      "type": "FeatureCollection",
      "features" : []
    };

    locations.forEach(function(location) {
      let name = toTitleCase(location.dba);
      let phone = location.phoneFormatted;
      let street = toTitleCase(location.street);
      let city = toTitleCase(location.city);
      let zip = location.zip;
      let state = toTitleCase(location.state);
      let distance = toTitleCase(location.distance);
      let lat = location.lat;
      let long = location.long;
      let address = street + '<br>' + city + ',' + state + zip;
      let mapLink = 'https://www.google.com/maps/search/?api=1&query=' + encodeURI(street + ' ' + city + ' ' + state + ' ' + zip);

      output += '<div class="location"><h5>' + name +  '<span> (' + distance + 'miles away)</span></h5><p>' + street + '<br/>' + city + ', ' + state + zip + '</p></div>';
      locationResults.innerHTML = output;
      var info = "<strong>" + name + "</strong><br>" + address + "<br><a href='" + mapLink  + "' target='_blank'>Get Directions</a>";
      var feature = {
        "type": "Feature",
        "geometry" : {}
      };
      var geometry = {
        "type": "Point",
        "coordinates": []
      }
      var properties = {};
      geometry.coordinates.push(Number(lat));
      geometry.coordinates.push(Number(long));
      properties['name'] = name;
      feature['geometry'] = geometry;
      feature['info'] = info;
      feature['properties'] = properties;
      returnedLocs.features.push(feature);
    });
    //pass returnedLocs into buildMap
    buildMap(returnedLocs);


  }
  function buildMap(locs) {

	for (var i = 0; i < locs.features.length; i++) {
		var coords = locs.features[i].geometry.coordinates;

		var latLng = new google.maps.LatLng(coords[0], coords[1]);
		var marker = new google.maps.Marker({
			position: latLng,
			map: Gmap,
      title: 'Hello World!'
		});
    google.maps.event.addListener(
    marker,
    'click',
    (function(marker, i) {
      return function() {
        infowindow.setContent(locs.features[i].info)
        infowindow.open(map, marker)
      }
    })(marker, i)
  )
	}

    console.log(locs);
  }
  function buildGeo(location) {

  }
  </script>
<?php }

get_footer();
