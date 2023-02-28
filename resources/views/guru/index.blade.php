@extends('mylayouts.main')

@section('tambahancss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">
<style>
    .swal2-container {
        z-index: 9999 !important;
    }

    .dropdown-toggle::after {
        display: none;
    }
</style>
@endsection

@section('container')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-md-7">
                        <h5 class="card-header">Guru</h5>
                    </div>
                    <div class="col-md d-flex justify-content-end align-items-center" style="padding-right: 2rem;">
                        <a href="{{ route('guru.sync_telegram') }}" class="btn btn-primary"
                            style="margin-right: 10px">Sync Telegram</a>
                        {{-- <a href="{{ route('guru.create') }}" class="btn btn-primary tombol-buat-user"
                            style="margin-right: 10px">Tambah</a> --}}
                    </div>
                </div>
            </div>
            <div class="container" style="overflow: auto;min-height: 65vh">
                <div class="table-responsive">
                    <table class="table-hover table text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                {{-- <th>NO WA</th> --}}
                                @can('edit_guru', 'delete_guru')
                                <th>Actions</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gurus as $guru)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $guru->nama }}</td>
                                {{-- <td>{{ $guru->no_telp }}</td> --}}
                                @can('edit_guru', 'delete_guru')
                                <td>
                                    @can('edit_guru')
                                    <a href="{{ route('guru.edit', $guru->id) }}"
                                        class="btn btn-warning">Update</a>
                                    @endcan
                                    @can('delete_guru')
                                    <form action="{{ route('guru.destroy', $guru->id) }}" method="post"
                                        class="d-inline" id="delete{{ $guru->id }}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger swal-confrim">Hapus</button>
                                    </form>
                                    @endcan
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- / Content -->
    <!-- Modal -->

    <div class="content-backdrop fade"></div>
</div>
@endsection

@section('tambahanjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script>
    $(".swal-confrim").click(function(e) {
            id = e.target.dataset.id;
            Swal.fire({
                title: 'Apakah anda yakin ingin hapus data ini?',
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

<script>
    const alertNontifikasi = document.querySelector('.alert-nontifikasi');
        const myTimeout = setTimeout(myGreeting, 5000);

        function myGreeting() {
            if (alertNontifikasi) {
                alertNontifikasi.style.display = 'none';
            }
        }
</script>
@endsection