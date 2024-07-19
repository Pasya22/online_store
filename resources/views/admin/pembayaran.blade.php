@extends('layouts.app')
@section('title', 'Pembayaran')
@section('content')
    <div class="container mt-3">
        <div class="container-pembayaran">
            @if($data == null)
            <div class="card-pembayaran" style="height:200px;">
                <div class="card-header">
                    Pembayaran
                </div>
               <h1 class="Nothing-data"> Data Nothing A Found</h1> 
            </div>
            @else
            <div class="card-pembayaran">
                <div class="card-header">
                    Pembayaran
                </div>
                <div class="table">
                    <table>
                        <tbody>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ date('j F Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table">
                    <table>
                        <tbody>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Kasir</th>
                                <th>Aksi</th>
                            </tr>
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
                </div>
                <div class="display">
                    <form action="{{ route('bayar') }}" method="POST">
                        @csrf
                        <div class="bayar-1">
                            <div class="lol">
                                <strong>Total Semua</strong>
                                <input type="text" class="input" name="total_harga"
                                    value="{{ 'Rp ' . number_format($totalHarga, 0, ',', '.') }}" id="total_harga"
                                    readonly />
                            </div>
                            <div class="lol">
                                <strong>Kembalian</strong>
                                <input type="text" name="kembali" class="input" id="kembali" readonly />
                            </div>
                        </div>
                        <div class="bayar-1">
                            <div class="lol">
                                <strong>Bayar</strong>
                                <input type="text" name="bayar" class="input" id="bayar"
                                    onkeyup="this.value = formatRupiah(this.value)" />
                            </div>
                            <div class="bayar2" onclick="hitungKembalian()">
                                Hitung Kembali
                            </div>
                        </div>
                        @foreach ($data as $item)
                            <input type="hidden" name="id_barang[]" value="{{ $item['id_barang'] }}">
                            <input type="hidden" name="nama_barang[]" value="{{ $item['nama_barang'] }}">
                            <input type="hidden" name="jumlah_barang[]" value="{{ $item['jumlah_barang'] }}">
                            <input type="hidden" name="total[]" value="{{ $item['total'] }}">
                        @endforeach
                        <button type="submit" class="bayar">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Bayar
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
    <script>
        function hitungKembalian() {
            var totalHarga = parseInt(document.getElementById('total_harga').value.replace(/\D/g, ''));
            var bayar = parseInt(document.getElementById('bayar').value.replace(/\D/g, '')) || 0;
            var kembali = bayar - totalHarga;
            document.getElementById('kembali').value = 'Rp ' + formatRupiah(kembali);
        }

        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }

        $('.btn-delete').off().click(function() {
            $(this).closest('tr').remove();
        });
    </script>
@endsection
