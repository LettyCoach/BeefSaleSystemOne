@extends('layouts.commonUser')
@section('content')
<div class="justify-content-center mt-5 pt-5 mb-4">
    <div class="col-md-6 mt-5 mx-auto">
        <!-- form user info -->
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0 text-center fw-bold">編集</h3>
                <!-- @if($message = Session::get('info'))
                <div class="alert alert-info alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"
                            style="color:rgb(121, 121, 121)"></i></button>
                    <strong>{{$message}}</strong>
                </div>
                @endif -->
            </div>
            <div class="card-body">
 
                <form method="POST" action="{{ route('purchases.update',$ox->id) }}" autocomplete="off" class="form" role="form" id="EditForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">個体識別番号</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" id="inline-registerNumber" name="registerNumber"  value="{{old('registerNumber',$ox->registerNumber)}}">
                          
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">和牛登録名</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="name" id="inline-name" value="{{old('name',$ox->name)}}">
                          
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">生年月日</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="date" name="birthday" id="inline-birthday" value="{{old('birthday',$ox->birthday)}}">
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
                            <select id="market_id" name="market_id"
                                class="form-control">
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
                            <select id="pastoral_id" name="pastoral_id"
                                class="form-control">
                                @foreach($pastorals as $pastoral)
                                <option value="{{$pastoral->id}}">{{$pastoral->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">購入金額</label>
                        <div class="col-lg-9">
                            <input class="form-control" id="inline-purchasePrice" type="text" name="purchasePrice" value="{{$ox->purchasePrice}}">
                        </div>
                    </div>
                    <div class="form-group row p-2 d-flex flex-content-center">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                            <button type="button" class="btn btn-primary" onclick="Submit()"><i class="fa fa-save"></i> セーブ</button>
                            <a href="{{ route('purchases.index') }}" class="btn btn-secondary"><i class="fa fa-rotate-left"></i> 取消</a>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /form user info -->
    </div>
</div>

<script>
    function Submit() {
        
        // return;
        $("#EditForm").submit();
        toastr.success("{{ $message }}");
    }
</script>
@endsection