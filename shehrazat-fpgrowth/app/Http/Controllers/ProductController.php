<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    public function index()
    {
        $data['product'] = Product::all();
        return view('product', $data);
    }

    public function insert(Request $req)
    {
        $product = new Product();
        $product->nama_produk = $req->name;
        $product->stok_produk = $req->stock;
        $product->harga_produk = $req->price;
        $product->save();

        Session::flash('success', 'Data produk berhasil ditambahkan');
        return redirect()->back();
    }

    public function delete($id)
    {
        $product = Product::where('id_produk', $id);
        $product->delete();

        Session::flash('success', 'Data produk berhasil dihapus');
        return redirect()->back();
    }

    public function view($id)
    {
        $product = Product::where('id_produk', $id);
        $data = $product->first();

        return response()->json($data);
    }

    public function all_product()
    {
        $product = Product::all();
        return response()->json($product);
    }

    public function update(Request $req)
    {
        $product = Product::where('id_produk', $req->id);
        $product->update([
            'nama_produk' => $req->name,
            'harga_produk' => $req->price,
            'stok_produk' => $req->stock,
        ]);

        Session::flash('success', 'Data produk berhasil disimpan');
        return redirect()->back();
    }
}