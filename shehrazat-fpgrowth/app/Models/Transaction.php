<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transaction";
    protected $hidden = ['created_at', 'updated_at'];

    public function total_revenue()
    {
        $transaction = Transaction::join('sales', 'transaction.id_transaksi', '=', 'sales.id_transaksi')
                        ->join('product', 'sales.id_produk', '=', 'product.id_produk')->get();

        $data = 0;
        
        foreach($transaction as $trx) {
            $data += $trx->harga_produk * $trx->jumlah_terjual;
        }

        return $data;
    }

    public function transaction()
    {
        $data = Transaction::join('sales', 'transaction.id_transaksi', '=', 'sales.id_transaksi')
                        ->join('product', 'sales.id_produk', '=', 'product.id_produk')
                        ->groupBy('sales.id_transaksi')
                        ->orderBy('tanggal_transaksi', 'ASC')
                        ->get();
        return $data;
    }

    public function most()
    {
        $data = Transaction::selectRaw('SUM(sales.jumlah_terjual) as total_terjual, product.nama_produk, product.stok_produk')
                            ->join('sales', 'transaction.id_transaksi', '=', 'sales.id_transaksi')
                            ->join('product', 'sales.id_produk', '=', 'product.id_produk')
                            ->groupBy('product.id_produk')
                            ->orderBy('total_terjual', 'DESC')
                            ->limit(10)
                            ->get();
        return $data;
    }

    public function count_support($start_date, $end_date, $min_support)
    {
        $data = \DB::table('item_to_analyze')
                    ->selectRaw('COUNT(id_produk) as frequent, id_produk, nama_produk')
                    ->whereBetween('tanggal_transaksi', [$start_date, $end_date])
                    ->groupBy('id_produk')
                    ->get();
        
        $trx = \DB::table('item_to_analyze')->whereBetween('tanggal_transaksi', [$start_date, $end_date])->groupBy('kode_transaksi')->get();
                            
        $return_data = [];
        
        foreach($data as $k => $item)
        {
            $data[$k]->support = $item->frequent / count($trx) * 100;
            if($data[$k]->support >= $min_support)
            {
                array_push($return_data, $data[$k]);
            }
        }
        
        return $return_data;
    }

    public function get_product_in_transaction($id)
    {
        $data = \DB::table('transaction')
                    ->join('sales', 'sales.id_transaksi', '=', 'transaction.id_transaksi')
                    ->join('product', 'product.id_produk', '=', 'sales.id_produk')
                    ->where('sales.id_transaksi', $id)->get();
        return $data;
    }

    public function get_item_to_analyze($start_date, $end_date)
    {

        $data = \DB::table('item_to_analyze')->selectRaw("GROUP_CONCAT(id_produk SEPARATOR ',') as item, COUNT(id_transaksi) as item_in_transaction")->whereBetween('tanggal_transaksi', [$start_date, $end_date])->groupBy('id_transaksi')->get();
                        
        $return_data = '';

        foreach($data as $k => $item) {
            if($item->item_in_transaction > 1) {
                if($k == count($data)) {
                    $return_data .= "{" . $item->item . "}";
                } else {
                    $return_data .= "{" . $item->item . "}\n";
                }
            }
        }

        return $return_data;
    }

    public function get_include($attecedent, $consequent) {
        $data = [];
        $result = \DB::table('item_to_analyze')->selectRaw("GROUP_CONCAT(nama_produk SEPARATOR ',') as item, tanggal_transaksi as date, kode_transaksi")->groupBy('id_transaksi')->get();
        foreach($result as $item) {
            $parsedItem = explode(',', $item->item);
            if(in_array($attecedent, $parsedItem) && in_array($consequent, $parsedItem)) {
                foreach($parsedItem as $k => $parsed) {
                    $obj = new \stdClass;
                    if($k == 0) {
                        $obj->item = $parsed;
                        $obj->date = $item->date;
                        $obj->kode_transaksi = $item->kode_transaksi;
                    } else {
                        $obj->item = $parsed;
                        $obj->date = '';
                        $obj->kode_transaksi = '';
                    }

                    $data[] = $obj;
                }
            }
        }   

        return $data;
    }
}