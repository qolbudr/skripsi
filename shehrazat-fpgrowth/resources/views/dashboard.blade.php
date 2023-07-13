@extends('master')

@section('page-section', 'Dashboard')

@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/css/datatables.bootstrap5.css') }}">
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-5">
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="avatar flex-shrink-0 mb-3">
                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-box"></i></span>
                    </div>
                    <span class="fw-semibold d-block mb-1">Jumlah Produk</span>
                    <h3 class="card-title mb-2">{{ $total_product }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="avatar flex-shrink-0 mb-3">
                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-wallet"></i></span>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Penjualan</span>
                    <h3 class="card-title mb-2">{{ $total_sales }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="avatar flex-shrink-0 mb-3">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-chart"></i></span>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Pendapatan</span>
                    <h3 class="card-title mb-2">{{ number_format($total_revenue, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Produk Paling Laku</h5>
                <div class="card-datatable table-responsive text-nowrap">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Terjual</th>
                                <th>Sisa Stok</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($most as $k => $trx)
                            <tr>
                                <td>{{ $k + 1 }}</td>
                                <td style="text-overflow:ellipsis; overflow: hidden; max-width:40vw;"
                                    data-bs-toggle="tooltip" data-bs-offset="0,0" data-bs-placement="bottom"
                                    title="{{ $trx->nama_produk }}">{{ $trx->nama_produk }}</td>
                                <td>{{ $trx->total_terjual }}</td>
                                <td>{{ $trx->stok_produk }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-js')
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
<script src="{{ asset('assets/js/datatables-bootstrap5.js') }}"></script>
<script>
$(document).ready(function() {
    $('.datatable').DataTable();
});
</script>
@endsection

@endsection