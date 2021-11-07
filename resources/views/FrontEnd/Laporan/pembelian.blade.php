@extends('FrontEnd.Layout.index')
@section('head')
    <title>Laporan</title>
@endsection
@section('body')
    <div class="container">
        <a href="{{ route('prefix.laporan.show',["laporan"=>"pembeliancetak"]) }}" class="btn btn-success" href="">
            <h5>Cetak Laporan</h5>
        </a>
        <h5 style="margin-top: 2%;">Laporan Pembelian <i class="fa fa-clock-rotate-left"></i> </h5>
        <table id="tables" class="table table-striped table-bordered" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    {{-- <th>Supplier</th> --}}
                    <th>Tanggal Beli</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item => $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->qty }}</td>
                        <td>{{ $value->unit }}</td>
                        {{-- <td>{{ $value->supplier->name }}</td> --}}
                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y H:m') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
