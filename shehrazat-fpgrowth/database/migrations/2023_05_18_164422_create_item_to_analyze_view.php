<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemToAnalyzeView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("CREATE VIEW item_to_analyze AS SELECT t.`kode_transaksi`, t.tanggal_transaksi, s.id_penjualan, s.id_transaksi, s.jumlah_terjual, product.* FROM `transaction` t inner join `sales` s on t.id_transaksi = s.id_transaksi left join product on product.id_produk = s.id_produk WHERE (select count(transaction.id_transaksi) from transaction inner join `sales` on transaction.id_transaksi = sales.id_transaksi where transaction.id_transaksi = s.id_transaksi GROUP by transaction.kode_transaksi) > 1");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("DROP VIEW item_to_analyze");
    }
}