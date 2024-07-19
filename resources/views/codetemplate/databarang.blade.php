@extends('layout.app')
@section('title', 'Data Barang')
@section('content')
    <div class="container mt-3">
        <table id="data-barang" class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->nama_barang }}</td>
                        <td><a href="#" class="btn-tambah"
                                onclick="listbarang({{ $item->id_barang }}, '{{ $item->nama_barang }}')">Tambah</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card p-2">
            <form action="{{ route('pembayaran') }}" method="POST">
                @csrf
                <table id="barang-added" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be dynamically added here -->
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">Bayar</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function listbarang(id_barang, nama_barang) {
            var stok_barang = <?php echo json_encode($stok_barang); ?>;

            var existingRow = $('#barang-added tbody tr').filter(function() {
                return $(this).find('td:nth-child(2)').text() === nama_barang;
            });

            if (existingRow.length > 0) {
                var totalField = existingRow.find('td:nth-child(3) input');
                var currentTotal = parseInt(totalField.val());
                if (currentTotal + 1 <= stok_barang[id_barang]) {
                    totalField.val(currentTotal + 1);
                } else {
                    alert('Stok barang tidak mencukupi.');
                }
            } else {
                var rowCount = $('#barang-added tbody tr').length + 1;
                if (1 <= stok_barang[id_barang]) {
                    var newRow = '<tr>' +
                        '<td>' + rowCount + '</td>' +
                        '<td>' + nama_barang + '</td>' +
                        '<td><input type="number" class="form-control" style="width:60px; text-align:center;"' +
                        'name="jumlah_barang[' + id_barang + ']" value="1"></td>' +
                        '<td><button type="button" class="btn btn-danger btn-delete">Hapus</button></td>' +
                        '</tr>';
                    $('#barang-added tbody').append(newRow);
                } else {
                    alert('Stok barang tidak mencukupi.');
                }
            }

            // Tambahkan event listener untuk tombol hapus
            $('.btn-delete').off().click(function() {
                $(this).closest('tr').remove();
            });
        }
    </script>
@endsection
