@extends('layouts.commonUser')
@section('content')
<div class="justify-content-center mt-5 pt-5 mb-4">
    <div class="col-md-6 mt-5 mx-auto">
        <!-- form user info -->
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0 text-center">仕入登録</h3>

            </div>
            <div class="card-body">

                <form method="POST" action="{{ route('purchases.store') }}" autocomplete="off" class="form" role="form">
                    @csrf
                    @method('post')
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">個体識別番号</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" id="inline-registerNumber" name="registerNumber"
                                placeholder="1234567890123">
                            @error('registerNumber')<div class="text-danger">{{ $message }}</div>@enderror
                            @if($message = Session::get('info'))
                            <div class="text-danger">{{$message}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">和牛登録名</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="name" id="inline-name">
                            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">生年月日</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="date" name="birthday" id="inline-birthday"
                                value="{{date("Y-m-d")}}">
                            @error('birthday')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">性別</label>
                        <div class="col-lg-9">
                            <select id="sex" name="sex" class="form-control">
                                <option value="1" selected>雄</option>
                                <option value="0">雌</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">購入場所</label>
                        <div class="col-lg-9">
                            <select id="market_id" name="market_id" class="form-control">
                                @foreach($markets as $market)
                                <option value="{{$market->id}}">{{$market->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">運送会社</label>
                        <div class="col-lg-9">
                            <select id="purchaseTransport_Company_id" name="purchaseTransport_Company_id"
                                class="form-control">
                                @foreach($transportCompanies as $transportCompany)
                                <option value="{{$transportCompany->id}}">{{$transportCompany->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">搬送先</label>
                        <div class="col-lg-9">
                            <select id="pastoral_id" name="pastoral_id" class="form-control">
                                @foreach($pastorals as $pastoral)
                                <option value="{{$pastoral->id}}">{{$pastoral->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">購入金額</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="inline-purchasePrice" type="text" name="purchasePrice"
                                placeholder="5000">
                            @error('purchasePrice')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group row p-2 d-flex flex-content-center">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> セーブ</button>
                            <a href="{{ route('purchases.index') }}" class="btn btn-secondary"><i
                                    class="fa fa-rotate-left"></i> 取消</a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /form user info -->
    </div>
</div>
<!-- <script type="text/javascript">
    window.onload = function() {
        var today = new Date().toLocaleString("en-US", { timeZone: "Asia/Tokyo" }).split(',')[0];
        alert(today)
        document.getElementById("inline-birthday").setAttribute('max', today);
}
</script> -->
@endsection