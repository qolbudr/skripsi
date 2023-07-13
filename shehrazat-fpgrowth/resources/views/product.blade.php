@extends('master')

@section('page-section', 'Produk')

@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/css/datatables.bootstrap5.css') }}">
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Produk</h4>
    <div class="card">
        <div class="d-flex justify-content-between align-items-center p-3">
            <h5 class="card-header p-0">Data Produk</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-product">Tambah Produk</button>
        </div>
        <div class="card-datatable table-responsive text-nowrap">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $k => $item)
                    <tr>
                        <td>{{ $k + 1 }}</td>
                        <td style="text-overflow:ellipsis; overflow: hidden; max-width:1px;" data-bs-toggle="tooltip"
                            data-bs-offset="0,0" data-bs-placement="bottom" title="{{ $item->nama_produk }}">
                            {{ $item->nama_produk }}</td>
                        <td>{{ $item->stok_produk }}</td>
                        <td>{{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#edit-product"
                                data-id="{{ $item->id_produk }}" class="btn btn-info btn-sm me-1 btn-edit-product">
                                <i class="bx bx-edit"></i> Edit
                            </button>
                            <a href="{{ URL::to('products/delete/'.$item->id_produk) }}" class="btn btn-danger btn-sm">
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
<div class="modal fade" id="add-product" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
            </div>
            <form action="{{ URL::to('products/add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Masukkan nama produk" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" name="stock" id="stock" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col mb-0">
                            <label for="price" class="form-label">Harga Produk</label>
                            <input type="number" id="price" name="price" class="form-control" placeholder="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit-product" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Produk</h5>
            </div>
            <form action="{{ URL::to('products/update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <input type="hidden" name="id">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Masukkan nama produk" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" name="stock" id="stock" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col mb-0">
                            <label for="price" class="form-label">Harga Produk</label>
                            <input type="number" id="price" name="price" class="form-control" placeholder="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('page-js')
<script src="{{ asset('assets/js/datatables-bootstrap5.js') }}"></script>
<script>
$(document).ready(function() {
    $('.datatable').DataTable();

    $('.datatable tbody').on('click', 'td .btn-edit-product', function() {
        const id = $(this).attr('data-id')
        $.ajax({
            url: "{{ URL::to('products/view') }}" + '/' + id,
            method: 'GET',
            success: function(data) {
                $('#edit-product [name=id]').val(data.id_produk)
                $('#edit-product [name=name]').val(data.nama_produk)
                $('#edit-product [name=stock]').val(data.stok_produk)
                $('#edit-product [name=price]').val(data.harga_produk)
            }
        })
    })
});
</script>
@endsection

@endsection