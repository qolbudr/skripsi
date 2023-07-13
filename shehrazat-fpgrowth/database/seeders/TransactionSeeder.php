<?php

namespace Database\Seeders;
use App\Models\Transaction;
use App\Models\Sales;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Storage;

class TransactionSeeder extends Seeder
{
    public $trxId = 0;
    public $productId = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     Transaction::truncate();
    //     Sales::truncate();
    //     $item = Storage::get('transaction.csv');

    //     $transactions = explode("\n", $item);
    //     foreach($transactions as $trx)
    //     {
    //         $value = explode(",", $trx);
    //         $date = explode("/", $value[0]);
    //         if(strlen($date[0]) == 1)
    //         {
    //             $date[0] = "0".$date[0];
    //         }

    //         if(strlen($date[1]) == 1)
    //         {
    //             $date[1] = "0".$date[1];
    //         }
    //         $transaction = new Transaction();
    //         $transaction->kode_transaksi = $value[1];
    //         $transaction->tanggal_transaksi = new Carbon("20".$date[2].'-'.$date[0].'-'.$date[1]);
    //         $transaction->save();
            
    //         $transaction_id = $transaction->id;
            
    //         $id_product = explode('|', $value[2]);
    //         $qty_product = explode('|', $value[3]);

    //         foreach($id_product as $k => $id)
    //         {
    //             $sales = new Sales();
    //             $sales->id_transaksi = $transaction_id;
    //             $sales->id_produk = $id;
    //             $sales->jumlah_terjual = $qty_product[$k];
    //             $sales->save();
    //         }
    //     }
    // }

    public function run()
    {
        Transaction::truncate();
        Sales::truncate();
        Product::truncate();
        
        $data = Storage::get('order feb-mar.csv');
        $transactions = explode("\n", $data);
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
    }
}