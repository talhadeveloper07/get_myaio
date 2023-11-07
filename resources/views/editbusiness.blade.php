@extends('layouts.app')

@section('content')
<div class='container-fluid main-sec bg-white'>
      <div class='row d-flex align-items-center'>
      <div class="col-md-6 p-0 py-4">
        <div class="form-col">
          <h2 class="text-center mt-3" style='font-weight:bold;'>Update Business Information</h2>  
          <p style='font-size:14px;' class='pb-3 text-center'>Search your business on google map and fill the form below.</p>
          @if (Session::has('error'))
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        {{ Session::get('error') }}
                        </div>
                        @endif
        @foreach($data as $info)
          <input id="search" class="form-control" type="text" placeholder="Search Your Business Here"/> 
           <form method='post' action="{{ route('edit-radius')}}">
           @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group my-3">
                        <input type="text" class="form-control" id="bname" value='{{$info->bname}}' name='bname' placeholder="Enter Business Name">
                      </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group my-3">
                        <input type="email" class="form-control" id="bemail" value='{{$info->bemail}}' name='bemail' placeholder="Enter Business Email" required>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">   
                        <input type="text" class="form-control" id="bphone" value='{{$info->bphone}}'  name='bphone' placeholder="Enter Business Phone" required>
                          </div>
                      </div>
                       <div class="col-md-6">
                          <div class="form-group">   
                        <input name='website_url' id='website' value='{{$info->website_url}}'  class='form-control' placeholder='Enter website URL'>
                          </div>
                      </div>
                    </div>
                   
                    <div class="form-group my-3">    
                        <textarea name='baddress' id='baddress'  class='form-control' rows='2' placeholder='Enter Business Address'>{{$info->baddress}}</textarea>
                        <input type='hidden' name='radiusaddress' value='{{$info->radius_address}}'>
                        <input type='hidden' name='radius' value='{{$info->radius}}'>
                    </div>
                    <div class="form-group my-3">
                    <small style='font-weight:bold;'>Working Hours</small>  <span class="fa fa-plus add"></span>
                    <span>(Optional)</span>
                        <div class='appending_div'>
                            <!-- <div class='row'>
                        <div class='col-md-4'>
                            <input name='working_days[]' class='form-control' placeholder='Days'>
                        </div>
                        <div class='col-md-4'>
                            <input name='working_hours[]' class='form-control' placeholder='Hours'>
                        </div>
                        <div class='col-md-4'>
                            <button class='btn btn-danger btn-rounded btn-sm'><i class='fa fa-minus'></i></button>
                        </div>
                        </div> -->
                    </div>

                    </div>
                    <div class="form-group my-3">
                        
                        <textarea name='description' id='description'  class='form-control' placeholder='Enter Description'>{{$info->description}}
                        </textarea>
                    </div>
                    <div id='working-hours'>

                    </div>
                    <div class="form-group my-3">
                       <button type='submit' class='btn btn-success w-100'>Add Business Detail</button>
                    </div>       
                    </form>
                    @endforeach
        </div>
                
          
          </div> 
      <div class="col-md-6 p-0 map-col">
         <div id="map"></div>
          </div> 
      </div>
    </div>
</div>

<script>
        $(document).ready(function() {
            var i = 1;
            $('.add').on('click', function() {
                var field = '<div class="row my-3"><div class="col-md-4"><input name="working_days[]" class="form-control" placeholder="Days"></div><div class="col-md-4"><input name="working_hours[]" class="form-control" placeholder="Hours"></div><div class="col-md-4"><span class="del-option"><i class="fa fa-minus"></i></span></div></div>';
                $('.appending_div').append(field);
                i = i+1;
            })
            $('.appending_div').on('click', '.del-option', function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });
            })
          
    </script>
<script>


function initAutocomplete() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -33.8688, lng: 151.2195 },
    zoom: 14,
    // mapTypeId: "roadmap",
  });

  const input = document.getElementById("search");
  const searchBox = new google.maps.places.SearchBox(input);

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
         $('#bname').val(placeDetail.name);
          $('#website').val(placeDetail.website);
          $('#baddress').val(placeDetail.formatted_address);
          $('#bphone').val(placeDetail.formatted_phone_number);
        
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
          $('#bname').val(place.name);
          $('#website').val(place.website);
          $('#baddress').val(place.formatted_address);
          $('#bphone').val(place.formatted_phone_number);

          // Display working hours if available
          if (place.opening_hours && place.opening_hours.weekday_text) {
            const hoursList = place.opening_hours.weekday_text;
            let hoursHTML = '<ul class="m-0 p-0" style="list-style-type:none;">';
            hoursList.forEach((dayHours) => {
              hoursHTML += `<li>${dayHours}</li>`;
            });
            hoursHTML += '</ul>';
            $('.appending_div').html(hoursHTML);
          } else {
            $('.appending_div').html('<p>Working hours not available.</p>');
          }

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

    window.initAutocomplete = initAutocomplete;
    </script>


@endsection

