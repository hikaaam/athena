@extends('FrontEnd.Layout.index')
@section('head')
    <title>Product Detail</title>
@endsection
@section('body')
    <div class="container">
        <a style="margin-bottom: 2%" class="btn btn-danger" href="{{ route('prefix.product.index') }}">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>
        <div class="d-flex flex-row justify-content-start align-items-center">
            <img style="border-radius: 15px;margin-right: 2%;" src="{{ asset('images/' . $data->image) }}" width="150" class="img-fluid" alt="image">
            <div>
                <h4 style="margin-bottom: 2%" c>{{ $data->name }}</h4>
                <p>Harga : {{ $data->price }}</p>
                <p>Kategori : {{ $data->category->name }}</p>
                <p>Outlet : {{ $data->outlet->name }}</p>
            </div>
        </div>
        <div>
            <h4 style="margin-top: 2%" c>Deskripsi</h4>
            {!!$data->desc!!}
        </div>
    </div>
@endsection
