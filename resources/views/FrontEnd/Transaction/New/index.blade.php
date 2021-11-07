@extends('FrontEnd.Layout.index')
@section('head')
    <title>Transaksi Baru</title>
@endsection
@section('body')
    <div class="container">
        <h2 style="border-bottom: 1px solid var(--gray);">Transaksi Nomor ({{ $cart[0]->id }})</h2>
        <p>Pilih product dan masukan ke dalam cart</p>
        <p>Nama Pembeli : {{ $cart[0]->buyer_name }}</p>
        <p>Outlet : {{ $cart[0]->outlet->name }}</p>
        @if (count($cart) > 0)
            <h4 style="border-bottom: 1px solid var(--gray);">Cart <i class="fa fa-cart"></i></h4>
            <table class="table" style="border-bottom: 1px solid var(--dark);">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga Produk</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($cart[0]->details as $item => $value)
                        <tr>
                            <td>{{ $value->product->name }}</td>
                            <td>{{ $value->price }}</td>
                            <td>{{ $value->qty }}</td>
                            <td>{{ $value->qty * $value->price }}</td>
                            <td>
                                <a class="btn btn-danger" href="{{ url('newtransactionmin', [$value->id]) }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
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
                        <td></td>
                    </tr>
                </tbody>
            </table>
        @endif
        <div class="d-flex flex-row justify-content-end">
            <a href="{{ url('newtransactionremove', [$cart[0]->id]) }}" id="white" style="margin-right: 1em;" class="btn btn-danger">Batalkan / Hapus</a>
            <a href="{{ url('newtransactionaccept', [$cart[0]->id]) }}" id="white" class="btn btn-success">Bayar Pesanaan</a>
        </div>
        <h4 style="border-bottom: 1px solid var(--gray);">Produk {{ $cart[0]->outlet->name }} <i
                class="fa fa-cart"></i>
        </h4>
        <table id="tables" class="table table-striped table-bordered" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Image</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item => $value)
                    <tr>
                        <form action="{{ url('newtransactionadd') }}" method="POST">
                            @csrf
                            <input name="product_id" type="hidden" value="{{ $value->id }}">
                            <input name="price" type="hidden" value="{{ $value->price }}">
                            <input name="transaction_id" type="hidden" value="{{ $cart[0]->id }}">
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->price }}</td>
                            <td>
                                <img src="{{ asset('images/'.$value->image) }}" width="100" alt="image">
                            </td>
                            <td><input name="qty" required class="form-control" type="number"></td>
                            <td><input class="btn btn-success" type="submit" value="simpan"></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
