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
</style>

  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{route('wms.summary')}}">Weather Monitoring</a>
    </li>
    <li class="breadcrumb-item active">Map</li>
    <li class="breadcrumb-item active">Interpolation</li>
  </ol>

<!DOCTYPE html>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
  integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
  crossorigin=""/>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
  integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
  crossorigin=""></script>

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link href="{{asset('qgis/css/leaflet.css')}}" rel="stylesheet">
        <link href="{{asset('qgis/css/qgis2web.css')}}" rel="stylesheet">
        <style>
        html, body, #map {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }
        </style>

    </head>
    <body>

      <div id="map"></div>

      <style>
         #map { height: 700px;}
      </style>

        <script src="{{asset('qgis/js/leaflet.js')}}"></script>
        <script src="{{asset('qgis/js/L.Control.Locate.min.js')}}"></script>
        <script src="{{asset('qgis/js/leaflet.rotatedMarker.js')}}"></script>
        <script src="{{asset('qgis/js/leaflet.pattern.js')}}"></script>
        <script src="{{asset('qgis/js/leaflet-hash.js')}}"></script>
        <script src="{{asset('qgis/js/Autolinker.min.js')}}"></script>
        <script src="{{asset('qgis/js/rbush.min.js')}}"></script>
        <script src="{{asset('qgis/js/labelgun.min.js')}}"></script>
        <script src="{{asset('qgis/js/labels.js')}}"></script>
        <script src="{{asset('qgis/data/SensorLocations_2.js')}}"></script>

        <script>

        var highlightLayer;
        function highlightFeature(e) {
            highlightLayer = e.target;

            if (e.target.feature.geometry.type === 'LineString') {
              highlightLayer.setStyle({
                color: '#ffff00',
              });
            } else {
              highlightLayer.setStyle({
                fillColor: '#ffff00',
                fillOpacity: 1
              });
            }
            highlightLayer.openPopup();
        }

        var map = L.map('map', {
            zoomControl:true, maxZoom:28, minZoom:1
        })

        var hash = new L.Hash(map);
        map.attributionControl.addAttribution('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a>');
        var bounds_group = new L.featureGroup([]);
        function setBounds() {
            if (bounds_group.getLayers().length) {
                map.fitBounds(bounds_group.getBounds());
            }
        }
        var overlay_BaseMap_0 = L.tileLayer('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            opacity: 1.0
        });

        overlay_BaseMap_0.addTo(map);
        map.addLayer(overlay_BaseMap_0);

        var img_Interpolated_1 = '{{asset('qgis/data/Interpolated_1.png')}}';
        var img_bounds_Interpolated_1 = [[14.61630533218357,121.0557908949245],[14.65736933791556,121.10943378672572]];
        var overlay_Interpolated_1 = new L.imageOverlay(img_Interpolated_1, img_bounds_Interpolated_1);

        bounds_group.addLayer(overlay_Interpolated_1);
        map.addLayer(overlay_Interpolated_1);

        function  pop_SensorLocations_2(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    for (i in e.target._eventParents) {
                        e.target._eventParents[i].resetStyle(e.target);
                    }
                    if (typeof layer.closePopup == 'function') {
                        layer.closePopup();
                    } else {
                        layer.eachLayer(function(feature){
                            feature.closePopup()
                        });
                    }
                },
                mouseover: highlightFeature,
            });

            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">Sensor</th>\
                        <td>' + (feature.properties['Sensor'] !== null ? Autolinker.link(String(feature.properties['Sensor'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Latitude</th>\
                        <td>' + (feature.properties['Latitude'] !== null ? Autolinker.link(String(feature.properties['Latitude'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Longitude</th>\
                        <td>' + (feature.properties['Longitude'] !== null ? Autolinker.link(String(feature.properties['Longitude'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Rain Rate</th>\
                        <td>' + (feature.properties['Rain Rate'] !== null ? Autolinker.link(String(feature.properties['Rain Rate'])) : '') + " mm/hr" + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_SensorLocations_2_0() {
            return {
                pane: 'pane_SensorLocations_2',
                radius: 4.0,
                opacity: 1,
                color: 'rgba(35,35,35,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1,
                fill: true,
                fillOpacity: 1,
                fillColor: 'rgba(225,89,137,1.0)',
            }
        }

        map.createPane('pane_SensorLocations_2');
        map.getPane('pane_SensorLocations_2').style.zIndex = 402;
        map.getPane('pane_SensorLocations_2').style['mix-blend-mode'] = 'normal';
        var layer_SensorLocations_2 = new L.geoJson(json_SensorLocations_2, {
            attribution: '',
            pane: 'pane_SensorLocations_2',
            onEachFeature: pop_SensorLocations_2,
            pointToLayer: function (feature, latlng) {
                var context = {
                    feature: feature,
                    variables: {}
                };
                return L.circleMarker(latlng, style_SensorLocations_2_0(feature));
            },
        });
        bounds_group.addLayer(layer_SensorLocations_2);
        map.addLayer(layer_SensorLocations_2);


        var baseMaps = {};
        L.control.layers(baseMaps,{'<img src="{{asset('qgis/legend/SensorLocations_2.png')}}" /> Sensor Locations': layer_SensorLocations_2,"Interpolated": overlay_Interpolated_1,"Base Map": overlay_BaseMap_0,}).addTo(map);
        setBounds();
        L.ImageOverlay.include({
            getBounds: function () {
                return this._bounds;
            }
        });
        </script>

</body>

@endsection
