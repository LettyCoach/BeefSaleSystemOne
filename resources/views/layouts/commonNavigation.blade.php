<div class="myHeader h-24 flex items-center">
    <div class="container flex justify-between items-center">
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
                <a class="p-3" href="">出荷運搬</a>
                <a class="p-3" href="">屠殺</a>
                <a class="p-3" href="">精肉管理</a>
                @auth
                <a class="pr-0" href="/logout">ログアウト</a>
                @else
                <a class="p-3" href="/login">ログイン</a>
                <a class="p-3 pr-0" href="/register">会員登録</a>
                @endauth
            </div>
        </div>
    </div>
</div>


<!-- <div class="myHeader">
    <div class="container">
        <div class="menu-item">
            <a href="/">ホーム</a>
            <a href="{{ route('purchases.index') }}">仕入</a>
            <a href="{{ route('transports.index') }}">仕入運送</a>
            <a href="{{ route('fatten.index') }}">肥育</a>
            <a href="{{ route('ship.index') }}">出荷指示</a>
            <a href="">出荷運搬</a>
            <a href="">屠殺</a>
            <a href="">精肉管理</a>
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
</div> -->
