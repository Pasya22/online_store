@extends('layouts.app')
@section('title', 'Edit Data Produk')

@section('content')
    <div class="contentlap">
        <div class="laporan">
            <div class="judul">
                Kategori
                <span><a href="{{ route('tambahdatakategori') }}">Tambah Data Kategori</a></span>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama Kategori</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>
                                    <a href="{{ route('editdatakategori', $item->id_kategori) }}">
                                        <div class="edit">Edit</div>
                                    </a>
                                    <a href="{{ route('hapusdatakategori', $item->id_kategori) }}">
                                        <div class="hapus">Hapus</div>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
