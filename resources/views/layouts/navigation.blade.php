<div class="myHeader h-24 flex items-center">
    <div class="container max-w-7xl flex justify-between items-center">
        <div class="myLogo">
            <a href="/dashboard">
                <img src="{{ asset('./assets/img/common/logo.png') }}" alt="" class="w-16">
            </a>
        </div>
        <div class="myHeaderMenu">
            <div class="menuItem">
                <a class="p-3" href="/">ホーム</a>
                <a class="p-3" href="{{ route('markets.index') }}">市場</a>
                <a class="p-3" href="{{ route('transportCompanies.index') }}">運送会社</a>
                <a class="p-3" href="{{ route('pastorals.index') }}">パストラル</a>
                <a class="p-3" href="{{ route('slaughterHouses.index') }}">スローターハウス</a>
                <a class="p-3" href="{{ route('parts.index') }}">パーツカット</a>
                @auth
                <a class="p-3 pr-0" href="/logout">ログアウト</a>
                @else
                <a class="p-3" href="/login">ログイン</a>
                <a class="p-3 pr-0" href="/register">会員登録</a>
                @endauth
            </div>
        </div>
    </div>
</div>