<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <link type="text/css" href="/css/jquery-ui.css"
        rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="/css/jquery.signature.css">

    <style>
        .kbw-signature {
            width: 100%;
            height: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }

        @media(max-width:480px) {
            .row-header {
                display: block !important;
            }

            .col-10-header {
                max-width: 100%;
            }

            .container-header {
                text-align: center;
            }

            .col-img {
                max-width: 26%;
                margin: auto !important;
                padding: 0;
            }

            .img-tb {
                width: 5.5rem !important;
                margin: auto;
            }

            .card-nya {
                margin-top: 4rem !important;
            }
        }
        
        @media (min-width:481px) and (max-width:850px) {
            .card-nya {
                margin-top: 4rem !important;
            }
        }
    </style>

    <title>SMK Taruna Bhakti</title>
</head>

<body style="background: url('/img/19742.jpg');background-size: 30rem">
    <a href="/" class="btn rounded-circle d-flex p-2 bg-white text-danger" type="submit"
        style="position: absolute;right: 10px;top: 10px;box-shadow: 0px 4px 7px 0px rgb(145 142 142 / 75%);"><svg
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-arrow-left">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg></a>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card mt-5 mb-5 card-nya" style="min-width: 70%;box-shadow: 0px 7px 10px 3px rgb(102 101 101 / 75%)">
            <div class="card-header bg-info text-white">
                <div class="container-fluid p-0">
                    <div class="row row-header">
                        <div class="col-10 col-10-header">
                            <div class="container-fluid p-0 container-header">
                                <div class="row row-header">
                                    <div class="col-1 mr-2 col-img">
                                        <img src="/img/logo1.png" alt="" style="width: 3.5rem;" class="img-tb">
                                    </div>
                                    <div class="col">
                                        Selamat Datang Di SMK TARUNA BHAKTI
                                        <br>
                                        <small>Silahkan isi data pengunjung berikut ini:</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col p-0 m-auto">

                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <form action="/store-data?home=pengunjung" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Tamu</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" value="{{ old('nama') }}" placeholder="Nama tamu yang berkunjung">

                        @error('nama')
                            <div class="invalid-feedback">
                                The nama tamu field is required.
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="instansi">Instansi</label>
                        <input type="text" class="form-control @error('instansi') is-invalid @enderror"
                            id="instansi" name="instansi" placeholder="Instansi Tamu yang berkunjung" value="{{ old('instansi') }}">
                        @error('instansi')
                            <div class="invalid-feedback">
                                The instansi field is required.
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-select  @error('kategori') is-invalid @enderror"
                            aria-label="Default select example" name="kategori" required>
                            <option value="umum" {{ (old('kategori') == 'umum') ? 'selected' : ''}}>Tamu Umum</option>
                            <option value="khusus" {{ (old('kategori') == 'khusus') ? 'selected' : ''}}>Tamu Khusus</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">
                                The kategori field is required.
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="5" name="alamat"
                            value="{{ old('alamat') }}" placeholder="Alamat tamu yang berkunjung">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                The alamat field is required.
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Foto kehadiran</label>
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
                    <div class="form-group">
                        <label for="tandaTangan">Tanda tangan tamu</label>
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
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-info" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid py-3 div-footer" style="background: #fff;">
        <div class="row align-items-center">
            <div class="col-md-4 d-flex align-items-center justify-content-center" style="gap: .5rem;">
                <img src="/img/logoStarbhakForApp.png" alt="" style="width: 1.7rem;">
                <h6 class="m-0">SMK TARUNA BHAKTI</h6>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="text-center">
                    <h5 class="m-0" style="font-size: 1rem;">Proudly powered by <a
                            href="https://github.com/CodingRafi" target="_blank">CodingRafi</a></h5>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    <script src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/jquery.signature.js"></script>
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
</body>

</html>
