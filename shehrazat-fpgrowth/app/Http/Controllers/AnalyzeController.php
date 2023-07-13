<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AnalyzeController extends Controller
{
    public function index()
    {
        return view('analyze');
    }

    public function count_support()
    {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $min_support = $_GET['min_support'];
        $transaction = new Transaction();
        $data = $transaction->count_support($start_date, $end_date, $min_support);
        return response()->json($data);
    }

    public function get_item_to_analyze()
    {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $transaction = new Transaction();
        $data = $transaction->get_item_to_analyze($start_date, $end_date);
        return response()->json($data);
    }

    public function get_include()
    {
        $consequent = $_GET['consequent'];
        $attecedent = $_GET['attecedent'];

        $transaction = new Transaction();
        $data['transaction'] = $transaction->get_include($attecedent, $consequent);
        return view('include', $data);
    }
}