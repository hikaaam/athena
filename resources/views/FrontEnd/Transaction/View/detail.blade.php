@extends('FrontEnd.Layout.index')
@section('head')
    <title>Detail Transaksi</title>
@endsection
@section('body')
    <div class="container">

        <a style="margin-bottom: 2%" class="btn btn-danger" href="{{url()->previous()}}">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>

        <h4 style="border-bottom: 1px solid var(--gray);">Detail Transaksi Nomor ({{ $head->id }})</h4>
        <p>Pilih product dan masukan ke dalam cart</p>
        <p>Nama Pembeli : {{ $head->buyer_name }}</p>
        <p>Outlet : {{ $head->outlet->name }}</p>
        <p>Status Transaksi : <i style="color:{{$head->status=='1'?'green':'red'}}">{{$head->status == "1" ? "Selesai":"Belum Selesai"}}</i></p>
        <h4 style="border-bottom: 1px solid var(--gray);">Detail <i class="fa fa-cart"></i></h4>
        <table class="table" style="border-bottom: 1px solid var(--dark);">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga Produk</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($transaction as $item => $value)
                    <tr>
                        <td>{{ $value->product->name }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->qty }}</td>
                        <td>{{ $value->qty * $value->price }}</td>
                    </tr>
                    @php
                        $total += $value->qty * $value->price;
                    @endphp
                @endforeach
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td>{{ $total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
