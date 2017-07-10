@extends('layouts.app')

@section('content')
   @if (Auth::guest())
     <h1>Please <a href="{{ route('login') }}">Login</a></h1>
   @else
    <h3>KS Well Product Demo</h3>
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
          zoom: 7,
          center: {lat:{{ $well->lat }}, lng: {{ $well->lon }} }
        });

        addMarker(map, {lat:{{ $well->lat}}, lng: {{ $well->lon}} });
      }
    </script>
    <table>
      <tr>
        <td>ID</td>
        <td>{{ $well->id }}</td>
      <tr>
      <tr>
        <td>Lat</td>
        <td>{{ $well->lat }}<td>
      </tr>
      <tr>
        <td>Lon</td>
        <td>{{ $well->lon }}</td>
      </tr>
      <tr>
        <td>Location</td>
        <td>{{ $well->location }}</td>
      </tr>
      <tr>
        <td>Operator</td>
        <td>{{ $well->operator }}</td>
      </tr>
      <tr>
        <td>Lease</td>
        <td>Kirkbride 'B' 1</td>
      </tr>
      <tr>
        <td>api</td>
        <td>{{ $well->api }}</td>
      </tr>
      <tr>
        <td>Elevation</td>
        <td>{{ $well->elevation }}</td>
      </tr>
      <tr>
        <td>Elevation Reference</td>
        <td>{{ $well->elevation_ref }}</td>
      </tr>
      <tr>
        <td>Depth Start</td>
        <td>{{ $well->depth_start }}</td>
      </tr>
      <tr>
        <td>Depth Stop</td>
        <td>{{ $well->depth_stop }}</td>
      </tr>
      <tr>
        <td>Data URL</td>
        <td><a href="{{ $well->url }}">{{ $well->url }}</a></td>
      </tr>
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