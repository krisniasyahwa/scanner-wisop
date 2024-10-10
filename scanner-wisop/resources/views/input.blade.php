<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Product Data</title>
</head>
<body>
    <h1>Input Product Data</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Input Barcode -->
        <label for="barcode">Barcode:</label>
        <input type="text" id="barcode" name="barcode" required>
        <br><br>

        <!-- Input Delivery Note Number -->
        <label for="delivery_note_number">Delivery Note Number:</label>
        <input type="text" id="delivery_note_number" name="delivery_note_number" required>
        <br><br>

        <!-- Upload Product PDF -->
        <label for="pdf">Product PDF:</label>
        <input type="file" id="pdf" name="pdf" accept="application/pdf" required>
        <br><br>

        <!-- Upload QR Code Image -->
        <label for="qr_code">QR Code Image:</label>
        <input type="file" id="qr_code" name="qr_code" accept="image/*" required>
        <br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>

