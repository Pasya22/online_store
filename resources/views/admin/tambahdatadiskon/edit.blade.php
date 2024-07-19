@extends('layouts.app')
@section('title', 'edit data diskon')

@section('content')
    </style>
    <div class="tambahdataproduk">
        <div class="container">
            <h2>Tambah Data Diskon</h2>
            <form action="{{ route('editdatadiskonsubmit',$data['diskon']->id_diskon ) }}" method="POST">
                @csrf
                <div class="form-group label-select-container">
                    <label for="barang">Pilih Barang:</label>
                    <select id="barang" name="id_barang">
                        @foreach ($data['data_barang'] as $item)
                            <option value="{{ $item->id_barang }}"
                                {{ $item->id_barang == $data['diskon']->id_barang ? 'selected' : '' }}>
                                {{ $item->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="diskon">Jumlah Diskon:</label>
                    <input type="number" id="diskon" value="{{ $data['diskon']->diskon }}" name="diskon" required>
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
