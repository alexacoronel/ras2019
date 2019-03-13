console.log('hello')

var bounds = null;


var map_86d9083653e54d94a0eda84aacfeb26e = L.map(
    'map_86d9083653e54d94a0eda84aacfeb26e', {
    center: [14.6395, 121.0781],
    zoom: 16,
    maxBounds: bounds,
    layers: [],
    worldCopyJump: false,
    crs: L.CRS.EPSG3857,
    zoomControl: true,
    });



var tile_layer_64cbb1e8b856494ca679ad62adc722e7 = L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
    "attribution": null,
    "detectRetina": false,
    "maxNativeZoom": 18,
    "maxZoom": 18,
    "minZoom": 0,
    "noWrap": false,
    "opacity": 1,
    "subdomains": "abc",
    "tms": false
}).addTo(map_86d9083653e54d94a0eda84aacfeb26e);

    var marker_d1d6c9d48cc9473c8b15e199e84c2622 = L.marker(
        [14.6395, 121.0781],
        {
            icon: new L.Icon.Default()
            }
        ).addTo(map_86d9083653e54d94a0eda84aacfeb26e);


        var popup_ecc3247df1aa46a0b1869607e8488c7b = L.popup({maxWidth: '300'

        });


            var html_ad85b31cac444ceea2cab1d66f795406 = $(`<div id="html_ad85b31cac444ceea2cab1d66f795406" style="width: 100.0%; height: 100.0%;"><strong>Location One</strong></div>`)[0];
            popup_ecc3247df1aa46a0b1869607e8488c7b.setContent(html_ad85b31cac444ceea2cab1d66f795406);


        marker_d1d6c9d48cc9473c8b15e199e84c2622.bindPopup(popup_ecc3247df1aa46a0b1869607e8488c7b)
        ;




    marker_d1d6c9d48cc9473c8b15e199e84c2622.bindTooltip(
        `<div>`
        + `Click For More Info` + `</div>`,
        {"sticky": true}
    );


        var circle_marker_ca5ba4e2cc0345ab8c2f896e3e9ead79 = L.circleMarker(
            [14.6395, 121.0781],
            {
"bubblingMouseEvents": true,
"color": "#428bca",
"dashArray": null,
"dashOffset": null,
"fill": true,
"fillColor": "#428bca",
"fillOpacity": 0.2,
"fillRule": "evenodd",
"lineCap": "round",
"lineJoin": "round",
"opacity": 1.0,
"radius": 50,
"stroke": true,
"weight": 3
}
            )
            .addTo(map_86d9083653e54d94a0eda84aacfeb26e);


        var popup_f995ceec288647d5b7ca472b1149ad62 = L.popup({maxWidth: '300'

        });


            var html_f9150e3bd52e42b3bcb55180c5db72cc = $(`<div id="html_f9150e3bd52e42b3bcb55180c5db72cc" style="width: 100.0%; height: 100.0%;">Ateneo</div>`)[0];
            popup_f995ceec288647d5b7ca472b1149ad62.setContent(html_f9150e3bd52e42b3bcb55180c5db72cc);


        circle_marker_ca5ba4e2cc0345ab8c2f896e3e9ead79.bindPopup(popup_f995ceec288647d5b7ca472b1149ad62)
        ;
