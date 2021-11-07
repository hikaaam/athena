@extends('FrontEnd.Layout.index')
@section('head')
    <title>Laporan</title>
@endsection
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <img class="card-img-top"
                        src="{{ asset('images/paket-desktop.png') }}"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Penjualan</h5>
                    </div>
                    <a class="btn btn-dark" href="{{ route('prefix.laporan.show',["laporan"=>"penjualan"]) }}" class="btn btn-success">Lihat Laporan</a>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <img class="card-img-top"
                        src="{{ asset('images/paket-desktop.png') }}"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Penjualan Produk</h5>
                    </div>
                    <a class="btn btn-dark" href="{{ route('prefix.laporan.show',["laporan"=>"penjualanproduk"]) }}" class="btn btn-success">Lihat Laporan</a>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <img class="card-img-top"
                        src="{{ asset('images/paket-desktop.png') }}"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Pembelian</h5>
                    </div>
                    <a class="btn btn-dark" href="{{ route('prefix.laporan.show',["laporan"=>"pembelian"]) }}" class="btn btn-success">Lihat Laporan</a>
                </div>
            </div>
        </div>
    </div>
@endsection
