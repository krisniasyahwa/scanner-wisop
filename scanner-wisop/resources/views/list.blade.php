<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <script>
        function handleScan(event) {
            if (event.key === 'Enter') {
                const barcode = event.target.value;
                if (barcode) {
                    // Kirim permintaan AJAX ke server untuk memeriksa barcode
                    $.ajax({
                        url: `/products/check/${barcode}`,
                        method: 'GET',
                        success: function(response) {
                            if (response.status === 'found') {
                                // Jika barcode ditemukan, arahkan ke halaman detail produk
                                window.location.href = `/products/${barcode}`;
                            } else {
                                // Jika barcode tidak ditemukan, tampilkan pesan error
                                alert('Barcode tidak terdaftar di database.');
                            }
                        },
                        error: function() {
                            alert('Terjadi kesalahan saat memeriksa barcode.');
                        }
                    });
                }
                // Kosongkan input setelah scan
                event.target.value = '';
            }
        }
    </script>
</head>
<body>
    <h1>Product List</h1>

    <!-- Input field for scanning barcode -->
    <input type="text" id="barcode" placeholder="Scan barcode here" onkeypress="handleScan(event)" autofocus>

    <table border="1">
        <thead>
            <tr>
                <th>Barcode</th>
                <th>Delivery Note Number</th>
                <th>QR Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->barcode }}</td>
                <td>{{ $product->delivery_note_number }}</td>
                <td>
                    @if ($product->qr_code_path)
                        <img src="{{ asset('storage/' . $product->qr_code_path) }}" width="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.show', $product->barcode) }}" target="_blank">View PDF</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
