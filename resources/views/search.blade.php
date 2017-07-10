@extends('layouts.app')

@section('content')
   @if (Auth::guest())
     <h1>Please <a href="{{ route('login') }}">Login</a></h1>
   @else
    <h3>BUY DATA</h3>
    <div id="map" style="height:400px; width:600px;"></div>
    <script type="text/javascript">
      let markers = [];

      function addMarker(map, location) {
        markers.push(new google.maps.Marker({
          position: location,
          map: map
        }));
      }

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat:38.25, lng:-98.5}
        });

        @foreach ($wells as $well)
          addMarker(map, {lat: {{ $well->lat }}, lng: {{ $well->lon }} });
        @endforeach
      }
    </script>
    <table>
      <tr>
        <td>Latitude</td>
        <td>Longitude</td>
        <td>Operator</td>
        <td>More Details</td>
      </tr>
@foreach ($wells as $well)
  <tr>
    <td>{{ $well->lat }}</td>
    <td>{{ $well->lon }}</td>
    <td>{{ $well->operator }}</td>
    <td><a href="/well/{{ $well->id }}">More Details</a></td>
  </tr>
@endforeach
    </table>
    <script
      async
      defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEZ-fC2KEJZJt_FSGjTSA0zi4MQF6xrxI&callback=initMap">
    </script>
    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous">
    </script>
  @endif

@endsection