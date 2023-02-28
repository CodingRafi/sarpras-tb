@extends('mylayouts.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4" style="border-top: 10px solid #1e88d7">
                        <h5 class="card-header">Profile Details</h5>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3">
                                    <div class="card-body d-flex justify-content-center" style="flex-direction: column">
                                        <div class="d-flex justify-content-center gap-4">
                                            @if (Auth::user()->foto_profil == '/img/avatar-1.png')
                                                <img src="{{ Auth::user()->foto_profil }}" alt="user-avatar"
                                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="user-avatar"
                                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                            @endif
                                        </div>
                                        <a href="/ubah-password" class="btn btn-primary mt-3">Ubah Password</a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <form id="formAccountSettings" method="POST" enctype="multipart/form-data"
                                            action="/update-user">
                                            @csrf
                                            @method('patch')
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input class="form-control" type="text" id="name" name="name"
                                                        value="{{ Auth::user()->name }}" autofocus />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control" type="text" name="email" id="email"
                                                        value="{{ Auth::user()->email }}" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="foto" class="form-label">Profil Picture</label>
                                                    <img src="" alt="" style="width: 7rem;display: none;"
                                                        class="form-control pp-preview">
                                                    <input class="form-control mt-3 input-pp" type="file" name="foto_profil"
                                                        id="foto" accept="image/*" onchange="previewImageUpdate();" />
                                                </div>
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                                                <button type="submit" class="btn btn-primary me-2">Apply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection

@section('tambahanjs')
    <script>
        function previewImageUpdate() {
            const pp_preview = document.querySelector('.pp-preview');
            const input = document.querySelector('.input-pp');

            pp_preview.style.display = 'block';

            var oFReader = new FileReader();
            oFReader.readAsDataURL(input.files[0]);

            oFReader.onload = function(oFREvent) {
                pp_preview.src = oFREvent.target.result;
            };
        };
    </script>
@endsection
