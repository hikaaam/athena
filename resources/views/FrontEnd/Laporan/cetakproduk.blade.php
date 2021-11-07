@extends('FrontEnd.Layout.index')
@section('head')
    <title>Laporan</title>
@endsection
@section('body')
    <div class="container">
        <a href="{{ route('cetakproduk', ['id' => $data[0]->product_id]) }}" class="btn btn-success" href="">
            <h5>Cetak Laporan</h5>
        </a>
        <h5 style="margin-top: 2%;">Laporan Transaksi <i class="fa fa-clock-rotate-left"></i> </h5>
        <table id="tables" class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <td scope="col">Nomor Transaksi</td>
                    <td scope="col">Nama Produk</td>
                    <td scope="col">id_transaksi</td>
                    <td scope="col">price</td>
                    <td scope="col">qty</td>
                    <td scope="col">dibuat</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->product->name }}</td>
                        <td>{{ $value->transaction_id }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->qty }}</td>
                        <td>{{ date_format($value->created_at, 'd-M-Y h:m') }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
