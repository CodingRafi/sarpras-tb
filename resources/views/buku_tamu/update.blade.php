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
            <form action="{{ route('buku-tamu.update', $data->id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="col-xl-12">
                    <!-- HTML5 Inputs -->
                    <div class="card mb-4">
                        <h5 class="card-header">Edit Buku Tamu</h5>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="form-group mb-2">
                                    <label for="nama">Nama Tamu</label>
                                    <input type="text" class="mt-1 form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ $data->nama, old('nama') }}"
                                        placeholder="Nama tamu yang berkunjung">

                                    @error('nama')
                                    <div class="invalid-feedback">
                                        The nama tamu field is required.
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="no_telp" class="form-label">No Telepon</label>
                                    <input type="number"
                                        class="mt-1 form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                        name="no_telp" value="{{ $data->no_telp, old('no_telp') }}"
                                        placeholder="No Telepon yang berkunjung">

                                    @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="instansi" class="mt-2">Instansi</label>
                                    <input type="text" class="mt-1 form-control @error('instansi') is-invalid @enderror"
                                        id="instansi" name="instansi" placeholder="Instansi Tamu yang berkunjung"
                                        value="{{ $data->instansi, old('instansi') }}">
                                    @error('instansi')
                                    <div class="invalid-feedback">
                                        The instansi field is required.
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-select  @error('instansi') is-invalid @enderror"
                                        aria-label="Default select example" name="kategori" required>
                                        <option value="umum" {{ old('kategori', $data->kategori) == 'umum' ? 'selected'
                                            : '' }}>Tamu
                                            Umum</option>
                                        <option value="khusus" {{ old('kategori', $data->kategori) == 'khusus' ?
                                            'selected' : '' }}>
                                            Tamu Khusus</option>
                                    </select>
                                    @error('kategori')
                                    <div class="invalid-feedback">
                                        The kategori field is required.
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="alamat" class="mt-2">Alamat</label>
                                    <textarea class="mt-1 form-control @error('alamat') is-invalid @enderror"
                                        id="alamat" name="alamat" value="{{ old('alamat') }}"
                                        placeholder="Alamat tamu yang berkunjung">{{ $data->alamat, old('alamat') }}</textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        The alamat field is required.
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="image" class="mt-2">Foto kehadiran</label>
                                    <div class="container p-0 mt-2">
                                        <div class="row">
                                            @if ($data->image)
                                            <div class="col-md-4">
                                                <img src="/image/{{ $data->image }}" alt="" class="mt-2">
                                                <label class="mt-2">Foto Tersimpan</label>
                                            </div>
                                            @endif
                                            <div class="col-md-4">
                                                <div id="camera"></div>
                                                <br />
                                                <input type=button class="btn btn-sm btn-info mb-3"
                                                    value="Take Snapshot" onClick="take_snapshot()">
                                                <input type="hidden" name="image" class="image-tag">
                                            </div>
                                            <div class="col-md-4">
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
                                    <label for="tandaTangan">Tanda tangan tamu</label>
                                    @if ($data->signed)
                                    <div class="col-md-4">
                                        <img src="/tandatangan/{{ $data->signed }}" alt=""
                                            style="box-shadow: 0 3px 6px #0000001c;">
                                        <label class="mt-2">Tanda Tangan Tersimpan</label>
                                    </div>
                                    @endif
                                    <div class="col-md-12">
                                        <br />
                                        <div id="sig"></div>
                                        <br />
                                        <button id="clear" class="btn btn-danger">Hapus Tanda Tangan</button>
                                        <textarea id="signature64" name="signed" style="display: none"></textarea>
                                        @error('signed')
                                        <div class="invalid-feedback d-block">
                                            The signature field is required.
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
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