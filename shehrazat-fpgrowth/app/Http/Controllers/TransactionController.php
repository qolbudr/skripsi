<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Http\Request;
use Session;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = new Transaction();
        $data['transaction'] = $transaction->transaction();
        $data['product'] = Product::all();
        return view('transaction', $data);
    }

    public function get_product_in_transaction($id)
    {
        $transaction = new Transaction();
        $product = $transaction->get_product_in_transaction($id);
        return response()->json($product);
    }

    public function delete($id)
    {
        $transaction = Transaction::where('id_transaksi', $id);
        $transaction->delete();

        Session::flash('success', 'Data transaksi berhasil dihapus');
        return redirect()->back();
    }

    public function add_transaction(Request $req)
    {
        $trxId = 0;
        $findTrxId = Transaction::where('kode_transaksi', $req->kode)->first();
        if($findTrxId == null) {
            $trx = new Transaction();
            $trx->kode_transaksi = $req->kode;
            $trx->tanggal_transaksi = $req->tanggal;
            $trx->save();
            $trxId = $trx->id;
        } else {
            $trxId = $findTrxId->id_transaksi;
        }

        for($i = 1; $i <= $req->count; $i++) {
            $productKey = "id_produk-".$i;
            $qtyKey = "jumlah_terjual-".$i;
            $productId = $req->{$productKey};
            $qty = $req->{$productKey};
            $sales = new Sales();
            $sales->id_transaksi = $trxId;
            $sales->id_produk = $productId;
            $sales->jumlah_terjual = $qty;
            $sales->save();
        }

        Session::flash('success', 'Data transaksi berhasil ditambahkan');
        return redirect()->back();
    }

    public function upload_csv(Request $req)
    {
        $file = $req->file('csv');
        $tujuan_upload = 'csv';
	    $file->move($tujuan_upload,$file->getClientOriginalName());

        $content = file_get_contents(public_path($tujuan_upload.'/'.$file->getClientOriginalName()));

        $transactions = explode("\n", $content);
        foreach($transactions as $transaction) {
            $value = explode(',', $transaction);

            $findTrxId = Transaction::where('kode_transaksi', $value[0])->first();
            if($findTrxId == null) {
                $trx = new Transaction();
                $trx->kode_transaksi = $value[0];
                $trx->tanggal_transaksi = $value[1];
                $trx->save();
                $this->trxId = $trx->id;
            } else {
                $this->trxId = $findTrxId->id_transaksi;
            }

            $productName = '';
            if($value[3] != '') {
                $productName = $value[2].' '. $value[3]; 
            } else {
                $productName = $value[2];
            }

            $productId = 0;
            $findProductId = Product::where('nama_produk', $productName)->first();
            
            if($findProductId == null) {
                $product = new Product();
                $product->nama_produk = $productName;
                $product->stok_produk = rand(10, 100);
                $product->harga_produk = $value[4];
                $product->save();
                $this->productId = $product->id;
            } else {
                $this->productId = $findProductId->id_produk;
            }

            $sales = new Sales();
            $sales->id_transaksi = $this->trxId;
            $sales->id_produk = $this->productId;
            $sales->jumlah_terjual = $value[5];
            $sales->save();
        }

        Session::flash('success', 'Data transaksi berhasil ditambahkan');
        return redirect()->back();
    }
}