@extends('layouts.WMS')
@section('content')
<style>
.center {
  margin: auto;
  position: relative;
  text-align: center;
  top: 50%;
  width: 20%;
}
.custom-popup .leaflet-popup-content-wrapper{
  font-size:16px;
  line-height:24px;
}

.legend {
    line-height: 18px;
    color: #555;
    background: white;
    padding: 7px;
    font-size:18px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
}
.legend i {
    width: 18px;
    height: 18px;
    float: left;
    margin-right: 8px;
    opacity: 0.7;
}
.my-label {
    position: absolute;
    width:1000px;
    font-size:20px;
}

</style>

  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{route('wms.summary')}}">Weather Monitoring</a>
    </li>
    <li class="breadcrumb-item active">Maps</li>
    <li class="breadcrumb-item active">Sensor Location</li>
  </ol>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
    integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
    crossorigin=""/>

  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
    integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
    crossorigin=""></script>

  <div class='custom-popup' id="mapid"></div>

     <style>
        #mapid { height: 700px;}
     </style>

     <script >
     var water_level_data = <?php echo $water_level_dataFinal; ?>;
     var rain_rate_data  = <?php echo $rain_rate_dataFinal; ?>;
     var sensor  = <?php echo $rain_rate_dataFinal; ?>;
     var lastDate = <?php echo $lastDate; ?>;


     var mymap = L.map('mapid', {trackResize: false}).setView([14.6395, 121.0781], 18);

     L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
         attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
         maxZoom: 20,
         id: 'mapbox.streets',
         accessToken: 'pk.eyJ1IjoicmFzc2VydmVyIiwiYSI6ImNqc28xOGlkMDBpNDQ0NHBtZTJyNnoxcHAifQ.b1kNLAfH-ObjVUUJkrfzug'}).addTo(mymap);

    var circleColor;
    var circleFill;
    if (water_level_data > 0){
      if(water_level_data > 0 && water_level_data < 6){
        circleColor = '#2295C5'
        circleFill = '#2295C5'
      }
      if(water_level_data >= 6 && water_level_data <12 ){
        circleColor = '#95BC9C'
        circleFill = '#95BC9C'
      }
      else if(water_level_data >= 12 && water_level_data < 18){
        circleColor = '#E8EE70'
        circleFill = '#E8EE70'
      }
      else if(water_level_data >= 18 && water_level_data < 36){
        circleColor = '#FCB043'
        circleFill = '#FCB043'
      }
      else if(water_level_data >= 36){
        circleColor = '#E70D0E'
        circleFill = '#E70D0E'
      }

      var circle = L.circle([14.6395, 121.0781],{
        color: circleColor,
        fillColor: circleFill,
        fillOpacity: 0.5,
        radius:100
      }).addTo(mymap);
    }

    var customPopup = "<b>Water Level: </b>" + water_level_data + " in" +  "<br><br><b>RAS Decibel:</b> 34 dB</br>" + "<b>Rain Rate:</b> 2 mm/hr" +  "<br><b>Rain Intensity:</b> Light</br>" + "<br>Last updated at " + lastDate;
    var customOptions = {
      'maxWidth': '400',
      'width' : '200',
    }
    var marker = L.marker([14.6395, 121.0781]).addTo(mymap);
    marker.bindPopup(customPopup, customOptions).openPopup();


    function getColor(d) {
        return d > 46 ? '#E70D0E' :
               d > 37  ? '#FCB043' :
               d > 19  ? '#E8EE70' :
               d > 10   ? '#95BC9C' :
               d > 8   ? '#2295C5' :
                          '#FFEDA0';
    }


    var legend = L.control({position: 'bottomright'});
    legend.onAdd = function (mymap) {
        var div = L.DomUtil.create('div', 'info legend'),
        grades = [8, 10, 19, 37, 46],
        labels = ["Low", "Medium", "High", "Very High", "Extremely High"];

        // loop through our density intervals and generate a label with a colored square for each interval
        for (var i = 0; i < grades.length; i++) {
       div.innerHTML +=
           '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
           labels[i] + '<br>';
   }
         return div;
    };

    legend.addTo(mymap);


     </script>


@endsection
