<?php

get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post();
?>

<main>
  <?php
  if (has_post_thumbnail() ): ?>
  <div class="hero fh-400">
    <?php
      $id = get_post_thumbnail_id();
      $src1 = wp_get_attachment_image_src( $id, 'full' );
      $src = $src1[0];
      $srcset = wp_get_attachment_image_srcset( $id, 'full');
      $thumb = wp_get_attachment_image_src( $id, 'blur-thumb');
      $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
    ?>
    <div class="placeholder hero-wrapper" data-large="<?php echo $src; ?>">
      <img src="<?php echo $thumb[0]; ?>" class="img-small">

        <div class="hero-content">
        <?php the_content(); ?>



        </div>


    </div>
    <svg viewBox="0 0 3 1" class="aspect"><rect x="0" y="0" width="3" height="1" /></svg>

  </div>
  <?php endif; ?>
  <section class="search">
    <form class="search-form flex flex-wrap">

        <div class="marker-icon-btn" id="useLocation">Use Current Location?</div>
        <input id="zip" name="zip" type="text" pattern="[0-9]*" placeholder="Zip Code">

        <div class="custom-select">
          <select id="brand" name="brand">
            <option data-type="brand" value="apple, br apple">Apple</option>
            <option data-type="brand" value="draft, br draft">Draft</option>
            <option data-type="brand" value="br pear">Pear</option>
            <option data-type="brand" value="br india pressed apple">IPA</option>
            <option data-type="brand" value="br premium dry">Premium Dry</option>
            <option data-type="brand" value="br rose">Rose</option>
            <option data-type="category" value="ginger turmeric">Ginger Turmeric</option>
            <option data-type="brand" value="variety crate">Variety Crate</option>
          </select>
        </div>
        <div class="custom-select">
          <select id="distance" name="distance">
            <option value="5">5 miles</option>
            <option value="10">10 miles</option>
            <option value="15">15 miles</option>
            <option value="25">25 miles</option>
            <option value="50">50 miles</option>
          </select>
        </div>

        <div class="custom-select">
          <select id="storeType" name="storeType">
            <option value="">Any Vendor</option>
            <option value="23,26,28,32">Restaurant/Bar</option>
            <option value="01,02,05,08,09,10">Store</option>
          </select>
        </div>
        <input type="submit" class="cider_finder_button slideButton" value="Find Bold Rock" id="find" data-hover="Cider Finder"/>

      <div id="error"></div>
    </form>
  </section>

  <section class="finder np">

      <div class="flex flex-wrap">
        <div class="search-col">
          <div class="content">
            <h3>Results</h3>
            <div id="locationResults"></div>
            <div class="pagination">
              <button id="next">Next</button>
              <button id="previous">Prev</button>
            </div>
          </div>
        </div>
        <div class="map-col">
          <div id="map"></div>
        </div>
      </div>
  </section>

  <script>
    const mapArea = document.querySelector('#map');
    const actionBtn = document.querySelector('#useLocation');
    const locationResults = document.querySelector('#locationResults');
    const findBtn = document.querySelector('#find');
    const nextBtn = document.querySelector('#next');
    const prevBtn = document.querySelector('#previous');
    const resultsWrap = document.querySelector('.search-col');
    let Gmap;
    let searchParamString = '';
    let page = 0;
    let lat;
    let lng;
    let latlng;
    let image = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/674055/BR-Events.png";
    var geocoder = new google.maps.Geocoder;
    var infowindow = new google.maps.InfoWindow({});
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

    function initMap() {
      var cville = {lat: 38.0310524, lng: -78.474159};
      let mapOptions = {
    	  center: cville,
    	  zoom: 17
      };
      // The map, centered at Uluru
      Gmap = new google.maps.Map(mapArea, mapOptions);
      //Associate the styled map with the MapTypeId and set it to display.
    	Gmap.mapTypes.set('styled_map', styledMapType);
    	Gmap.setMapTypeId('styled_map');
    };
    initMap();

    getLocation = () => {

    	if (navigator.geolocation) {
    		navigator.geolocation.getCurrentPosition(displayLocation)
    	} else {
    		console.log('problem');
    	}
    }
    // displayLocation
    displayLocation = (position) => {
      console.log(position);
    	lat = position.coords.latitude;
    	lng = position.coords.longitude;
    	latlng = {
    		lat,
    		lng
    	}

      fillZip(latlng);

    }

    fillZip = (ll) => {
      //using index won't work all the time because the
      //number of items is not consistent from location to locatiton
      //use nested type value instead OR last value
       geocoder.geocode({'location': ll}, function(results, status) {
         let addressArr = results[0];
         let address = addressArr.formatted_address;
         console.log(addressArr.address_components);
         let zipcode = addressArr.address_components[7].short_name;

         let zipTemp = document.querySelector('#zip');
         zipTemp.value = zipcode;
         console.log(zipTemp.value);
         actionBtn.classList.remove('loading-active');
         actionBtn.classList.add('location-complete');
       })
    }

    showMap = (latlng, lat, lng) => {
      //add some sort of scroll behavior
      //console.log('in showmap: ' + latlng);
    	let mapOptions = {
    		center: latlng,
    		zoom: 13
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


    toTitleCase = (str) => {
        return str.replace(/\w\S*/g, function(txt){
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    }
    callVals = () => {

      pageParamString = `&page=${page}`;
      params = searchParamString + pageParamString;

      var xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = function() {
        //add preloader start
          if (xhttp.readyState==4 && xhttp.status==200) {
              var response = JSON.parse(xhttp.responseText);

              var results = response.locations.location;

              handleResponses(results);

              //handle page limits
              (response.end == response.total) ? nextBtn.setAttribute('disabled', true) : nextBtn.removeAttribute('disabled');
              (response.start == 1) ? prevBtn.setAttribute('disabled', true) : prevBtn.removeAttribute('disabled');

          }
      };
      xhttp.open('get', 'http://localhost:3000/ciderFinder/index.php?' + params, true);

      xhttp.send();
    }
    getSelectedVals = () => {
      let zip, brand, distance, storeType;
      event.preventDefault();
      zip = document.querySelector('#zip');
      brand = document.querySelector('#brand');
      distance = document.querySelector('#distance');
      storeType = document.querySelector('#storeType');

      let selected = brand.options[brand.selectedIndex];
      let selected_d = selected.getAttribute('data-type');

      if(zip.value !== '') {
        searchParamString += `zip=${zip.value}&`;
      }

      if(lat !== undefined) {
        searchParamString += `lat=${lat}&lng=${lng}`;
      }

      if(brand.value !== undefined) {
        let brandType = (selected_d == 'brand') ? "brand" : "category2";
        searchParamString+= `&${brandType}=${brand.value}`;
      }

      if(distance.value !== '') {
        searchParamString += `&distance=${distance.value}`;
      }
      if(storeType.value !== '') {
        searchParamString += `&storeType=${storeType.value}`;
      }

      console.log(lat + ', ' + lng);
      console.log(searchParamString);
      ((lat == null) && (zip.value == '')) ? locationError() : callVals(searchParamString);

    }
    locationError = () => {
      let errorBox = document.querySelector('#error');
      errorBox.innerHTML = "<p>You must provide location input!</p>";
    }
    buildMap = (geoList) => {
      console.log(geoList);
      if (latlng == undefined) {
        let latlngs = geoList.features[0].geometry.coordinates;
        latlng = new google.maps.LatLng(latlngs[0], latlngs[1]);
        console.log('in buildmap: ' + latlng);
      }
      showMap(latlng, lat, lng);
      createMarker(latlng);

      for (var i = 0; i < geoList.features.length; i++) {
    		var coords = geoList.features[i].geometry.coordinates;

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
            infowindow.setContent(geoList.features[i].info)
            infowindow.open(map, marker)
          }
        })(marker, i)
      )
    	}
    }


    handleResponses = (locations) => {
      let output = '';
      let returnedLocs = {
        "type": "FeatureCollection",
        "features" : []
      };

      locations.forEach(function(location) {
        let name = toTitleCase(location.dba);
        let phone = location.phoneFormatted;
        let street = toTitleCase(location.street);
        let distance = toTitleCase(location.distance);
        let city = toTitleCase(location.city);
        let state = toTitleCase(location.state);
        let zip = location.zip;
        let lat = location.lat;
        let long = location.long;
        let address = street + '<br>' + city + ', ' + state + ' ' + zip;
        let mapLink = 'https://www.google.com/maps/search/?api=1&query=' + encodeURI(street + ' ' + city + ' ' + state + ' ' + zip);

        //Set up geo object
        let info = "<strong>" + name + "</strong><br>" + address + "<br><a href='" + mapLink  + "' target='_blank'>Get Directions</a>";
        let feature = {
          "type": "Feature",
          "geometry" : {}
        };
        let geometry = {
          "type": "Point",
          "coordinates": []
        }
        let properties = {};
        geometry.coordinates.push(Number(lat));
        geometry.coordinates.push(Number(long));
        properties['name'] = name;
        feature['geometry'] = geometry;
        feature['info'] = info;
        feature['properties'] = properties;
        returnedLocs.features.push(feature);

        output += '<div class="location"><h5>' + name +  '<span> (' + distance + 'miles away)</span></h5><p>' + address + '</p><a class="loc-map-link" target="_blank" href="' + mapLink + '">Find on Map</a></div>';
        locationResults.innerHTML = output;
      });
      buildMap(returnedLocs);

    }

    actionBtn.addEventListener('click', function() {
      event.preventDefault();
      actionBtn.classList.add('loading-active');
    	getLocation();
      console.log('clicked');
    });

    //Pagination
    findBtn.addEventListener('click', function(){
      event.preventDefault();
      searchParamString = '';
      resultsWrap.classList.add('results-revealed');
      getSelectedVals();

    });
    next.addEventListener('click', function() {
      page++;
      callVals()
    });
    previous.addEventListener('click', function() {
      page--;
      callVals()
    });

    var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
  </script>
  <?php
    }
  }
  ?>
  </main>
  <?php
  get_footer();
