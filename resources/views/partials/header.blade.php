<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <link href="{{ asset('css/tambahdatabarang.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/dataproduk.css') }}">

    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">
    <link href="{{ asset('css/tabeldatakategori.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.css" rel="stylesheet">
    <title>@yield('nabar')</title>
</head>

<body>
    <div class="navbarr">
        <div class="grubpropil">
            <span>
                <i class="fa-solid fa-comment-dots"></i>
            </span>
            <div class="propil">
                <div class="spanprofil">
                    @if (session('user')->foto == '1')
                    <img class="profil" src="{{ asset('profil/' . session('user')->foto) }}" alt="">
                    @else
                    <img class="profil"
                        src="{{asset('img/default.jpg')}}"
                        alt="">
                    @endif
                </div>
                <div class="namapropil" id="namapropil" onclick="togglepropil()">
                    <h5>{{ session('user')->username }}</h5>
                    <span id="caretIcon" class="caretIcon">
                        <i class="fa-solid fa-caret-down"></i>
                    </span>
                </div>
            </div>
            <div id="cardpropil" class="cardpropil">
                <a href="{{ route('profil', session('user')->id_user) }}">
                    <div class="isicardpropil garis">
                        <h4>Profil</h4>
                    </div>
                </a>
                <a href="{{ route('login') }}">
                    <div class="isicardpropil">
                        <h4>Logout</h4>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let isSidebarOpen = false;

            function togglepropil() {
                isSidebarOpen = !isSidebarOpen;
                const cardPropil = document.getElementById('cardpropil');
                const caretIcon = document.getElementById('caretIcon');

                if (isSidebarOpen) {
                    cardPropil.classList.add('open');
                    caretIcon.classList.add('open');
                } else {
                    cardPropil.classList.remove('open');
                    caretIcon.classList.remove('open');
                }
            }

            function handleClickOutside(event) {
                const grubpropil = document.getElementById('grubpropil');
                if (!grubpropil.contains(event.target) && event.target.id !== 'namapropil') {
                    isSidebarOpen = false;
                    const cardPropil = document.getElementById('cardpropil');
                    const caretIcon = document.getElementById('caretIcon');
                    cardPropil.classList.remove('open');
                    caretIcon.classList.remove('open');
                }
            }

            function handleCloseOnScroll() {
                if (isSidebarOpen) {
                    isSidebarOpen = false;
                    const cardPropil = document.getElementById('cardpropil');
                    const caretIcon = document.getElementById('caretIcon');
                    cardPropil.classList.remove('open');
                    caretIcon.classList.remove('open');
                }
            }

            document.getElementById('namapropil').addEventListener('click', togglepropil);
            document.addEventListener("mousedown", handleClickOutside);
            document.addEventListener("scroll", handleCloseOnScroll);
        });
    </script>

    {{-- <script src="{{ asset('js/jees.js') }}"></script> --}}
