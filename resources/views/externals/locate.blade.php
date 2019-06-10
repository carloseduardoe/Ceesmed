@extends('externals')

@section('content')
  <main role="main">
    <div class="container">
      <div class="row justify-content-around">
        <div class="col-12 text-left text-sm-center">
          <h2 class="pb-2">Location Information</h2>
        </div>
        <div class="col-12 col-md-8 p-1 text-center align-content-center bg-secondary">
          <div id="map" class="w-100" style="height: 400px;"></div>
        </div>
        <div class="col-12 pt-sm-2 text-left text-sm-center">
          <p class="lead">
            <small>
              <address>Humberto Albornoz Oe8-181 y Atacames.<br>
                <i class="material-icons small">schedule</i> Lunes a Viernes de 18:30 a 20:00.<br>
                <i class="material-icons small">phone</i> <a href="tel:(02) 320-2828">(02) 320-2828</a>.
              </address>
            </small>
          </p>
        </div>
      </div>
    </div>
  </main>
@endsection

@section('javascript')
  <script type="text/javascript">
    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -0.1905916, lng: -78.5087032},
        zoom: 18,
        disableDefaultUI: true,
        zoomControl: true
      });

      var marker = new google.maps.Marker({
        animation: google.maps.Animation.DROP,
        draggable: false,
        position: map.center,
        map: map
      });
      marker.addListener('click', toggleBounce);

      function toggleBounce() {
        setTimeout(function() {
          marker.setAnimation(google.maps.Animation.BOUNCE);
          marker.setAnimation(null);
        }, 100);
      }
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_HvLNq2oxDGZLukMLLXLhHtll7nHeK2A&callback=initMap"></script>
@endsection
