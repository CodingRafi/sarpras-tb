@extends('mylayouts.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <form action="{{ isset($data) ? route('guru.update', $data->id) : route('guru.store') }}" method="POST">
                    @csrf
                    @isset($data)
                        @method('patch')
                    @endisset
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <h5 class="card-header">{{ isset($data) ? 'Edit' : 'Tambah' }} Guru</h5>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="mt-2 form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ isset($data) ? $data->nama : old('nama') }}"
                                            placeholder="Nama">

                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}  
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="no_telp" class="mt-2">No Telepon</label>
                                        <input type="number"
                                            class="form-control mt-2 @error('no_telp') is-invalid @enderror" id="no_telp"
                                            name="no_telp" placeholder="No Telepon"
                                            value="{{ isset($data) ? $data->no_telp : old('no_telp') }}">
                                        @error('no_telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}  
                                            </div>
                                        @enderror
                                    </div> --}}
                                    
                                <div class="d-flex justify-content-end mt-3">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
