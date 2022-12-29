<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Laporan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Tahun</label>
                                    <div class="col-md-10">
                                        {{-- tahun --}}
                                        <select class="form-control" wire:model="tahun">
                                            <option value="">Pilih Tahun</option>
                                            {{-- tahun 2018 - 2025 --}}
                                            @for ($i = 2018; $i < 2026; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('tahun') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                        {{-- desa --}}
                                        <label for="example-text-input" class="col-md-2 col-form-label">Kecamatan</label>
                                        {{-- kecamatan --}}
                                        <div class="col-md-10">
                                            <select class="form-control mt-2" wire:model="kecamatan">
                                                <option value="">Pilih Kecamatan</option>
                                                @foreach ($kecamatans as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kecamatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="example-text-input" class="col-md-2 col-form-label">Desa</label>
                                        <div class="col-md-10">
                                            <select class="form-control mt-2" wire:model="desa">
                                                <option value="">Pilih Desa</option>
                                                @foreach ($desas as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_desa }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            {{-- button --}}
                                            <button class="btn btn-primary mt-2" wire:click.prevent="cetakPdf()">Cetak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
