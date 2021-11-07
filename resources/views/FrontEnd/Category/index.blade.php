@extends('FrontEnd.Layout.index')
@section('head')
    <title>Category</title>
@endsection
@section('body')
    <div class="container">
        <a href="{{ route('prefix.category.create') }}" class="btn btn-success" href="">
            <h5>Tambah Category <i class="fa fa-home"></i> </h5>
        </a>
        <h5 style="margin-top: 2%;">Supplier <i class="fa fa-car"></i> </h5>
        <table id="tables" class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <td scope="col">nama</td>
                    <td scope="col">deskripsi</td>
                    <td scope="col">Tanggal Dibuat</td>
                    <td scope="col">Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item => $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->desc}}</td>
                        <td>{{ date_format($value->created_at, 'd-M-Y h:m') }}</td>
                        <td>
                            <div class="d-flex flex-row justify-content-around">
                                <a style="color:orange" href="{{ route('prefix.category.edit', ['category' => $value->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form action="{{ route('prefix.category.destroy', ['category' => $value->id]) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger" id="white">
                                    <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
