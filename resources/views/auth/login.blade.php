<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" style="margin-top: 100px;">
        @csrf
        <div class="container">

            <h1 class="text-center">ログイン</h1>
            <hr>

            <label for="email"><b>Eメール</b></label>
            <input type="text" placeholder="メールアドレスを入力" name="email" id="email" required>

            <label for="psw"><b>パスワード</b></label>
            <input type="password" placeholder="パスワードを入力してください" name="password" id="password" required>
            <hr>

            <button type="submit" class="registerbtn"><i class="fas fa-sign-in"></i> ログイン</button>
        </div>

        <div class="container signin">
            <p>アカウントがありませんか？ <a href="/register">ログイン</a>.</p>
        </div>
    </form>
</x-guest-layout>

<style>
    input[type=text],
    input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 20px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus,
    input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 10px;
    }

    /* Set a style for the submit/register button */
    .registerbtn {
        background-color: #6ea924;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity: 1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        text-align: center;
    }
</style>
