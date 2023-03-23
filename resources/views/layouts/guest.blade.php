<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SDGs牛販売管理</title>
    <meta content="屠殺される廃用牛を再生し肉質と体重を向上させ市場に出荷させることにより国内の需要を安定させ価格を維持し高齢農家を支援する。" name="description">
    <meta content="牛販売管理, SDGs" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- Font Awesome Icon -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center shadow">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>SGDs</h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="{{ route('purchases.index') }}">仕入</a></li>
                    <li><a href="{{ route('transports.index') }}">仕入運送</a></li>
                    <li><a href="{{ route('fatten.index') }}">肥育</a></li>
                    <li><a href="{{ route('ship.index') }}">出荷指示</a></li>
                    <li><a href="{{ route('transportToSlaughterHouses.index') }}">出荷運送</a></li>
                    <li><a href="{{ route('slaughters.index')}} ">屠殺</a></li>
                    <li><a href="{{ route('meats.index') }}">精肉管理</a></li>
                    <li class="dropdown">
                        <a href="#"><span>レポート</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="{{route('purchaseReport.index')}}">仕入レポート</a></li>
                            <li><a href="{{route('purchaseTransportReport.index')}}">運送レポート</a></li>
                            <li><a href="{{route('fattenReport.index')}}">肥育レポート</a></li>
                            <li><a href="{{route('shipReport.index')}}">出荷レポート</a></li>
                            <li><a href="{{route('transportToSlaughterHouseReport.index')}}">運送レポート</a></li></li>
                            <li><a href="{{route('slaughterReport.index')}}">屠殺レポート</a></li>
                            <li><a href="{{route('meatReport.index')}}">精肉レポート</a></li>
                        </ul>
                    </li>
                    @if (Auth::user() && Auth::user()->hasRole('admin'))
                    <li><a href="{{route('markets.index')}}">管理者</a></li>                    
                @endif
                </ul>
            </nav><!-- .navbar -->

            @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                <a class="btn-book-a-table" style="margin-left: 0;" href="/logout">ログアウト</a>
                @else
                <a class="btn-book-a-table" style="margin-left: 0;" href="{{ route('login') }}">ログイン</a>
                <a class="btn-book-a-table" style="margin-left: 0;" href="{{ route('register') }}">会員登録</a>
                @endauth
            </div>
            @endif

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->

    {{ $slot }}

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-4 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div>
                        <h4>住所</h4>
                        <p>
                            Tokyo <br>
                            Japan<br>
                        </p>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 footer-links d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>私たちとのつながり</h4>
                        <p>
                            <strong>電話番号:</strong> +81-69-4199-9190<br>
                            <strong>Eメール:</strong> <a href="mailto:;">example@gmail.com</a><br>
                        </p>
                    </div>
                </div>

                <!-- <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Opening Hours</h4>
                        <p>
                            <strong>Mon-Sat: 11AM</strong> - 23PM<br>
                            Sunday: Closed
                        </p>
                    </div>
                </div> -->

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Follow Us</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>SGDs</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
            </div>
        </div>

    </footer><!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>