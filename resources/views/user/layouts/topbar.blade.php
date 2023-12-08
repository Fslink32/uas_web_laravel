<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope-fill"></i><a href="mailto:contact@example.com">pasarbarubahagia@gmail.com</a>
            <i class="bi bi-phone-fill phone-icon"></i>021-098-765
        </div>
        <div class="social-links d-none d-md-block">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>
    </div>
</section>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{ route('user.home.index') }}">
            <h1 class="logo me-auto">Pasar Baru<br>Bahagia</h1>
        </a>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="{{ route('user.home.index') }}">Home</a></li>
                <li><a class="nav-link scrollto" href="{{ route('user.home.tentang_pasar') }}">Tentang Pasar</a></li>
                <li><a class="nav-link scrollto" href="{{ route('user.home.pedagang') }}">Pedagang</a></li>
                <li><a class="nav-link scrollto " href="{{ route('user.home.harga') }}">Harga</a></li>
                <li><a class="nav-link scrollto " href="{{ route('user.home.about') }}">About</a></li>
                <li><a class="getstarted scrollto" href="{{ route('user.home.kontak') }}">Kontak</a></li>
                @if (Auth::check())
                    <li><a class="getstarted scrollto" href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                @else
                    <li><a class="getstarted scrollto" href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
<hr>
