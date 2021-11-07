@extends('FrontEnd.Layout.index')
@section('head')
    <style>
        #rekomendasi {
            padding-top: 1%;
            margin-bottom: 1%;
        }

        #rekomendasi h2 {
            margin-bottom: 1%;
        }

    </style>
@endsection
@section('body')
    <View id="#rekomendasi">
        <h2 style="text-align: center">Selamat Datang</h2>
        <p style="text-align: center">Tinggalkan cara tradisional dan beralih ke majoo, dengan harga terjangkau untuk
            bisnismu semakin maju</p>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <img class="card-img-top"
                            src="{{ asset('images/paket-advance.png') }}"
                            alt="Card image cap">

                        <div class="card-body">
                            <h5 class="card-title">Produk</h5>
                            <p class="card-text">Jumlah Produk</p>
                            <p style="text-align: center" class="card-text">{{ $products }}</p>
                        </div>
                        <a href="{{ route('prefix.product.index') }}" class="btn btn-success">Lihat Products</a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <img class="card-img-top"
                            src="{{ asset('images/paket-desktop.png') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Outlet</h5>
                            <p class="card-text">Jumlah Outlet</p>
                            <p style="text-align: center" class="card-text">{{ $outlets }}</p>
                        </div>
                        <a href="{{ route('prefix.outlet.index') }}" class="btn btn-success">Lihat Outlets</a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <img class="card-img-top"
                            src="{{ asset('images/paket-lifestyle.png') }}"
                            alt="Card image cap">

                        <div class="card-body">
                            <h5 class="card-title">Transaksi</h5>
                            <p class="card-text">Jumlah Transaksi</p>
                            <p style="text-align: center" class="card-text">{{ $transactions }}</p>
                        </div>
                        <a href="{{ route('trxget') }}" class="btn btn-success">Lihat Transaksi</a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <img class="card-img-top"
                            src="{{ asset('images/standard_repo.png') }}"
                            alt="Card image cap">

                        <div class="card-body">
                            <h5 class="card-title">Pembelian</h5>
                            <p class="card-text">Jumlah Beli</p>
                            <p style="text-align: center" class="card-text">{{ $spends }}</p>
                        </div>
                        <a href="{{ route('prefix.transmasuk.index') }}" class="btn btn-success">Lihat Pembelian</a>
                    </div>
                </div>
            </div>
        </div>
    </View>

@endsection
