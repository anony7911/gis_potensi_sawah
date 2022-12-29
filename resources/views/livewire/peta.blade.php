<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Peta Potensi') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- map1 --}}
                                <div id="map" style="width: 1050px; height: 600px;" wire:ignore></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts1')
    <script>
        // document.addEventListener('livewire:load', () => {
            // maps leaflet
            var map = L.map('map').setView([-4.18, 121.8931], 13);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/">2022</a>',
                maxZoom: 23,
                id: 'mapbox/satellite-streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiYW5vbnk3OTExIiwiYSI6ImNsYTZiYWwybzE2d2YzcnFxaWdvNGdsbHMifQ.LtkD7CYPKYyAmyXG6tqNbA'
            }).addTo(map);

            // random color
            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
            // view maps polygon existing json.stringify
            var petas = {!! json_encode($petas -> toArray()) !!};
            petas.forEach(function(item) {
                var cords = JSON.parse(item['batas_lahan']);
                // get coordinates from geometry on cords
                var coordinates = cords.geometry.coordinates[0];
                for (var i = 0; i < coordinates.length; i++) {
                    coordinates[i].reverse();
                }
                // create polygon jika zoom diatas 15
                var polygon = L.polygon(coordinates, {
                    color: 'getRandomColor()',
                    // random color
                    fillColor: getRandomColor()
                    , fillOpacity: 0.8
                }).addTo(map);

                // random marker color
                // jadikan marker jika zoom dibawah 15
                if (map.getZoom() < 15) {
                    // marker with ramdom color from getRandomColor()
                    var marker = L.marker(coordinates[0], {
                        icon: L.divIcon({
                            className: 'my-custom-pin'
                            , iconAnchor: [0, 24]
                            , labelAnchor: [-6, 0]
                            , popupAnchor: [0, -36]
                            , html: '<span class="fa-stack fa-2x">' +
                                '<i class="fa fa-circle fa-stack-2x" style="color:' + getRandomColor() + '"></i>' +
                                '<i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>' +
                                '</span>'
                        })
                    }).addTo(map);
                }
                // popup livewire click
                polygon.bindPopup(
                    '<b>ID</b> : ' + item['id'] + '<br>' +
                    "<b>Desa : </b>" + item['nama_desa'] + "<br>" +
                    "<b>Pemilik petas : </b>" + item['nama_pemiliklahan'] + "<br>" +
                    "<b>Jenis Tanah : </b>" + item['jenis_tanah'] + "<br>" +
                    "<b>Ketinggian : </b>" + item['ketinggian'] + " mdpl" + "<br>" +
                    "<b>Kelembaban : </b>" + item['kelembaban'] + "%<br>" +
                    "<b>Luas petas : </b>" + item['luas_lahan'] + " m<sup>2</sup>" + "<br>"
                    );
            });

            map.pm.addControls({
                position: 'topleft',
                drawCircle: false,
                drawMarker: false,
                drawPolyline: false,
                drawRectangle: false,
                drawCircleMarker: false,
                drawPolygon: true,
                cutPolygon: false,
                editMode: true,
                dragMode: false,
                removalMode: true,
            });

            map.on('pm:create', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
            });
            // end maps leaflet geoman draw

            // end tampilkan data dari database
            // maps leaflet geoman edit
            map.on('pm:edit', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
            });
            // end maps leaflet geoman edit

            // maps leaflet geoman delete
            map.on('pm:remove', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
            });
            // end maps leaflet geoman delete

            // maps leaflet geoman draw polygon
            map.on('pm:drawstart', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
            });
            // end maps leaflet geoman draw polygon

            // maps leaflet geoman edit polygon
            map.on('pm:editstart', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
            });
            // end maps leaflet geoman edit polygon

            // maps leaflet geoman delete polygon
            map.on('pm:deletestart', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
            });


        // });

    </script>

    @endpush
</div>
