@extends('mylayouts.main')

@section('tambahancss')
<style>
    .kbw-signature {
        width: 100%;
        height: 200px;
    }

    #sig canvas {
        width: 100% !important;
        height: auto;
    }
</style>
@endsection

@section('container')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <form action="{{ route('buku-tamu.store') }}" method="POST">
                @csrf
                <div class="col-xl-12">
                    <!-- HTML5 Inputs -->
                    <div class="card mb-4">
                        <h5 class="card-header">Create Buku Tamu</h5>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="form-group mb-2">
                                    <label for="nama" class="form-label">Nama Tamu</label>
                                    <input type="text" class="mt-2 form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}"
                                        placeholder="Nama tamu yang berkunjung">

                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="no_telp" class="form-label">No Telepon</label>
                                    <input type="number" class="mt-2 form-control @error('no_telp') is-invalid @enderror"
                                        id="no_telp" name="no_telp" value="{{ old('no_telp') }}"
                                        placeholder="No Telepon yang berkunjung">

                                    @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="instansi" class="form-label">Instansi</label>
                                    <input type="text" class="form-control mt-2 @error('instansi') is-invalid @enderror"
                                        id="instansi" name="instansi" placeholder="Instansi Tamu yang berkunjung"
                                        value="{{ old('instansi') }}">
                                    @error('instansi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select mt-2 @error('instansi') is-invalid @enderror"
                                        aria-label="Default select example" name="kategori" required>
                                        <option value="umum" {{ old('kategori')=='umum' ? 'selected' : '' }}>Tamu
                                            Umum</option>
                                        <option value="khusus" {{ old('kategori')=='khusus' ? 'selected' : '' }}>
                                            Tamu Khusus</option>
                                    </select>
                                    @error('kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control mt-2 @error('alamat') is-invalid @enderror"
                                        id="alamat" rows="5" name="alamat" value="{{ old('alamat') }}"
                                        placeholder="Alamat tamu yang berkunjung">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="image" class="form-label">Foto kehadiran</label>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div id="camera"></div>
                                                <br />
                                                <input type=button class="btn btn-sm btn-info" value="Take Snapshot"
                                                    onClick="take_snapshot()">
                                                <input type="hidden" name="image" class="image-tag">
                                            </div>
                                            <div class="col-md-6">
                                                <div id="results">Your captured image will appear here...</div>
                                            </div>
                                        </div>
                                        @error('image')
                                        <div class="invalid-feedback d-block">
                                            The picture field is required.
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="tandaTangan" class="form-label">Tanda tangan tamu</label>
                                    <div class="col-md-12">
                                        <br />
                                        <div id="sig"></div>
                                        <br />
                                        <button id="clear" class="btn btn-danger">Hapus Tanda Tangan</button>
                                        <textarea id="signature64" name="signed" style="display: none"></textarea>
                                        @error('signed')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group mb-2">
                                    <label for="guru_id" class="form-label">Tujuan</label>
                                    <select class="fstdropdown-select @error('guru_id') is-invalid @enderror"
                                        name="guru_id" id="guru_id" style=" font-size: 15px; height: 6.5vh;">
                                        @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('guru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="keperluan" class="form-label">Keperluan</label>
                                    <textarea class="form-control mt-2 @error('keperluan') is-invalid @enderror"
                                        id="keperluan" rows="5" name="keperluan" value="{{ old('keperluan') }}"
                                        placeholder="keperluan tamu yang berkunjung">{{ old('keperluan') }}</textarea>
                                    @error('keperluan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
@endsection

@section('tambahanjs')
<script>
    Webcam.set({
            width: 280,
            height: 200,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }

        var canvas = document.getElementById('signature-pad');
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
</script>
@endsection