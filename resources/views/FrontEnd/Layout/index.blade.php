@php
use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="en">
@include('sweetalert::alert')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('datatables.min.css') }}">
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="{{ asset('datatables.min.js') }}"></script>
    @yield('head')
</head>

<body>
    <nav class="navbar navbar-dark">
        <a class="navbar-brand" href="{{ url('/') }}">
            Majoo Teknologi Indonesia
        </a>
        <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}">
            @csrf
            <button id="white" class="btn btn-outline-danger my-2 my-sm-0" type="submit"><i
                    class="fa fa-right-from-bracket"></i></button>
        </form>
    </nav>
    <div class="d-flex .flex-row justify-content-between">
        <aside class="p-3" id="sidebar">
            <div id="title" class="d-flex .flex-row justify-content-end">
                <h5 style="flex:1" class="sidetext" id="white">{{ Auth::user()->name }}</h5>
                <a id="white" onclick="btnSideBar()"><i style="font-size: 1.5em;" id="btnside"
                        class="fa fa-bars"></i></a>
            </div>
            {{--  --}}
            <a href="{{ route('home') }}" id="content">
                <h6 id="white" class="sidetext">Dashboard</h6>
                <div class="content-i"><i style="font-size: 1em;" id="white" class="fa fa-house-user"></i></div>
            </a>
            <a href="{{ route('prefix.newtransaction.index') }}" id="content">
                <h6 id="white" class="sidetext">Buat Transaksi</h6>
                <div class="content-i"><i style="font-size: 1em;" id="white" class="fa fa-plus"></i></div>
            </a>
            <a href="{{ route('prefix.transmasuk.index', ['id'=>1]) }}" id="content">
                <h6 id="white" class="sidetext">Beli Barang</h6>
                <div class="content-i"><i style="font-size: 1em;" id="white" class="fa fa-basket-shopping"></i>
                </div>
            </a>
            <a href="{{ route('trxget') }}" id="content">
                <h6 id="white" class="sidetext">Transaksi</h6>
                <div class="content-i"><i style="font-size: 1em;" id="white" class="fa fa-cash-register"></i></div>
            </a>
            <a href="{{ route('prefix.product.index') }}" id="content">
                <h6 id="white" class="sidetext">Produk</h6>
                <div class="content-i"><i style="font-size: 1em;" id="white" class="fa fa-box"></i></div>
            </a>
            <a href="{{route('prefix.category.index')}}"  id="content">
                <h6 id="white" class="sidetext">Kategori</h6>
                <div class="content-i"><i style="font-size: 1em;" id="white" class="fa fa-stream"></i></div>
            </a>
            <a href="{{route('prefix.outlet.index')}}" id="content">
                <h6 id="white" class="sidetext">Outlet</h6>
                <div class="content-i"><i style="font-size: 1em;" id="white" class="fa fa-house"></i></div>
            </a>
            <a href="{{route('prefix.supplier.index')}}"  id="content">
                <h6 id="white" class="sidetext">Supplier</h6>
                <div class="content-i"><i style="font-size: 1em;" id="white" class="fa fa-car"></i></div>
            </a>
            <a id="content">
                <h6 id="white" class="sidetext">Laporan</h6>
                <div class="content-i"><i style="font-size: 1em;" id="white" class="fa fa-book"></i></div>
            </a>
        </aside>
        <div class="body-container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            @yield('body')
        </div>
    </div>

    <script>
        let isShow = true;
        const btnSideBar = () => {
            if (isShow) {
                $("#sidebar").css("width", "5%");
                $(".sidetext").css("display", "none")
                $("#title").css("display", "none");
                $(".content-i").css("margin-top", "10%");
                $("#btnside").css("padding-right", "6px")
                isShow = false;
            } else {
                $("#sidebar").css("width", "18%");
                $(".sidetext").css("display", "block")
                $("#title").css("display", "block");
                $(".content-i").css("margin-top", "0px");
                $("#btnside").css("padding-right", "0px")
                isShow = true;
            }

        }
        try {
            $(document).ready(function() {
                $('#tables').DataTable();
            });
        } catch (error) {
            console.log(error.message)
        }
        try {
            $(document).ready(function() {
                $('.ckeditor').ckeditor();
            });
            CKEDITOR.replace('wysiwyg-editor', {
                filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        } catch (error) {
            console.log(error.message)
        }
    </script>
</body>

</html>
