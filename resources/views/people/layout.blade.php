<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Form</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap-formhelpers.min.css') }}" rel="stylesheet" media="screen">
    <style>
        #map {
            height: 450px;
            width: 100%;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


</head>
<body>

<script src="https://apis.google.com/js/platform.js" async defer>
    {lang: 'ru'}
</script>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

    @yield('content')

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script src="{{ asset('js/app.js') }}" type="text/js"></script>
<script src="{{ asset('js/bootstrap-formhelpers.min.js') }}"></script>

    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            var uluru = {lat: 34.101260, lng: -118.343684};

            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 18, center: uluru});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: uluru, map: map});
        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3Z4PwEfac1lPKLHBplcZmp4BxYR0XUCA&callback=initMap">
    </script>

</body>
</html>