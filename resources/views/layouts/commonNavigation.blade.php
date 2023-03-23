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
                <li><a href="{{route('transportToSlaughterHouses.index')}}">出荷運搬</a></li>
                <li><a href="{{route('slaughters.index')}}">屠殺</a></li>
                <li><a href="{{route('meats.index')}}">精肉管理</a></li>
                <li class="dropdown">
                    <a href="#"><span>レポート</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="{{route('purchaseReport.index')}}">仕入レポート</a></li>
                        <li><a href="{{route('purchaseTransportReport.index')}}">運送レポート</a></li>
                        <li><a href="{{route('fattenReport.index')}}">肥育レポート</a></li>
                        <li><a href="{{route('shipReport.index')}}">出荷レポート</a></li>
                        <li><a href="{{route('transportToSlaughterHouseReport.index')}}">運送レポート</a></li>
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

<!-- <div class="myHeader h-24 flex items-center">
    <div class="container max-w-7xl flex justify-between items-center">
        <div class="myLogo">
            <a href="/dashboard">
                <img src="{{ asset('./assets/img/common/logo.png') }}" alt="" class="w-16">
            </a>
        </div>
        <div class="myHeaderMenu">
            <div class="menuItem">
                <a class="p-3" href="/">ホーム</a>
                <a class="p-3" href="{{ route('purchases.index') }}">仕入</a>
                <a class="p-3" href="{{ route('transports.index') }}">仕入運送</a>
                <a class="p-3" href="{{ route('fatten.index') }}">肥育</a>
                <a class="p-3" href="{{ route('ship.index') }}">出荷指示</a>
                <a class="p-3" href="{{route('transportToSlaughterHouses.index')}}">出荷運搬</a>
                <a class="p-3" href="{{route('slaughters.index')}}">屠殺</a>
                <a class="p-3" href="{{route('meats.index')}}">精肉管理</a>
                @auth
                <a class="pr-0" href="/logout">ログアウト</a>
                @else
                <a class="p-3" href="/login">ログイン</a>
                <a class="p-3 pr-0" href="/register">会員登録</a>
                @endauth
            </div>
        </div>
    </div>
</div> -->