<x-guest-layout>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="justify-content-center mt-5 pt-5 mb-4">
        <div class="col-md-6 mt-5 mx-auto">
            <!-- form user info -->
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0 text-center">ログイン</h3>

                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}" autocomplete="off" class="form" role="form">
                        @csrf
                        @method('post')
                        <div class="form-group row p-2">
                            <label class="col-lg-3 col-form-label form-control-label">Eメール</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" id="email" name="email" placeholder="メールアドレスを入力" required>
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label class="col-lg-3 col-form-label form-control-label">パスワード</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="form-group row p-2 d-flex flex-content-center">
                            <div class="col-3"></div>
                            <div class="col-9">
                                <p>アカウントがありませんか？ <a href="/register">会員登録</a></p>
                            </div>
                        </div>
                        <div class="form-group row p-2 d-flex flex-content-center">
                            <div class="col-3"></div>
                            <div class="col-9">
                                <a href="/forgot-password">パスワードをお忘れですか？</a>
                            </div>
                        </div>
                        
                        <div class="form-group row p-2 d-flex flex-content-center">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-primary" style="background-color: #6ea924; border: 0;"><i class="fa fa-sign-in"></i> ログイン</button>
                                <a href="javascript:;history.back();" class="btn btn-secondary"><i
                                        class="fa fa-rotate-left"></i> 取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /form user info -->
        </div>
    </div>
</x-guest-layout>
