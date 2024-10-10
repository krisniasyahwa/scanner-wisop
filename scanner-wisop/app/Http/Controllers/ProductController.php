<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all();
    return view('list', compact('products'));
}

public function store(Request $request)
{
    $request->validate([
        'barcode' => 'required|unique:products',
        'delivery_note_number' => 'required|unique:products',
        'pdf' => 'required|mimes:pdf|max:10000',
        'qr_code' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk QR code
    ]);

    // Simpan PDF di folder 'public/pdfs'
    $pdfPath = $request->file('pdf')->store('pdfs', 'public');

    // Simpan QR Code di folder 'public/qr_codes'
    $qrCodePath = $request->file('qr_code')->store('qr_codes', 'public');

    // Buat data produk baru dengan path QR code
    Product::create([
        'barcode' => $request->barcode,
        'delivery_note_number' => $request->delivery_note_number,
        'pdf_path' => $pdfPath,
        'qr_code_path' => $qrCodePath,
    ]);

    // Redirect ke halaman daftar produk dengan pesan sukses
    return redirect()->route('products.index')->with('success', 'Product added successfully');
}


public function create()
{
    return view('input');
}


public function show($barcode)
{
    // Cari produk berdasarkan barcode
    $product = Product::where('barcode', $barcode)->firstOrFail();

    // Tampilkan view 'show' dengan data produk yang ditemukan
    if ($product) {
        return view('show', compact('product'));
    } else {
        return redirect()->route('products.index')->with('error', 'Barcode tidak ditemukan di database.');
    }

}

public function check($barcode)
{
    $product = Product::where('barcode', $barcode)->first();

    if ($product) {
        return response()->json(['status' => 'found', 'product' => $product]);
    } else {
        return response()->json(['status' => 'not found']);
    }
}


}
