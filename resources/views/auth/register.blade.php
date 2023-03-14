<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" style="margin-top: 100px;">
        @csrf
        <div class="container">

            <h1 class="text-center">会員登録</h1>
            <hr>

            <label for="name"><b>氏名</b></label>
            <input type="text" placeholder="名前を入力してください" name="name" id="name" required>

            <label for="email"><b>Eメール</b></label>
            <input type="text" placeholder="メールアドレスを入力" name="email" id="email" required>

            <label for="psw"><b>パスワード</b></label>
            <input type="password" placeholder="パスワードを入力してください" name="password" id="password" required>

            <label for="psw-repeat"><b>パスワードを繰り返す</b></label>
            <input type="password" placeholder="パスワードを再度入力してください" name="password_confirmation" id="password_confirmation" required>
            <hr>

            <button type="submit" class="registerbtn"><i class="fas fa-user-plus"></i> 登録</button>
        </div>

        <div class="container signin">
            <p>すでにアカウントを持っていますか? <a href="#">ログイン</a>.</p>
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
