<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">


    <title>SMK Taruna Bhakti</title>
</head>

<body
    style="background: url(img/background_tb_tamu.jpg);background-size: cover;background-position: center;overflow: hidden;">
    <div class="container-fluid"
        style="width: 100vw;height: 100vh;margin: 0;padding: 0;display: flex;justify-content: center;align-items: center;">
        <div class="card" style="width: 30vw; text-align: center">
            <div class="card-body" style="padding: 2rem">
                <div class="container d-flex justify-content-center">
                    <img src="{{ asset('img/logo1.png') }}" class="rounded float-left" alt="SMK TARUNA BHAKTI" style="height:
                    12vw">
                </div>
                <h5 class="card-title mt-3">Selamat Datang <br><span style="font-size: 1.3rem">Di SMK TARUNA BHAKTI</span></h5>
                {{-- <h5 class="card-title" style="font-size: 14px;font-weight: 400;">Ekspose Produk Kreatif SMK bidang
                    Kelautan Perikanan Teknologi Informasi dan Komunikasi (KPTK)</h5> --}}
                <a href="/create-data?home=pengunjung" class="btn btn-primary btn-lg btn-block"
                    style="font-size: 13px;height: 37px;margin-top: 22px;">Buat data pengunjung</a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert text-white alert-dismissible fade show m-0 bg-warning alert-nontifikasi"
            role="alert" style="z-index: 99;position: fixed;right: 2vh;top: 2vh;padding: 0.4rem 1.2rem;opacity: .85;display: flex;justify-content: center;align-items: center;">
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-alert-triangle">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                </path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg> {{ session('success') }}
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <script>
        const alertNontifikasi = document.querySelector('.alert-nontifikasi');
        const myTimeout = setTimeout(myGreeting, 5000);

        function myGreeting() {
            if (alertNontifikasi) {
                alertNontifikasi.classList.remove('show');
                alertNontifikasi.style.display = 'none';
            }
        }
    </script>

</body>

</html>
