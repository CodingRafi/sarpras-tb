@extends('mylayouts.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Ubah Role</h5>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="html5-text-input" class="col-md-2 col-form-label">Name Role</label>
                                    <div class="col-md-10">
                                        <input style="text-transform: capitalize;" class="form-control @error('name') is-invalid @enderror" type="text"
                                            value="{{ str_replace("_", " ", $role->name), old('name') }}" id="html5-text-input"
                                            placeholder="Name Role" name="name"  />
                                        @error('name')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                @foreach ($permissions as $permission)
                                    @if (in_array($permission->id, $rolePermissions))
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" value="{{ $permission->id }}"
                                                id="{{ $permission->name }}" name="permission[]" checked/>
                                            <label class="form-check-label"
                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                        </div>
                                    @else
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" value="{{ $permission->id }}"
                                                id="{{ $permission->name }}" name="permission[]" />
                                            <label class="form-check-label"
                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                        </div>
                                    @endif
                                @endforeach
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
