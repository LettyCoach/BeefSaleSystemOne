<div class="myHeader">
    <div class="container">
        <div class="menu-item">
            <a href="/">ホーム</a>
            <a href="{{ route('purchases.index') }}">仕入</a>
            <a href="{{ route('transports.index') }}">仕入運送</a>
            <a href="{{ route('fatten.index') }}">肥育</a>
            <a href="">出荷指示</a>
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
</div>
