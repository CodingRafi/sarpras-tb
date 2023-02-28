@extends('mylayouts.main')

@section('tambahancss')
    <style>
        .swal2-container {
            z-index: 9999 !important;
        }
    </style>
@endsection

@section('container')
    {{-- @dd('oke') --}}
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="card-header">Users</h5>
                        </div>
                        <div class="col-md-2 d-flex justify-center align-items-center">
                            @can('add_users')
                                <button type="button" class="btn btn-primary tombol-buat-user" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Create User
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="height: 65vh">
                    @if (count($users) > 0)
                        <table class="table" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name User</th>
                                    <th>Email User</th>
                                    <th>Role</th>
                                    @can('edit_users', 'delete_users')
                                        <th>Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-capitalize">
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    {{ str_replace('_', ' ', $v) }}
                                                @endforeach
                                            @endif
                                        </td>
                                        @can('edit_users', 'delete_users')
                                            <td>
                                                @can('edit_users')
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-warning {{ $user->hasRole('admin') ? 'disabled' : '' }}">Update</a>
                                                @endcan
                                                @can('delete_users')
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                                        class="d-inline" id="delete{{ $user->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="#" data-id={{ $user->id }}
                                                            class="btn btn-danger swal-confrim {{ $user->hasRole('admin') ? 'disabled' : '' }}">
                                                            Hapus
                                                        </a>
                                                    </form>
                                                @endcan
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info text-center" role="alert">
                            Data tidak ditemukan
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <!-- / Content -->
        @can('add_users')
            <!-- Modal -->
            <div class=" modalkey modal fade @error('name') show @enderror @error('email') show @enderror @error('password') show @enderror"
                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                @error('name') style="display: block;background: rgba(69,90,100, .5);" @enderror
                @error('email') style="display: block;background: rgba(69,90,100, .5);" @enderror
                @error('password') style="display: block;background: rgba(69,90,100, .5);" @enderror>
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('users.store') }}" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            @if (count($roles) > 1)
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="html5-text-input" class="col-md-3 col-form-label">Name</label>
                                        <div class="col-md-9">
                                            <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                id="html5-text-input" placeholder="Name User" name="name"
                                                value="{{ old('name') }}" />
                                            @error('name')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="html5-email-input" class="col-md-3 col-form-label">Email User</label>
                                        <div class="col-md-9">
                                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                                placeholder="john@example.com" id="html5-email-input" name="email"
                                                value="{{ old('email') }}" />
                                            @error('email')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="html5-password-input" class="col-md-3 col-form-label">Password</label>
                                        <div class="col-md-9">
                                            <input class="form-control @error('password') is-invalid @enderror" type="text"
                                                placeholder="Password" id="html5-password-input" name="password"
                                                value="12345678" disabled />
                                            @error('password')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="exampleDataList" class="col-form-label col-md-3">Role</label>
                                        <div class="col-md-9">

                                            <select name="roles" id="datalistOptions" class="form-select text-capitalize">
                                                @foreach ($roles as $role)
                                                    @if ($role !== 'admin')
                                                        <option value="{{ $role }}">
                                                            {{ str_replace('_', ' ', $role) }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary tombol-close-bawah"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create User</button>
                                </div>
                            @else
                            <div class="container-fluid d-flex justify-content-center p-0 align-items-center" style="min-height: 20rem;">
                                <div class="container d-flex justify-content-center" style="height: 100%">
                                    <div class="alert alert-primary" role="alert">Maaf tidak ada role tersedia</div>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection

@section('tambahanjs')
    <script>
        const modal = document.querySelector('.modalkey');
        const btnClose = document.querySelector('.btn-close');
        const tombolCloseBawah = document.querySelector('.tombol-close-bawah');

        btnClose.addEventListener('click', function() {
            modal.classList.remove('show');
            modal.style.display = 'none';
            modal.style.background = 'none';
        })

        tombolCloseBawah.addEventListener('click', function() {
            modal.classList.remove('show');
            modal.style.display = 'none';
            modal.style.background = 'none';
        })
    </script>
    <script>
        $(".swal-confrim").click(function(e) {
            id = e.target.dataset.id;
            Swal.fire({
                title: 'Apakah anda yakin ingin hapus user ini?',
                text: "Data yang terhapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'

            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete${id}`).submit();
                } else {

                }

            })

        });
    </script>
@endsection
