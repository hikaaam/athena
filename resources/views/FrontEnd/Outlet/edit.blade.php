@extends('FrontEnd.Layout.index')
@section('head')
    <title>Outlet</title>
@endsection
@section('body')
    <div class="container">
        <a style="margin-bottom: 2%" class="btn btn-danger" href="{{ route('prefix.outlet.index') }}">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>
        <h4 style="margin-bottom: 2%" c>Edit Outlet</h4>
        <form id="fileUploadForm" action="{{ route('prefix.outlet.update',['outlet'=>$data->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <label for="name">Nama Outlet</label>
            <input placeholder="Indomaret Tegal" required type="text" name="name" class="form-control"
                value="{{ old('name') ?? $data->name  }}">
            <br>
            <label for="address">Alamat Outlet</label>
            <textarea placeholder="alamat ini jln ini" required name="address" class="form-control">{{old('address')??$data->address}}</textarea>
             <br>
             <input class="btn btn-success form-control" type="submit" value="Simpan">
        </form>
    </div>

@endsection
