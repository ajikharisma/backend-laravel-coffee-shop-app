<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ================= GET: list produk =================
    public function index()
    {
        return response()->json(Product::all());
    }

    // ================= GET: produk terbaru =================
    public function latest(Request $request)
    {
        $limit = $request->query('limit', 4);

        return response()->json(
            Product::orderBy('created_at', 'desc')->take($limit)->get()
        );
    }

    // ================= POST: tambah produk =================
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255', // ✅ TAMBAH
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        // upload gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name'        => $request->name,
            'category'    => $request->category, // ✅ TAMBAH
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
        ]);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'product' => $product,
        ], 201);
    }

    // ================= GET: detail produk =================
    public function show(Product $product)
    {
        return response()->json($product);
    }

    // ================= PUT: update produk =================
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'category'    => 'sometimes|required|string|max:255', // ✅ TAMBAH
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // jika upload gambar baru
        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'        => $request->name ?? $product->name,
            'category'    => $request->category ?? $product->category, // ✅ TAMBAH
            'description' => $request->description ?? $product->description,
            'price'       => $request->price ?? $product->price,
        ]);

        return response()->json([
            'message' => 'Produk berhasil diupdate',
            'product' => $product,
        ]);
    }

    // ================= DELETE: hapus produk =================
    public function destroy(Product $product)
    {
        // hapus gambar dari storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus',
        ]);
    }
}


