<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link type="image" href="/open-ai-logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" >
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Scripts -->
    
</head>
<body>
    <div id="app">
    <div id="preloaders" class="preloader">
        <img src='/spinner.png'>
    </div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img style='width:70px;' src='/open-ai-logo.png'>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <!-- <a class="dropdown-item" href="{{ route('add-business-details') }}">Business Details</a>    -->
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOIfEfDtYJRmL9ALc-bcfJPukqy_8OCwQ&callback=initAutocomplete&libraries=places"
      defer
    ></script>
<!-- <script type='text/javascript'>
    google.maps.event.addDomListener(window, 'load', initialize);
   
    function initialize(){     
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed',function(){
            var place = autocomplete.getPlace();
            $('#website').val(place.website);
            $('#phone').val(place.formatted_phone_number);
            const openingHours = place.opening_hours;
                if (openingHours) {
                // Call a function to format and display opening hours
                displayAllOpeningHours(openingHours);
                }
            // $('#working_hours').val(place.opening_hours.periods.open.day);
            $('#address').val(place.formatted_address);
        });
    }
    function displayAllOpeningHours(openingHours) {
  const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

  const openingHoursContainer = document.getElementById('opening-hours');

  for (let day = 0; day < daysOfWeek.length; day++) {
    const dayOpening = openingHours.periods[day];
    const dayText = daysOfWeek[day];

    if (!dayOpening) {
      const listItem = document.createElement('li');
      listItem.textContent = `${dayText}: Closed`;
      openingHoursContainer.appendChild(listItem);
    } else {
      const openTime = dayOpening.open.time.slice(0, 2) + ':' + dayOpening.open.time.slice(2);
      const closeTime = dayOpening.close.time.slice(0, 2) + ':' + dayOpening.close.time.slice(2);

      const listItem = document.createElement('li');
      listItem.textContent = `${dayText}: ${openTime} - ${closeTime}`;
      openingHoursContainer.appendChild(listItem);
    }
  }
}




</script> -->

<script>

$(window).load(function() 
{   
        setTimeout(() => {
        $("#preloaders").fadeOut();
        $('main').fadeIn();
    }, 1500);  
    
   });

</script>

    
</html>
