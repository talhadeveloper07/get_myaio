@extends('layouts.app')

@section('content')
<div class='container-fluid main-sec bg-white'>
      <div class='row d-flex align-items-center'>
      <div class="col-md-6 p-0 py-4">
        <div class="form-col circle-form">
          <h2 class="text-center mt-3" style='font-weight:bold;'>Draw a circle - Create a circle on a google map using a point and a radius
</h2>  
          <p style='font-size:14px;' class='pb-3 text-center'>Search your business on google map and fill the form below.</p>
          <form method='post' action='{{ route("business-details-insert")}}'>
            
           @csrf
           
           <input name='client_id' id='client_id' value="{{Auth::User()->id}}" hidden>
          <div class='row'>
            <div class='col-md-8'>
            <label for='radius' style='font-weight:bold;'>Address</label>
          <input id="search" class="form-control" type="text" name='radius_address' placeholder="Add Your Business Address"/> 
            </div>
            <div class='col-md-4'>
            <div class="form-group">
                <label for='radius' style='font-weight:bold;'>Radius</label>
                <input type="text" class="form-control" id="radius" name='radius' placeholder="Enter Radius in miles">
            </div>
            </div>
            <div class='form-group'>
            <button type='button' class='btn btn-primary my-3 w-100' onclick="drawCircle()">Draw A Circle</button>
            </div>
          </div>
          <div>
          @foreach($name as $bname)
          <input class='form-control' name='bname' value="{{$bname}}" hidden>
          @endforeach
          @foreach($email as $bemail)
          <input class='form-control' name='bemail' value="{{$bemail}}" hidden>
          @endforeach
          @foreach($phone as $bphone)
          <input class='form-control' name='bphone' value="{{$bphone}}" hidden>
          @endforeach
          @foreach($address as $baddress)
          <input class='form-control' name='baddress' value="{{$baddress}}" hidden>
          @endforeach
          @foreach($description as $bdescription)
          <input class='form-control' name='description' value="{{$bdescription}}" hidden>
          @endforeach
          @foreach($website_url as $website)
          <input class='form-control' name='website_url' value="{{$website}}" hidden>
          @endforeach
          </div>

          <div class='self-fields'>
          <p>Are you processing the order yourself or one of our rep on the phone?</p>
            <input type="radio" id="self" name="self_closure" value="Self" onclick="toggleInputField(false)">
            <label for="self">Self</label><br>
            <input type="radio" id="closure" name="self_closure" value="" onclick="toggleInputField(true)">
            <label for="closure">Closure</label><br>

          <div class='form-group my-3'>
          <input class='form-control' id='closure_id' style='display:none;' placeholder='Enter Representative Employee ID' required>
          </div>
          
        </div>
          <button type='submit' style='display:none;' id='select-package-btn' class='btn btn-success w-100'>Select Package</button>
            </form>
        </div>
                
          
          </div> 
      <div class="col-md-6 p-0 map-col">
         <div id="map"></div>
          </div> 
      </div>
    </div>
</div>




<script>
   function toggleInputField(show) {
            var inputField = document.getElementById("closure_id");
            if (show) {
                inputField.style.display = "block";
            } else {
              // $('#closure_id').removeAttr('name');
                inputField.style.display = "none";
            }
        }
</script>


<script type="text/javascript">
    $('#closure_id').on('keyup',function(){
      if( this.value.length < 4 ) return;
      $('#select-package-btn').hide();
    $value=$(this).val();
    $('#closure').val($value);
    $.ajax({
    type : 'get',
    url : '{{URL::to('check-closure')}}',
    data:{'search':$value},
    success:function(response){
      if(response == 'closure found'){
        $('#select-package-btn').show();
      }else{
        $('#select-package-btn').hide();        
      }
      alert(response);
    }
    });
    })
</script>


<script>

let map;
 let circle;
 let placesService; // Initialize the PlacesService

