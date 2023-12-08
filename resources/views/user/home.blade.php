@extends('user.layouts.page')
@section('content')
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url(../build/images/pasar1..jpg)">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Selamat datang di <span>Pasar Baru
                                    Bahagia</span></h2>
                            <p class="animate__animated animate__fadeInUp">Selamat datang di pasar baru yang penuh
                                keceriaan! Semoga setiap langkah Anda di sini dipenuhi dengan kebahagiaan, penemuan
                                baru, dan pengalaman belanja yang menyenangkan. Selamat menikmati beragam produk dan
                                layanan yang kami tawarkan. Selamat berbelanja!</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url(../build/images/pasar2..jpg)">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Pasar Baru Bahagia</h2>
                            <p class="animate__animated animate__fadeInUp">Mari jelajahi setiap lorong dan rak di pasar
                                baru ini untuk menemukan berbagai pilihan produk yang menarik. Dari segala kebutuhan
                                sehari-hari hingga barang-barang unik yang akan membuat rumah Anda lebih indah, pasar
                                ini menyajikan berbagai opsi yang memikat. Nikmatilah pengalaman berbelanja Anda sambil
                                mengeksplorasi keajaiban pasar ini. Semoga setiap pembelian membawa kebahagiaan dan
                                kepuasan. Selamat berbelanja dengan penuh kegembiraan!.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url(../build/images/pasar3..jpg)">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Pasar Baru Bahagia</h2>
                            <p class="animate__animated animate__fadeInUp">Sambil melanjutkan perjalanan berbelanja Anda
                                di pasar baru yang penuh keceriaan ini, jangan ragu untuk berinteraksi dengan para
                                penjual yang ramah dan berpengetahuan. Tanyakan tentang produk unggulan, dan biarkan
                                mereka membantu Anda menemukan barang yang sesuai dengan kebutuhan dan selera Anda.
                                Rasakan sensasi kegembiraan saat menemukan penawaran istimewa dan diskon yang
                                menggembirakan. Semoga setiap transaksi di pasar ini membawa kepuasan dan keceriaan yang
                                mendalam. Selamat mengeksplorasi setiap sudut pasar baru yang bahagia ini!</p>
                        </div>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section>
    <div class="container-fluid">
        <div id="carouselExample" class="carousel slide">
            <?php
            // Assuming $totalItems is the total number of items you have
            $totalItems = 20; // Change this to the actual total number of items
            $itemsPerSlide = 5;
            $totalSlides = ceil($totalItems / $itemsPerSlide);
            ?>

            <div class="carousel-inner">
                <?php for ($i = 0; $i < $totalSlides; $i++) : ?>
                <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                    <div class="row justify-content-center align-items-center">
                        <?php
              $start = $i * $itemsPerSlide;
              $end = min(($i + 1) * $itemsPerSlide, $totalItems);

              for ($j = $start; $j < $end; $j++) :
            ?>
                        <div class="card"
                            style="width: 14rem; margin-left: 20px; margin-right: 20px; margin-top: 20px; margin-bottom: 20px;">
                            <div class="card-body">
                                <h5 class="card-title">Card <?php echo $j + 1; ?></h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <?php endfor; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev"
                style="background-color: lightgrey;">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next"
                style="background-color: lightgrey;">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection
