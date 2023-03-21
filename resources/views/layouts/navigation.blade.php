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
                <li><a href="{{ route('markets.index') }}">市場</a></li>
                <li><a href="{{ route('transportCompanies.index') }}">運送会社</a></li>
                <li><a href="{{ route('pastorals.index') }}">牧場</a></li>
                <li><a href="{{ route('slaughterHouses.index') }}">屠殺場</a></li>
                <li><a href="{{ route('parts.index') }}">部位カット</a></li>
                <li><a href="{{ route('users.index') }}">ユーザー管理</a></li>
                <li><a href="{{ route('purchases.index') }}">ユーザーページ</a></li>
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