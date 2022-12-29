<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Desa') }}</div>

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
                            <div class="col-md-12">
                                {{-- alert message with close--}}
                                @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
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
                                                <th>Nama Desa</th>
                                                <th>Kecamatan</th>
                                                <th>Luas Wilayah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($desas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_desa }}</td>
                                                <td>{{ $item->nama_kecamatan }}</td>
                                                <td>{{ $item->luas_wilayah }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" wire:click="desaId({{ $item->id }})">Edit</a>
                                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" wire:click="desaId({{ $item->id }})">Delete</a>

                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan=" 5" class="text-center">Data Kosong</td>
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

    {{-- add modal --}}
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Desa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="">Nama Desa</label>
                        <input type="text" class="form-control" wire:model="nama_desa">
                        @error('nama_desa') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Kecamatan</label>
                        <select wire:model="kecamatan_id" class="form-control">
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($kecamatans as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Luas Wilayah</label>
                        <input type="text" class="form-control" wire:model="luas_wilayah">
                        @error('luas_wilayah') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="store()" data-bs-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end add modal --}}

    {{-- edit modal --}}
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Desa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="">Nama Desa</label>
                        <input type="text" class="form-control" wire:model="nama_desa">
                        @error('nama_desa') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Kecamatan</label>
                        <select wire:model="kecamatan_id" class="form-control">
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($kecamatans as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Luas Wilayah</label>
                        <input type="text" class="form-control" wire:model="luas_wilayah">
                        @error('luas_wilayah') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="update()" data-bs-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end edit modal --}}

    {{-- delete modal --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Desa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <h5>Apakah anda yakin ingin menghapus data ini?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="destroy()" data-bs-dismiss="modal">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
