@extends('FrontEnd.Layout.index')
@section('head')
    <title>Products</title>
@endsection
@section('body')
    <div class="container">
        <a style="margin-bottom: 2%" class="btn btn-danger" href="{{ route('prefix.outlet.index') }}">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>
        <h4 style="margin-bottom: 2%" c>Buat Outlet</h4>
        <form id="fileUploadForm" action="{{ route('prefix.outlet.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Nama Outlet</label>
            <input placeholder="Indomaret Tegal" required type="text" name="name" class="form-control"
                value="{{ old('name') }}">
            <br>
            <label for="address">Alamat Outlet</label>
            <textarea placeholder="alamat ini jln ini" required name="address" class="form-control">{{old('address')}}</textarea>
             <br>
             <input class="btn btn-success form-control" type="submit" value="Simpan">
        </form>
    </div>

@endsection
