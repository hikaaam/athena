@extends('FrontEnd.Layout.index')
@section('head')
    <title>Beli Barang</title>
    <style>
          #tables_paginate,
        .dataTables_info {
            display: none;
        }
    </style>
@endsection
@section('body')
    <div class="container">
        <h4 style="border-bottom: 1px solid var(--gray);">Tambah Pembelian<i class="fa fa-cart"></i></h4>
        <form action="{{ url('transmasuk') }}" method="post">
            @csrf
            <label for="name">Nama Barang</label>
            <input required type="text" name="name" placeholder="Gula" class="form-control">
            <br>

            <label for="price">Harga Barang</label>
            <input required type="number" name="price" placeholder="100000" class="form-control">
            <br>

            <label for="qty">Jumlah</label>
            <input required type="number" name="qty" placeholder="20" class="form-control">
            <br>

            <label for="unit">Satuan</label>
            <select name="unit" class="form-control">
                <option value="Kg">Kg</option>
                <option value="Gr">Gr</option>
                <option value="Buah">Buah</option>
            </select>
            <br>

            @if (count($supplier) > 0)
                <label for="supplier_id">Supplier</label>
                <select required name="supplier_id" class="form-control">
                    @foreach ($supplier as $item => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
                <br>
                <input type="submit" class="btn btn-success" value="Buat Transaksi">
            @else
                <p>Anda Belum Membuat Supplier, silahkan buat paling tidak satu Supplier</p>
                <a href="{{ route('prefix.supplier.create') }}" class="btn btn-success">Buat Supplier</a>
            @endif
        </form>

        <h4 style="border-bottom: 1px solid var(--gray);margin-top: 1em;">Transaksi History<i
                class="fa fa-cart"></i></h4>
        <table id="tables" class="table table-striped table-bordered" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Supplier</th>
                    <th>Tanggal Beli</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction as $item => $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->qty }}</td>
                        <td>{{ $value->unit }}</td>
                        <td>{{ $value->supplier->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y H:m') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex flex-row justify-content-end">
            {{ $transaction->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
