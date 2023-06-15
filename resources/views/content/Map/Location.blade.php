<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Ace Capital</title>
    <script
      type="text/javascript"
      src="http://maps.google.com/maps/api/js?sensor=false"
    ></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>
  </head>
  <body style="font-family: Arial; font-size: 12px">
    <input id="location1" type="hidden"  value="<?php if(isset($_GET['l1'])) echo $_GET['l1']; ?>" />
    <input id="location2" type="hidden"  value="<?php if(isset($_GET['l2'])) echo $_GET['l2']; ?>" />
    <div id="map" style="width: 100%; height: 95vh; float: left"></div>
    <script type="text/javascript">
      var directionsService = new google.maps.DirectionsService();
      var directionsDisplay = new google.maps.DirectionsRenderer();

      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
      });

      directionsDisplay.setMap(map);
      // directionsDisplay.setPanel(document.getElementById("panel"));

      var request = {
        origin: document.getElementById('location1').value,
        destination: document.getElementById('location2').value,
        travelMode: google.maps.DirectionsTravelMode.DRIVING,
      };

      directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
        }
      });
    </script>
  </body>
</html>
