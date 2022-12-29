<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Potensi</title>
    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    {{-- leaflet --}}

</head>
<body>
    {{-- kop Dinas Pertanian Kabupaten Kolaka Timur --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <img src="{{ asset('koltim.png') }}" alt="Kop Dinas Pertanian" width="60px">
                    <h4 class="mt-2">DINAS PERTANIAN</h4>
                    <h4 class="mt-0">KABUPATEN KOLAKA TIMUR</h4>
                </div>
            </div>
        </div>
    </div>
    {{-- judul --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h5>Laporan Potensi Sawah</h5>
                </div>
            </div>
        </div>
    </div>
    {{-- footer --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Desa</th>
                                <th>Nama Pemilik</th>
                                <th>Jenis Tahan</th>
                                <th>Ketinggian</th>
                                <th>Kelembaban</th>
                                <th>Luas Sawah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($petas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_desa }}</td>
                                <td>{{ $item->nama_pemiliklahan }}</td>
                                <td>{{ $item->jenis_tanah }}</td>
                                <td>{{ $item->ketinggian }} mpdl</td>
                                <td>{{ $item->kelembaban }}%</td>
                                <td>{{ $item->luas_lahan }} Ha</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    {{-- bootstrap --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    {{-- leaflet --}}

</body>
</html>
