<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     Product::truncate();
    //     $item = Storage::get('product.csv');

    //     $products = explode("\n", $item);
    //     foreach($products as $data)
    //     {
    //         $value = explode(",", $data);
    //         $product = new Product();
    //         if($value[1] != '') 
    //         {
    //             $product->nama_produk = $value[0].' '.$value[1];
    //         } else {
    //             $product->nama_produk = $value[0];
    //         }
    //         $product->harga_produk = $value[2];
    //         $product->stok_produk = rand(0, 100);
    //         $product->save(); 
    //     } 
    // }

    public function run()
    {
        
    }
}