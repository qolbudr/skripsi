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
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction as $k => $item)
                    <tr>
                        <td>{{ $k + 1 }}</td>
                        <td>{{ $item->tanggal_transaksi }}</td>
                        <td>{{ $item->kode_transaksi }}</td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#view-transaction"
                                data-id="{{ $item->id_transaksi }}"
                                class="btn btn-primary btn-sm me-1 btn-view-transaction">
                                <i class="bx bx-info-circle"></i> Detail
                            </button>
                            <a href="{{ URL::to('transaction/delete/'.$item->id_transaksi) }}"
                                class="btn btn-danger btn-sm">
                                <i class="bx bx-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="view-transaction" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Transaksi</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="kode" class="form-label">Kode Transaksi</label>
                        <input type="text" name="kode" id="kode" class="form-control" disabled>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-12 mb-0 text-nowrap">
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>ID Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="import-csv" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import CSV</h5>
            </div>
            <form action="{{ URL::to('transaction/upload-csv') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-sm alert-primary" role="alert">Import data csv dari laporan
                                transaksi
                                anda untuk
                                menambah banyak data sekaligus <a href="{{ asset('template-csv.csv') }}"><u>Template
                                        csv</u></a></div>
                        </div>
                        <div class="col-12">
                            <label for="formFile" class="form-label">Upload CSV</label>
                            <input class="form-control" type="file" name="csv" id="formFile" accept=".csv" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-transaction" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi</h5>
            </div>
            <form action="{{ URL::to('transaction/add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="tanggel" class="form-label">Tanggal Transaksi</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                            <input type="hidden" name="count" value="1">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="kode" class="form-label">Kode Transaksi</label>
                            <input type="text" name="kode" id="kode" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-12 mb-4 mb-md-0">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <label class="form-label">Data Produk</label>
                                <button class="btn btn-sm btn-outline-primary btn-add-product">Tambah
                                    Produk</button>
                            </div>
                            <div class="accordion" id="product-accordion">
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#product-accordion-1" aria-expanded="true"
                                            aria-controls="product-accordion-1">
                                            Produk 1
                                        </button>
                                    </h2>

                                    <div id="product-accordion-1" class="accordion-collapse collapse show"
                                        data-bs-parent="#product-accordion">
                                        <div class="accordion-body">
                                            <div class="position-relative">
                                                <div class="row">
                                                    <div class="col-12 col-md-8 mb-3">
                                                        <label class="form-label">Produk</label>
                                                        <select name="id_produk-1" class="select2-add form-select"
                                                            required>
                                                            @foreach($product as $p)
                                                            <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-3">
                                                        <label class="form-label">Jumlah Terjual</label>
                                                        <input type="number" name="jumlah_terjual-1"
                                                            class="form-control" placeholder="0" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('page-js')
<script src="{{ asset('assets/js/datatables-bootstrap5.js') }}"></script>
<script>
$(document).ready(async function() {
    await $('.datatable').DataTable();
    await $('.select2-add').select2({
        dropdownParent: "#add-transaction"
    });


    var count = parseInt($("#add-transaction [name=count]").val())

    $('.btn-add-product').click(function(e) {
        count++
        e.preventDefault();
        $("#add-transaction [name=count]").val(count);
        $("#add-transaction #product-accordion").append(
            `
            <div class="card accordion-item">
                <h2 class="accordion-header">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#product-accordion-${count}" aria-expanded="true"
                        aria-controls="product-accordion-${count}">
                        Produk ${count}
                    </button>
                </h2>

                <div id="product-accordion-${count}" class="accordion-collapse collapse"
                    data-bs-parent="#product-accordion">
                    <div class="accordion-body">
                        <div class="position-relative">
                            <div class="row">
                                <div class="col-12 col-md-8 mb-3">
                                    <label class="form-label">Produk</label>
                                    <select name="id_produk-${count}" class="select2-add form-select"
                                        required>
                                        @foreach($product as $p)
                                        <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label class="form-label">Jumlah Terjual</label>
                                    <input type="number" name="jumlah_terjual-${count}" class="form-control"
                                        placeholder="0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `
        )
        $('.select2-add').select2({
            dropdownParent: "#add-transaction"
        });
    })

    $('.datatable tbody').on('click', 'td .btn-view-transaction', function() {
        const id = $(this).attr('data-id')
        $.ajax({
            method: "GET",
            url: "{{ URL::to('transaction/product') }}" + "/" + id,
            success: function(data) {
                $("#view-transaction [name=kode]").val(data[0].kode_transaksi)
                let row = '';
                data.forEach(function(item) {
                    row += `
                        <tr>
                        <td>${item.id_produk}</td>
                        <td style="text-overflow:ellipsis; overflow: hidden; max-width:1px;" data-bs-toggle="tooltip"
                            data-bs-offset="0,0" data-bs-placement="bottom" title="${item.nama_produk}">${item.nama_produk}</td>
                        <td>${numberWithCommas(item.harga_produk)}</td>
                        <td>${item.jumlah_terjual}</td>
                        </tr>
                    `
                })
                $("#view-transaction table tbody").html(row);
                const tooltipTriggerList = [].slice.call(document.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        })
    })
});
</script>
@endsection

@endsection