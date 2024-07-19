@extends('layouts.app')
@section('title', 'data produk')

@section('content')
    <div class="contentDP">
        <div class="grubatas">
            <div class="mode">
                <span class="mode-btn active" id="mode1" onclick="changeMode('mode1')" style="display: none;">
                    <i class="fas fa-bars"></i>
                </span>
                <span class="mode-btn" id="mode2" onclick="changeMode('mode2')">
                    <i class="fa-brands fa-windows"></i>
                </span>
            </div>

            <div class="search">
                <form>
                    <input type="text" placeholder="search"></input>
                    <button>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="tambahbarang">
            <a href="{{ route('tambahdatabarang') }}">Tambah Barang</a>
        </div>
        <div class="grubcard1" id="grubcard1">
            @foreach ($data as $item)
                <div class="cardBarang">
                    <figure>
                        <img src="../upload/{{ $item->gambar }}" class="custom-image" />
                    </figure>
                    <h4>{{ $item->nama_barang }}</h4>
                    <div class="grub-kanan">
                        <span>
                            <a href="#" onclick="listbarang({{ $item->id_barang }}, '{{ $item->nama_barang }}')">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </span>
                        <span class="edit">
                            <a href="{{ route('editdatabarang', $item->id_barang) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="grubcard2" id="grubcard2" style="display: none;">
            @foreach ($data as $item)
                <div class="cardBarang">
                    <div class="overlay">
                        <span class="edit">
                            <a href="{{ route('editdatabarang', $item->id_barang) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                        </span>
                        <a href="#" onclick="listbarang({{ $item->id_barang }}, '{{ $item->nama_barang }}')">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                        <p>{{ $item->nama_barang }}</p>
                    </div>
                    <figure>
                        <img src="../upload/{{ $item->gambar }}" alt="Deskripsi gambar" class="custom-image" />
                    </figure>
                </div>
            @endforeach
        </div>
    </div>

    <form action="{{ route('pembayaran') }}" method="POST">
        @csrf
        <div class="keranjang" id="keranjang">
            <div class="btnkeranjang" onclick="bukakeranjang()">
                <i id="thumbtackIcon" class="fa-solid fa-thumbtack"></i>
            </div>
            <div class="isikeranjang" id="isikeranjang">
                <table id="barang-added">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- masuk disini --}}
                    </tbody>
                </table>
            </div>
            <div class="grubtotal" id="grubtotal">
                <button type="submit" class="bayar">
                    bayar
                </button>
            </div>
        </div>
    </form>
    <script>
        // Fungsi untuk menambahkan barang ke dalam keranjang
        function listbarang(id_barang, nama_barang) {
            var stok_barang = <?php echo json_encode($stok_barang); ?>;
            var tbody = document.querySelector('#barang-added tbody');
            var existingItem = tbody.querySelector(`tr[data-id="${id_barang}"]`);

            var senggel = document.getElementById('keranjang');

            senggel.classList.add('open');

            if (existingItem) {
                alert('Barang sudah ada dalam keranjang!');
                return;
            }

            var stok = stok_barang[id_barang];
            if (stok > 0) {
                var newRow = document.createElement('tr');
                newRow.dataset.id = id_barang;
                newRow.innerHTML = `
                <td class="tede1">${nama_barang}</td>
                <td class="jmlh">
                    <div class="kk" onclick="kurangiJumlah(this)">-</div>
                    <input type="number" name="jumlah_barang[${id_barang}]" value="1" max="${stok}" onchange="updateJumlah(this)">
                    <div class="tt" onclick="tambahJumlah(this)">+</div>
                </td>
                <td class="tede2"><button class="hps" onclick="hapusBarang(this)">Hapus</button></td>
            `;
                tbody.appendChild(newRow);
            } else {
                alert('Stok barang sudah habis!');
            }
        }

        // Fungsi untuk menambah jumlah barang
        function tambahJumlah(element) {
            var jumlahElement = element.parentNode.querySelector('input');
            var jumlah = parseInt(jumlahElement.value);
            var max = parseInt(jumlahElement.getAttribute('max'));
            if (jumlah < max) {
                jumlahElement.value = jumlah + 1;
            } else {
                alert('Stok barang tidak mencukupi!');
            }
        }

        // Fungsi untuk mengurangi jumlah barang
        function kurangiJumlah(element) {
            var jumlahElement = element.parentNode.querySelector('input');
            var jumlah = parseInt(jumlahElement.value);
            if (jumlah > 1) {
                jumlahElement.value = jumlah - 1;
            } else {
                alert('Jumlah barang tidak boleh kurang dari 1!');
            }
        }

        // Fungsi untuk memperbarui jumlah barang
        function updateJumlah(input) {
            var jumlah = parseInt(input.value);
            var max = parseInt(input.getAttribute('max'));
            if (jumlah < 1 || isNaN(jumlah)) {
                input.value = 1;
            } else if (jumlah > max) {
                input.value = max;
                alert('Stok barang tidak mencukupi!');
            }
        }

        // Fungsi untuk menghapus barang dari keranjang
        function hapusBarang(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function bukakeranjang() {
            var keranjang = document.getElementById('keranjang');

            keranjang.classList.toggle('open');
        }
    </script>




@endsection
