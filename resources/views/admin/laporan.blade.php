@extends('layouts.app')
@section('title', 'data produk')

@section('content')
    <div class="contentlap">
        <div class="laporan">
            <div class="judul">
                Laporan
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama Barang</th>
                            <th width="100px">Nama Kasir</th>
                            <th width="50px">Jumlah Barang</th>
                            <th>Total Harga</th>
                            <th width="170px">Tanggal</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->jumlah_barang }}</td>
                                <td>{{ $item->total_harga }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('laporanhapus', $item->id_pembayaran) }}">
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
