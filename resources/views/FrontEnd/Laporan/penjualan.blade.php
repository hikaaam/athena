@extends('FrontEnd.Layout.index')
@section('head')
    <title>Laporan</title>
@endsection
@section('body')
    <div class="container">
        <a href="{{ route('prefix.laporan.show',["laporan"=>"penjualancetak"]) }}" class="btn btn-success" href="">
            <h5>Cetak Laporan</h5>
        </a>
        <h5 style="margin-top: 2%;">Laporan Transaksi <i class="fa fa-clock-rotate-left"></i> </h5>
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
                @foreach ($data as $item => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->buyer_name }}</td>
                        <td>{{ date_format($value->created_at, 'd-M-Y h:m') }}</td>
                        <td>{{ $value->outlet->name }}</td>
                        <td><a class="btn btn-success" href="{{ route('trxdetail', ['id' => $value->id]) }}">Lihat</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
