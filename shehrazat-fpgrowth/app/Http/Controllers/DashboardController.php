<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $transaction = new Transaction();
        $data['total_product'] = Product::count();
        $data['total_sales'] = Transaction::count();
        $data['total_revenue'] = $transaction->total_revenue();
        $data['most'] = $transaction->most();
        return view('dashboard', $data);
    }
}