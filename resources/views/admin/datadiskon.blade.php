@extends('layouts.app')
@section('title', 'data Diskon')

@section('content')
    <div class="contentlap">
        <div class="laporan">
            <div class="judul">
                Data Diskon
                <span><a href="{{ route('tambahdatadiskon') }}">Tambah Diskon Barang</a></span>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama Barang</th>
                            <th>Diskon</th>
                            <th width="150px">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->diskon }}</td>
                                <td>
                                    <a href="{{ route('editdatadiskon', $item->id_diskon) }}">
                                        <div class="edit">Edit</div>
                                    </a>
                                    <a href="{{ route('hapusdatadiskon', $item->id_diskon) }}">
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
