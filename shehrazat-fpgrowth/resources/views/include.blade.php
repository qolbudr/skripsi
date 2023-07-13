@extends('master')

@section('page-section', 'Transaksi')

@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/css/datatables.bootstrap5.css') }}">
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Transaksi</h4>
    <div class="card">
        <div class="d-flex justify-content-between align-items-center p-3">
            <h5 class="card-header p-0">Data Transaksi</h5>
            <div class="dropdown">
                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#import-csv">Import CSV</a>
                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#add-transaction">Tambah Transaksi</a>
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive text-nowrap">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Produk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction as $k => $item)
                    <tr>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->kode_transaksi }}</td>
                        <td>{{ $item->item }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection