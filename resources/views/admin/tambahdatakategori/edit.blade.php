@extends('layouts.app')
@section('title', 'kategori')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .main {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .container-ketegori {
            width: 100%;
            margin-top: 70px;
            padding: 30px;
        }


        .container-ketegori .card-header {
            background-color: #ffc300;
            color: #2b2b2b;
            padding: 15px;
            font-size: 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .container-ketegori .bayar2 {
            width: 245px;
            height: 40px;
            border-radius: 10px;
            background-color: #fcf16b;
            display: flex;
            justify-content: space-around;
            align-items: center;
            border: none
        }

        .container-ketegori strong {
            align-items: center;
            display: flex;
            font-size: 35px;
        }

        .content-kategori {
            background-color: #e6e3e3;
            padding: 50px;
            border-bottom-right-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .container-ketegori .input {
            background-color: #fff;
            border: none;
            width: 100%;
            height: 35px;
            font-size: 17px;
            border-radius: 8px;
            padding: 6px 12px;
            margin-top: 20px;
        }

        .container-ketegori .bayar-1 {
            width: 100%;
            margin-top: 20px;
        }
    </style>
    <div class="container mt-3">
        <div class="container-ketegori">
            <div class="card-kategori">
                <div class="card-header">
                    Edit Kategori
                </div>
                <form action="{{ route('editdatakategorisubmit') }}" method="POST">
                    @csrf
                    <div class="content-kategori">
                        <div class="bayar-1">
                            <strong>Tambah Kategori</strong>
                            <input type="text" class="input" value="{{ $data->nama_kategori }}" name="kategori"
                                id="username" />
                        </div>
                        <input type="hidden" name="id_kategori" value="{{ $data->id_kategori }}">
                        <div class="bayar-1">
                            <button type="submit" class="bayar2">
                                + Tambah Kategori
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
