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
        <form id="fileUploadForm" action="{{ route('prefix.product.update',['product'=>$data->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Nama produk</label>
            <input placeholder="kopi susu" required type="text" name="name" class="form-control"
                value="{{ old('name') ?? $data->name }}">
            <br>
            <label for="price">Harga Produk</label>
            <input placeholder="5000" required type="number" name="price" class="form-control"
                value="{{ old('price') ?? $data->price }}"">
                <br>
                <label for=" category_id">Kategori</label>
            <select required name="category_id" class="form-control">
                @foreach ($category as $item => $value)
                    <option selected="{{ (old('category_id') ?? $data->category_id) == $value->id }}"
                        value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
            <br>
            <label for="outlet_id">Outlet</label>
            <select required name="outlet_id" class="form-control">
                @foreach ($outlet as $item => $value)
                    <option selected="{{ (old('outlet_id') ?? $data->outlet_id) == $value->id }}" value="{{ $value->id }}">
                        {{ $value->name }}</option>
                @endforeach
            </select>
            <br>
            <img style="margin-bottom: 1%" id="gambarEdit" src="{{ asset('images/' . $data->image) }}" alt="image" width=120
                class="img-fluid" />
            <br>
            <div onclick="clickBtn()" id="buttonGambaredit" class="btn btn-success">Ubah Gambar</div>
            <br>
            <br>
            <label id="labelImage" class="d-none" for="image">Gambar Produk</label>
            <input id="image" type="file" name="image" class="form-control d-none">
            <br>
            <label for="desc">Deskripsi Produk</label>
            <textarea required class="ckeditor form-control" name="desc" id="" cols="30"
                rows="10">{{ old('desc') ?? $data->desc }}</textarea>
            <br>
            <input type="submit" value="simpan" class="btn btn-success form-control">
            <br>
            <br>
            <div class="form-group">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(function() {
            $(document).ready(function() {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function() {
                        var percentage = '0';
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage + '%', function() {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function(xhr) {
                        console.log('File has uploaded');
                    }
                });
            });
        });
        let ubah = false;
        const clickBtn = () => {
            if (ubah) {
                $("#image").attr('class', 'form-control d-none');
                $("#image").val(null);
                $("#labelImage").attr('class', 'd-none');
                $("#gambarEdit").attr('class', 'img-fluid d-block');
                $("#buttonGambaredit").html("Ubah Image");
                ubah = false;
            } else {
                $("#image").attr('class', 'form-control d-block');
                $("#labelImage").attr('class', 'd-block');
                $("#gambarEdit").attr('class', 'd-none');
                $("#buttonGambaredit").html("Batalkan");
                ubah = true;
            }
        }
    </script>
@endsection
