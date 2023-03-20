<x-guest-layout>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="d-flex justify-content-center align-items-center pt-5 mb-4 mx-auto " style ="min-height:calc(100vh - 300px); width:80%;">
        <div class="col-md-6 mt-5 mx-auto">
            <!-- form user info -->
            <div class="card card-outline-secondary mt-5">
                <div class="card-header">
                    <h3 class="mb-0 text-center">パスワード忘れました</h3>

                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('password.email') }}" autocomplete="off" class="form" role="form">
                        @csrf
                        @method('post')
                        <div class="form-group row p-2">
                            <label class="col-lg-4 col-form-label form-control-label d-flex justify-content-end">Eメール</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="text" id="email" name="email" placeholder="メールアドレスを入力" value="{{ old('email') }}" required>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        <div class="form-group row p-2 d-flex flex-content-center">
                            <label class="col-lg-4 col-form-label form-control-label"></label>
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-primary" style="background-color: #6ea924; border: 0;"><i class="fa fa-send"></i> 送信</button>
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
