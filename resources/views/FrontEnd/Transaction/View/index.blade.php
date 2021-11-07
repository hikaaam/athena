@extends('FrontEnd.Layout.index')
@section('head')
    <title>Lihat Transaksi</title>
    <style>
        #tables_paginate,
        .dataTables_info {
            display: none;
        }

    </style>
@endsection
@section('body')
    <div class="container">
        <a href="{{ route('prefix.newtransaction.index') }}" class="btn btn-success" href="">
            <h5>Buat transaksi <i class="fa fa-plus"></i> </h5>
        </a>
        <h5 style="margin-top: 2%;">History Transaksi <i class="fa fa-clock-rotate-left"></i> </h5>
        <table id="tables" class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <td scope="col">Nomor Transaksi</td>
                    <td scope="col">Nama Pembeli</td>
                    <td scope="col">Tanggal Transaksi</td>
                    <td scope="col">Nama Outlet</td>
                    <td scope="col">Detail</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction as $item => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->buyer_name }}</td>
                        <td>{{ date_format($value->created_at,"d-M-Y h:m") }}</td>
                        <td>{{ $value->outlet->name }}</td>
                        <td><a class="btn btn-success" href="{{ route('trxdetail', ['id'=>$value->id]) }}">Lihat</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex flex-row justify-content-end">
            {{ $transaction->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
