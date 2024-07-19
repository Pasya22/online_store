@extends('layouts.app')
@section('title', 'data diskon')

@section('content')
    </style>
    <div class="tambahdataproduk">
        <div class="container">
            <h2>Tambah Data Diskon</h2>
            <form action="{{ route('tambahdatadiskonsubmit') }}" method="POST">
                @csrf
                <div class="form-group label-select-container">
                    <label for="barang">Pilih Barang:</label>
                    <select id="barang" name="id_barang">
                        @foreach ($data['barang'] as $item)
                            <option value="{{ $item->id_barang }}">{{ $item->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="diskon">Jumlah Diskon:</label>
                    <input type="number" id="diskon"  name="diskon" required>
                </div>
                <div class="form-group">
                    <button type="submit">Tambah Diskon</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.js"></script>
@endsection
