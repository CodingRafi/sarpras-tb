@extends('mylayouts.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="col-xl-12">
                        <!-- HTML5 Inputs -->
                        <div class="card mb-4">
                            <h5 class="card-header">Ubah User</h5>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="html5-text-input" class="col-md-2 col-form-label">Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            value="{{ $user->name, old('name') }}" id="html5-text-input"
                                            placeholder="Name User" name="name" />
                                        @error('name')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="html5-email-input" class="col-md-2 col-form-label">Email User</label>
                                    <div class="col-md-10">
                                        <input class="form-control @error('name') is-invalid @enderror" type="email"
                                            placeholder="john@example.com" id="html5-email-input"
                                            value="{{ $user->email, old('email') }}" name="email" />
                                        @error('email')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="exampleDataList" class="col-form-label col-md-2">Role</label>
                                    <div class="col-md-10">

                                        <select name="roles" id="datalistOptions" class="form-select text-capitalize">
                                            @foreach ($roles as $role)
                                                @if ($role !== 'admin')
                                                    @if (count($userRole) > 0)
                                                        @if ($role == $userRole[0]['name'])
                                                            <option value="{{ $role }}" selected>{{ str_replace("_", " ", $role) }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $role }}">{{ str_replace("_", " ", $role) }}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $role }}">{{ str_replace("_", " ", $role) }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
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
