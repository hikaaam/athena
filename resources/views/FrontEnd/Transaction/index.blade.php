@extends('FrontEnd.Layout.index')
@section('head')
    <title>Buat Transaksi</title>
@endsection
@section('body')
    <div class="container">
        <h2 style="border-bottom: 1px solid var(--gray);">Transaksi Baru</h2>
        <p>Isi Form untuk membuat transaksi baru, atau klik lanjutkan pada table untuk melanjutkan transaksi yang belum
            selesai</p>
        <h4 style="border-bottom: 1px solid var(--gray);">Buat Baru <i class="fa fa-cart"></i></h4>
        <form action="{{ url('newtransaction') }}" method="post">
            @csrf
            <label for="buyer_name">Nama Pembeli</label>
            <input required type="text" name="buyer_name" placeholder="Budi" class="form-control">
            <br>
            @if(count($outlets)>0)
            <label for="outlet_id">Outlet</label>
            <select required name="outlet_id" class="form-control">
                @foreach ($outlets as $item => $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
            <br>
            <input type="submit" class="btn btn-success" value="Buat Transaksi">
            @else
                <p>Anda Belum Membuat Outlet, silahkan buat paling tidak satu outlet</p>
                <a href="{{ route('prefix.outlet.create') }}" class="btn btn-success">Buat Outlet</a>
            @endif
        </form>

        <h4 style="border-bottom: 1px solid var(--gray);margin-top: 1em;">Transaksi Sedang diproses <i
                class="fa fa-cart"></i></h4>
        <table id="tables" class="table table-striped table-bordered" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>id transaksi</th>
                    <th>Nama Pembeli</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction as $item => $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{ $value->buyer_name }}</td>
                        <td>{{ $value->status == 0 ? 'Belum Selesai' : 'Selesai' }}</td>
                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y H:m') }}</td>
                        <td><a class="btn btn-success" href="{{ url('/newtransaction', [$value->id]) }}">Lanjutkan</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
