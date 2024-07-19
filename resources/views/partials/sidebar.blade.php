<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <title></title>
</head>

<body>
    <div class="header">
        <div id="navSamping" class="navSamping">
            <button class="btn-nav" onclick="toggleSidebar()">
                <i id="chevronIcon" class="fa-solid fa-chevron-right"></i>
            </button>
            @php
                $currentPage = request()->segment(2); // Mendapatkan segment kedua dari URL, misal: isi/dashboard
            @endphp
            <a href="{{ route('dashboard') }}" class="navbar @if ($currentPage == 'dashboard') active @endif">

                <div class="grubheader">
                    <span><i class="fa-solid fa-house"></i></span>
                </div>
                <div class="h4">Dashboard</div>
            </a>
            <a href="{{ route('pembayarann') }}" class="navbar @if ($currentPage == 'pembayaran') active @endif">

                <div class="grubheader">
                    <span><i class="fa-solid fa-cart-plus"></i></span>
                </div>
                <div class="h4">Pembayaran</div>
            </a>
            <a href="{{ route('databarang') }}" class="navbar @if ($currentPage == 'dataproduk') active @endif">
                <div class="grubheader">
                    <span><i class="fa-solid fa-box"></i></span>
                </div>
                <div class="h4">Data Barang</div>
            </a>
            <a href="{{ route('datakategori') }}" class="navbar @if ($currentPage == 'datakategori') active @endif">
                <div class="grubheader">
                    <span><i class="fa-solid fa-bars"></i></span>
                </div>
                <div class="h4">Data Kategori</div>
            </a>
            <a href="{{ route('datadiskon') }}" class="navbar @if ($currentPage == 'datadiskon') active @endif">
                <div class="grubheader">
                    <span><i class="fa-solid fa-tags"></i></span>
                </div>
                <div class="h4">Data Diskon</div>
            </a>

            <a href="{{ route('laporan') }}" class="navbar @if ($currentPage == 'laporan') active @endif">


                <div class="grubheader">
                    <span><i class="fa-solid fa-book"></i></span>
                </div>
                <div class="h4">Laporan</div>
            </a>
        </div>
    </div>



    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('navSamping');
            var chevronIcon = document.getElementById('chevronIcon');

            sidebar.classList.toggle('open');
            chevronIcon.classList.toggle('open');
        }
    </script>
    <script src="{{ asset('js/jees.js') }}"></script>
</body>

</html>
