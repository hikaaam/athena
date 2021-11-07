@extends('FrontEnd.Layout.index')
@section('head')
    <title>Products</title>
@endsection
@section('body')
    <div class="container">
        <a style="margin-bottom: 2%" class="btn btn-danger" href="{{ route('prefix.product.index') }}">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>
        <h4 style="margin-bottom: 2%" c>Buat Produk</h4>
        <form id="fileUploadForm" action="{{route('prefix.product.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Nama produk</label>
            <input placeholder="kopi susu" required type="text" name="name" class="form-control" value="{{old('name')}}">
            <br>
            <label for="price">Harga Produk</label>
            <input placeholder="5000" required type="number" name="price" class="form-control" value="{{old('price')}}">
            <br>
            <label for="category_id">Kategori</label>
            <select required name="category_id" class="form-control">
                @foreach ($category as $item => $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
            <br>
            <label for="outlet_id">Outlet</label>
            <select required name="outlet_id" class="form-control">
                @foreach ($outlet as $item => $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
            <br>
            <label for="image">Gambar Produk</label>
            <input type="file" name="image" class="form-control" value="{{old('image')}}">
            <br>
            <label for="desc">Deskripsi Produk</label>
            <textarea class="ckeditor form-control" name="desc" id="" cols="30" rows="10">{{old('desc')}}</textarea>
            <br>
            <input type="submit" value="simpan" class="btn btn-success form-control">
            <br>
            <br>
            <div class="form-group">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(function () {
            $(document).ready(function () {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage+'%', function() {
                          return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function (xhr) {
                        console.log('File has uploaded');
                    }
                });
            });
        });
    </script>
@endsection
