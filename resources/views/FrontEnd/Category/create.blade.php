@extends('FrontEnd.Layout.index')
@section('head')
    <title>Products</title>
@endsection
@section('body')
    <div class="container">
        <a style="margin-bottom: 2%" class="btn btn-danger" href="{{ route('prefix.category.index') }}">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>
        <h4 style="margin-bottom: 2%" c>Buat Supplier</h4>
        <form id="fileUploadForm" action="{{ route('prefix.category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Nama Kategori</label>
            <input placeholder="Makanan" required type="text" name="name" class="form-control"
                value="{{ old('name') }}">
            <br>
            <label for="phone">Deskripsi</label>
            <textarea placeholder="adalah sebuah lorem ipsum" required name="desc" class="form-control">{{old('desc')}}</textarea>
             <br>
             <input class="btn btn-success form-control" type="submit" value="Simpan">
        </form>
    </div>

@endsection
