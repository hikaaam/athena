@extends('FrontEnd.Layout.index')
@section('head')
    <title>Category</title>
@endsection
@section('body')
    <div class="container">
        <a style="margin-bottom: 2%" class="btn btn-danger" href="{{ route('prefix.category.index') }}">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>
        <h4 style="margin-bottom: 2%" c>Update Kategori</h4>
        <form id="fileUploadForm" action="{{ route('prefix.category.update',['category'=>$data->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <label for="name">Nama Kategori</label>
            <input placeholder="Makanan" required type="text" name="name" class="form-control"
                value="{{ old('name') ?? $data->name }}">
            <br>
            <label for="desc">Deskripsi</label>
            <textarea placeholder="adalaha sebuah lorem ipsum" required name="desc" class="form-control">{{old('desc') ?? $data->desc}} </textarea>
             <br>
             <input class="btn btn-success form-control" type="submit" value="Simpan">
        </form>
    </div>

@endsection
