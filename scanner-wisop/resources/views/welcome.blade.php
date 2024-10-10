<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Label Scanner</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5bRjXhW+ALEwIH" crossorigin="anonymous">
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    </head>
    <body>

    <div class="container col-lg-6 py-5">
        <div class="card bg-white shadow rounded-3 p-3 border-0">
            <h1>Scan QR Code or Barcode</h1>

            <!-- Video Preview for Instascan -->
            <video id="preview"></video>

            <!-- Pesan Sukses atau Gagal -->
            @if (session()->has('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Inisialisasi Instascan untuk testing
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            console.log(content); // Debug untuk hasil scan
            window.location.href = `/products/${content}`; // Redirect berdasarkan hasil scan
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]); // Gunakan kamera pertama
            } else {
                console.error('No cameras found.');
                alert('Kamera tidak ditemukan.');
            }
        }).catch(function (e) {
            console.error(e);
            alert('Kesalahan saat mengakses kamera: ' + e);
        });

        // Fungsi untuk menerima input dari scanner fisik
        document.getElementById('barcode').addEventListener('keypress', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const barcode = event.target.value;
                if (barcode) {
                    window.location.href = `/products/${barcode}`;
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
