@include('partials.header')
<main class="main">
    <div class="container">
        @include('partials.sidebar')
        @yield('content')
    </div>
</main>
@include('partials.footer')