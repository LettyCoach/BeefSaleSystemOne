<div class="myHeader">
    <div class="container">
        <div class="menu-item">
            <a href="/">ホーム</a>
            <a href="{{ route('markets.index') }}">市場</a>
            <a href="{{ route('transportCompanies.index') }}">運送会社</a>
            <a href="{{ route('pastorals.index') }}">パストラル</a>
            <a href="{{ route('slaughterHouses.index') }}">スローターハウス</a>
            <a href="{{ route('parts.index') }}">パーツカット</a>
            @auth
            <a href="/logout">ログアウト</a>
            @else
            <a href="/login">ログイン</a>
            <a href="/register">会員登録</a>
            @endauth
        </div>
    </div>
</div>
<div class="logo">
    <a href="/dashboard">
        <img src="{{ asset('./assets/img/common/logo.png') }}" alt="">
    </a>
</div>