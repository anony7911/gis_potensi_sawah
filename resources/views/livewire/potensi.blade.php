<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Potensi Sawah') }}</div>

                    <div class="card-body">
                        {{-- add button --}}
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" wire:click='tambah'>Tambah Data</button>
                            </div>
                        </div>
                        {{-- end add button --}}
                        <br>
                        {{-- perpage --}}
                        <div class="row">
                            <div class="col-md-6">
                                <select wire:model="perPage" class="form-control">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" wire:model="search" class="form-control" placeholder="Search">
                            </div>
                            <div class="col-md-12">
                                {{-- alert --}}
                                @if (session()->has('message'))
                                <div class="alert alert-success mt-3">
                                    {{ session('message') }}
                                </div>
                                @endif
                                {{-- end alert --}}
                            </div>
                        </div>

                        {{-- table --}}
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>desa</th>
                                            <th>nama pemilik</th>
                                            <th>luas lahan</th>
                                            <th>Batas lahan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($potensi as $potensi)
                                        <tr>
                                            <td>{{ $potensi->id }}</td>
                                            <td>{{ $potensi->nama_desa }}</td>
                                            <td>{{ $potensi->nama_pemiliklahan }}</td>
                                            <td>{{ $potensi->luas_lahan }}</td>
                                            <td>{{ $potensi->batas_lahan }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm mb-1" wire:click="potensiId({{ $potensi->id }})">Edit</button>
                                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $potensi->id }})">Delete</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if($isTambah || $isUpdate)
                            <div class="col-lg-12 col-md-12">
                                {{-- TEXTAREA batas --}}
                                <div class="form-group mt-2">
                                    <form wire:submit.prevent='store' id="set-data" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group  mt-2">
                                            <label for="desa">Desa</label>
                                            <select wire:model="desa_id" class="form-control">
                                                <option value="">Pilih Desa</option>
                                                @foreach ($desa as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_desa }}</option>
                                                @endforeach
                                            </select>
                                            @error('desa_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="pemiliklahan_id" class="form-label">Pemilik Lahan</label>
                                            <select wire:model="pemiliklahan_id" class="form-control">
                                                <option value="">Pilih Pemilik Lahan</option>
                                                @foreach ($pemiliklahan as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_pemiliklahan }}</option>
                                                @endforeach
                                            </select>
                                            @error('pemiliklahan_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- infotanah option --}}
                                        <div class="form-group mt-2">
                                            <label for="infotanah_id" class="form-label mt-2">Jenis Tanah</label>
                                            <select wire:model="infotanah_id" class="form-control">
                                                <option value="">Pilih Jenis Tanah</option>
                                                @foreach ($infotanah as $item)
                                                <option value="{{ $item->id }}">{{ $item->jenis_tanah }}</option>
                                                @endforeach
                                            </select>
                                            @error('infotanah_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-group mt-2">
                                            <label for="luaslahan">Luas Lahan</label>
                                            <input type="number" wire:model="luas_lahan" class="form-control" id="luaslahan">
                                            @error('luas_lahan') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <div id="map" style="width: 1050px; height: 400px;" wire:ignore></div>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="batas">Batas</label>
                                            <textarea class="form-control" id="get-data" rows="3" name="batas_lahan" wire:model="batas_lahan"></textarea>
                                        </div>
                                    <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                                    </form>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')

    <script>
        document.addEventListener('livewire:load', () => {
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
            var lahan = {!! json_encode($lahan->toArray()) !!};
            lahan.forEach(function (item) {
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
                    fillColor: getRandomColor(),
                    fillOpacity: 0.8
                }).addTo(map);

                // random marker color
                // jadikan marker jika zoom dibawah 15
                if (map.getZoom() < 15) {
                    // marker with ramdom color from getRandomColor()
                    var marker = L.marker(coordinates[0], {
                        icon: L.divIcon({
                            className: 'my-custom-pin',
                            iconAnchor: [0, 24],
                            labelAnchor: [-6, 0],
                            popupAnchor: [0, -36],
                            html: '<span class="fa-stack fa-2x">' +
                                '<i class="fa fa-circle fa-stack-2x" style="color:' + getRandomColor() + '"></i>' +
                                '<i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>' +
                                '</span>'
                        })
                    }).addTo(map);
                }
                // popup livewire click
                // polygon.bindPopup(
                //     '<b>ID</b> : ' + item['id'] + '<br>' +
                //     "<b>Desa : </b>" + item['nama_desa'] + "<br>" +
                //     "<b>Pemilik Lahan : </b>" + item['nama_pemiliklahan'] + "<br>" +
                //     "<b>Jenis Tanah : </b>" + item['jenis_tanah'] + "<br>" +
                //     "<b>Ketinggian : </b>" + item['ketinggian'] + " mdpl" + "<br>" +
                //     "<b>Kelembaban : </b>" + item['kelembaban'] + "%<br>" +
                //     "<b>Luas Lahan : </b>" + item['luas_lahan'] + " m<sup>2</sup>" + "<br>"
                //     );
                });
            // maps leaflet geoman
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
            // end maps leaflet geoman

            // maps leaflet geoman draw
            map.on('pm:create', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
                // console.log(dataString);
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
                // console.log(dataString);
            });
            // end maps leaflet geoman edit

            // maps leaflet geoman delete
            map.on('pm:remove', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
                console.log(dataString);
            });
            // end maps leaflet geoman delete

            // maps leaflet geoman draw polygon
            map.on('pm:drawstart', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
                // console.log(dataString);
            });
            // end maps leaflet geoman draw polygon

            // maps leaflet geoman edit polygon
            map.on('pm:editstart', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
                // console.log(dataString);
            });
            // end maps leaflet geoman edit polygon

            // maps leaflet geoman delete polygon
            map.on('pm:deletestart', function(e) {
                var layer = e.layer;
                var type = e.shape;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                @this.set('batas_lahan', dataString);
                // console.log(dataString);
            });

        });
    </script>
    @endpush
</div>
