<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pemilik Lahan') }}</div>

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
                            <div class=" col-md-12">
                                <div class="table-responsive">
                                    <table class="table  table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. Telp</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pemiliklahans as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_pemiliklahan }}</td>
                                                <td>{{ $item->alamat_pemiliklahan }}</td>
                                                <td>{{ $item->no_hp_pemiliklahan }}</td>
                                                <td>{{ $item->email_pemiliklahan }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" wire:click="pemiliklahanId({{ $item->id }})">Edit</a>
                                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" wire:click="pemiliklahanId({{ $item->id }})">Delete</a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Data Kosong</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pemilik Lahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="store">
                        <div class="form-group mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" wire:model="nama_pemiliklahan">
                            @error('nama_pemiliklahan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" wire:model="alamat_pemiliklahan">
                            @error('alamat_pemiliklahan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">No. Telp</label>
                            <input type="text" class="form-control" wire:model="no_hp_pemiliklahan">
                            @error('no_hp_pemiliklahan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" wire:model="email_pemiliklahan">
                            @error('email_pemiliklahan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        {{-- modal footer --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" wire:submit.prevent="store()" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                        </div>
                    </form>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pemilik Lahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="update">
                        <div class="form-group mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" wire:model="nama_pemiliklahan">
                            @error('nama_pemiliklahan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" wire:model="alamat_pemiliklahan">
                            @error('alamat_pemiliklahan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">No. Telp</label>
                            <input type="text" class="form-control" wire:model="no_hp_pemiliklahan">
                            @error('no_hp_pemiliklahan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" wire:model="email_pemiliklahan">
                            @error('email_pemiliklahan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        {{-- modal footer --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" wire:submit.prevent="update()" data-bs-dismiss="modal" class="btn btn-primary">Update</button>

                        </div>
                    </form>
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
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pemilik Lahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <h4>
                        Apakah anda yakin ingin menghapus data ini?
                    </h4>
                    {{-- modal footer --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" wire:click.prevent="delete()" data-bs-dismiss="modal" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