function initAutocomplete() {
   map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -33.8688, lng: 151.2195 },
    zoom: 2,
    // mapTypeId: "roadmap",
  });
   
  const input = document.getElementById("search");
  const searchBox = new google.maps.places.SearchBox(input);
  placesService = new google.maps.places.PlacesService(map);

  map.controls[google.maps.ControlPosition.TOP_LEFT].push();
 
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });

  let markers = [];

  searchBox.addListener("places_changed", () => {
    let places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    const selectedPlace = places[0];

    // Clear out the old markers.
    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();

    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }

      const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      };

      const marker = new google.maps.Marker({
    map,
    title: place.name,
    position: place.geometry.location,
  });

  // Add a click event listener to the marker
  marker.addListener('click', () => {
    // Fetch place details to get website and other details
    const placeDetails = new google.maps.places.PlacesService(map);
    placeDetails.getDetails({ placeId: place.place_id }, (placeDetail, status) => {
      if (status === google.maps.places.PlacesServiceStatus.OK) {
        // Here you can access placeDetail to get details like name, website, opening hours, etc.
        // Update the HTML or display in an InfoWindow as needed
        const infoWindowContent = `
          <strong>${placeDetail.name}</strong>
          <p>${placeDetail.website || 'Not available'}</p>
          <p> ${placeDetail.formatted_address || 'Not available'}</p>
          <p> ${placeDetail.formatted_phone_number || 'Not available'}</p>
        `;
         $('#name').val(placeDetail.name);
          $('#website').val(placeDetail.website);
          $('#address').val(placeDetail.formatted_address);
          $('#phone').val(placeDetail.formatted_phone_number);
        
        const infoWindow = new google.maps.InfoWindow({
          content: infoWindowContent,
        });

        infoWindow.open(map, marker);
        setTimeout(() => {
            infoWindow.close();
        }, 3000);
      } else {
        console.log("Error fetching place details:", status);
      }
    });
  });

  markers.push(marker);


      // Create a marker for each place.
    //   markers.push(
    //     new google.maps.Marker({
    //       map,
    //       // icon,
    //       title: place.name,
    //       position: place.geometry.location,
    //     }),

    //   );
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }


    });

     // Fetch place details to get website
    const placeDetails = new google.maps.places.PlacesService(map);
    placeDetails.getDetails({ placeId: selectedPlace.place_id }, (place, status) => {
      if (status === google.maps.places.PlacesServiceStatus.OK) {
        if (place.name) {
          $('#name').val(place.name);
          $('#website').val(place.website);
          $('#address').val(place.formatted_address);
          $('#phone').val(place.formatted_phone_number);
        } else {
          console.log("Website not available for this place.");
        }
      } else {
        console.log("Error fetching place details:", status);
      }
    });


    map.fitBounds(bounds);
  });
}

// function drawCircle() {
//             if (circle) {
//                 circle.setMap(null);
//             }
//             const radiusInMiles = parseFloat(document.getElementById('radius').value);
//             const center = map.getCenter();
//             const radiusInMeters = radiusInMiles * 1609.34; // Convert miles to meters

//             circle = new google.maps.Circle({
//                 map: map,
//                 center: center,
//                 radius: radiusInMeters,
//                 draggable: true, // Make the circle draggable
//                 strokeColor: '#FF0000',
//                 strokeOpacity: 0.8,
//                 strokeWeight: 2,
//                 fillColor: '#FF0000',
//                 fillOpacity: 0.35
//             });
//             map.fitBounds(circle.getBounds());

//               // Add a listener to update the circle's position when dragged
//     circle.addListener('dragend', function () {
//         map.fitBounds(circle.getBounds());
//     });
//         }

function drawCircle() {
  if (circle) {
    circle.setMap(null);
  }
  const radiusInMiles = parseFloat(document.getElementById("radius").value);
  const center = map.getCenter();
  const radiusInMeters = radiusInMiles * 1609.34; // Convert miles to meters

  circle = new google.maps.Circle({
    map: map,
    center: center,
    radius: radiusInMeters,
    draggable: true,
    strokeColor: "#FF0000",
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: "#FF0000",
    fillOpacity: 0.35,
  });

  map.fitBounds(circle.getBounds());

  // Function to fetch places within the circle
  const fetchPlaces = (center, radiusInMeters, nextPageToken) => {
    const request = {
      location: center,
      radius: radiusInMeters,
      types: ["locality"], // Filter for cities
    };

    if (nextPageToken) {
      request.pageToken = nextPageToken;
    }

    placesService.nearbySearch(request, (results, status, pagination) => {
      if (status === google.maps.places.PlacesServiceStatus.OK) {
        // Process the results (e.g., display them on the map or in a list)
        console.log("Places within the circle:", results);

        // Check if there are more results to fetch
        if (pagination.hasNextPage) {
          // Fetch the next page of results
          pagination.nextPage();
        }
      }
    });
  };

  // Start fetching places
  fetchPlaces(center, radiusInMeters);
  
  // Add a listener to update the circle's position when dragged
  circle.addListener("dragend", function () {
    map.fitBounds(circle.getBounds());
    
    // Restart fetching places with the new circle position
    fetchPlaces(circle.getCenter(), radiusInMeters);
  });
}


 
 
        
    window.initAutocomplete = initAutocomplete;
    </script>

<script>
  $(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
</script>

@endsection

