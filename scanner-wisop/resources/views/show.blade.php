<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
</head>
<body>
    <h1>Product PDF Viewer</h1>
    <!-- Tampilkan file PDF di iframe -->
    <iframe src="{{ asset('storage/' . $product->pdf_path) }}" width="100%" height="600px"></iframe>
</body>
</html>
