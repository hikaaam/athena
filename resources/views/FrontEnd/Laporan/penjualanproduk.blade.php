@extends('FrontEnd.Layout.index')
@section('head')
    <title>Laporan</title>
@endsection
@section('body')
<div class="container">
    <h5 style="margin-top: 2%;">Produk <i class="fa fa-box"></i> </h5>
    <table id="tables" class="table table-hover">
        <thead class="table-dark">
            <tr>
                <td scope="col">Nama Produk</td>
                <td scope="col">Gambar</td>
                <td scope="col">Nama Outlet</td>
                <td scope="col">Tanggal Dibuat</td>
                <td scope="col">Detail</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item => $value)
                <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->image }}</td>
                    <td>{{ $value->outlet->name }}</td>
                    <td>{{ date_format($value->created_at, 'd-M-Y h:m') }}</td>
                    <td><a class="btn btn-success"
                            href="{{ route('prefix.laporan.edit', ['laporan' => $value->id]) }}">Lihat Laporan</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection