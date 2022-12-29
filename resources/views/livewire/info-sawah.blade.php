<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Informasi Tanah') }}</div>

                    <div class="card-body">
                        {{-- add button --}}
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah</a>
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
                        </div>

                        {{-- table --}}
                        <div class="row mt-2">
                            <div class=" col-md-12">
                                <div class="table-responsive">
                                    <table class="table  table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Tanah</th>
                                                <th>Ketinggian Tanah</th>
                                                <th>Kelembaban Tanah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($infotanahs as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->jenis_tanah }}</td>
                                                <td>{{ $item->ketinggian }} mdpl</td>
                                                <td>{{ $item->kelembaban }} %</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" wire:click="tanahId({{ $item->id }})">Edit</a>
                                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" wire:click="tanahId({{ $item->id }})">Delete</a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada data.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- addModal --}}
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <form wire:submit.prevent="store">
                        <div class="form-group row">
                            <label for="jenis_tanah" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Tanah') }}</label>
                            <div class="col-md-6 mb-2">
                                <input id="jenis_tanah" type="text" class="form-control @error('jenis_tanah') is-invalid @enderror" name="jenis_tanah" wire:model="jenis_tanah" required autocomplete="jenis_tanah" autofocus>
                                @error('jenis_tanah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- ketinggian --}}
                            <label for="ketinggian_tanah" class="col-md-4 col-form-label text-md-right">{{ __('Ketinggian Tanah') }}</label>
                            <div class="col-md-6 mb-2">
                                <input id="ketinggian_tanah" type="text" class="form-control @error('ketinggian_tanah') is-invalid @enderror" name="ketinggian_tanah" wire:model="ketinggian_tanah" required autocomplete="ketinggian_tanah" autofocus>
                                @error('ketinggian_tanah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- kelembaban --}}
                            <label for="kelembaban_tanah" class="col-md-4 col-form-label text-md-right">{{ __('Kelembaban Tanah') }}</label>
                            <div class="col-md-6 mb-2">
                                <input id="kelembaban_tanah" type="text" class="form-control @error('kelembaban_tanah') is-invalid @enderror" name="kelembaban_tanah" wire:model="kelembaban_tanah" required autocomplete="kelembaban_tanah" autofocus>
                                @error('kelembaban_tanah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" @if($jenis_tanah=='' || $ketinggian_tanah=='' || $kelembaban_tanah=='' ) disabled @endif>Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end addModal --}}

    {{-- editModal --}}
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <form wire:submit.prevent="update">
                        <div class="form-group row">
                            <label for="jenis_tanah" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Tanah') }}</label>
                            <div class="col-md-6 mb-2">
                                <input id="jenis_tanah" type="text" class="form-control @error('jenis_tanah') is-invalid @enderror" name="jenis_tanah" wire:model="jenis_tanah" required autocomplete="jenis_tanah" autofocus>
                                @error('jenis_tanah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- ketinggian --}}
                            <label for="ketinggian_tanah" class="col-md-4 col-form-label text-md-right">{{ __('Ketinggian Tanah') }}</label>
                            <div class="col-md-6 mb-2">
                                <input id="ketinggian_tanah" type="text" class="form-control @error('ketinggian_tanah') is-invalid @enderror" name="ketinggian_tanah" wire:model="ketinggian_tanah" required autocomplete="ketinggian_tanah" autofocus>
                                @error('ketinggian_tanah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- kelembaban --}}
                            <label for="kelembaban_tanah" class="col-md-4 col-form-label text-md-right">{{ __('Kelembaban Tanah') }}</label>
                            <div class="col-md-6 mb-2">
                                <input id="kelembaban_tanah" type="text" class="form-control @error('kelembaban_tanah') is-invalid @enderror" name="kelembaban_tanah" wire:model="kelembaban_tanah" required autocomplete="kelembaban_tanah" autofocus>
                                @error('kelembaban_tanah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" @if($jenis_tanah=='' || $ketinggian_tanah=='' || $kelembaban_tanah=='' ) disabled @endif>Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end editModal --}}

    {{-- deleteModal --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Kamu Yakin akan Menghapus?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end deleteModal --}}
</div>
