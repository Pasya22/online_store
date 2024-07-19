@extends('layout.app')
@section('title', 'Pembayaran')
@section('content')
    <div class="container mt-3">
        <table class="table text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Kasir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item['nama_barang'] }}</td>
                        <td>{{ $item['jumlah_barang'] }}</td>
                        <td>{{ 'Rp ' . number_format($item['total'], 0, ',', '.') }}</td>
                        <td>{{ session('user')->username }}</td>
                        <td><button type="button" class="btn btn-danger btn-delete">Hapus</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('bayar') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="total_harga">Total Harga</label><br>
                <input type="text" name="total_harga" id="total_harga"
                    value="{{ 'Rp ' . number_format($totalHarga, 0, ',', '.') }}" readonly>
            </div>
            <div class="form-group">
                <label for="bayar">Bayar</label><br>
                <input type="text" name="bayar" id="bayar" oninput="hitungKembalian()">
            </div>
            <div class="form-group">
                <label for="kembali">Kembali</label><br>
                <input type="text" name="kembali" id="kembali" readonly>
            </div><br>
            @foreach ($data as $item)
                <input type="hidden" name="id_barang[]" value="{{ $item['id_barang'] }}">
                <input type="hidden" name="nama_barang[]" value="{{ $item['nama_barang'] }}">
                <input type="hidden" name="jumlah_barang[]" value="{{ $item['jumlah_barang'] }}">
                <input type="hidden" name="total[]" value="{{ $item['total'] }}">
            @endforeach
            <button type="submit" class="btn btn-success">Bayar</button>
        </form>
    </div>
    <script>
        function hitungKembalian() {
            var totalHarga = parseInt(document.getElementById('total_harga').value.replace(/\D/g, ''));
            var bayar = parseInt(document.getElementById('bayar').value.replace(/\D/g, '')) || 0;
            var kembali = bayar - totalHarga;
            document.getElementById('kembali').value = 'Rp ' + formatRupiah(kembali);
        }

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            var formatted = ribuan.join('.').split('').reverse().join('');
            return formatted;
        }
        $('.btn-delete').off().click(function() {
            $(this).closest('tr').remove();
        });
    </script>
@endsection
