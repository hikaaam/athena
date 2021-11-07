@extends('FrontEnd.Layout.index')
@section('head')
    <title>Products</title>
@endsection
@section('body')
    <div class="container">
        <a style="margin-bottom: 2%" class="btn btn-danger" href="{{ route('prefix.supplier.index') }}">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>
        <h4 style="margin-bottom: 2%" c>Buat Supplier</h4>
        <form id="fileUploadForm" action="{{ route('prefix.supplier.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Nama Supplier</label>
            <input placeholder="Gudang Garam" required type="text" name="name" class="form-control"
                value="{{ old('name') }}">
            <br>
            <label for="phone">Nomor HP Supplier</label>
            <input placeholder="082112341234" value="{{old('phone')}}" type="number" required name="phone" class="form-control">
             <br>
             <input class="btn btn-success form-control" type="submit" value="Simpan">
        </form>
    </div>

@endsection
