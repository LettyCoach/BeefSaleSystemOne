@extends('layouts.commonUser')
@section('content')
<div class="justify-content-center mt-5 pt-5 mb-4">    
        <div class="card container mt-5 p-0 col-6">
            <div class="card-header">
                <h3 class="mb-0 text-center">部位カットの重さと価格</h3>
            </div>
            <div class="card-body">
                    <input type="hidden"  id="ox_id" class="form-control" value="{{$ox->id}}" />
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">個体識別番号</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly id="oxRegisterNumber" name="registerNumber"
                                value="{{$ox->registerNumber}}" disabled />
                            @error('registerNumber')<div class="text-danger">{{ $message }}</div>@enderror
                            @if($message = Session::get('info'))
                            <div class="text-danger">{{$message}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">和牛登録名</label>
                        <div class="col-lg-9">
                            <input type="text" readonly id="name" class="form-control" value="{{$ox->name}}"
                                disabled />
                            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">生年月日</label>
                        <div class="col-lg-9">
                            <input type="text" name="birthday" readonly id="oxBirth" class="form-control" value="{{$ox->birthday}}"
                                disabled />
                            @error('birthday')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group row p-2">
                        <label class="col-lg-3 col-form-label form-control-label">性別</label>
                        <div class="col-lg-9">
                            <input type="text" readonly id="oxSex" class="form-control" value=@if($ox->sex==1) 雄 @else 雌 @endif
                            disabled />
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between p-2">
                        <div class="rounded-md">
                            <div class="input-group">
                                <span class="input-group-text" id="">部位</span>
                                <select name="part" class="form-select col-8" id = "part_id">
                                    @foreach ($parts as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="rounded-md">
                            <div class="input-group">
                                <span class="input-group-text" id="">重さ</span>
                                <input type="text" class = "form-control"  id = "weight">
                            </div>
                        </div>
                        <div class="rounded-md">
                            <div class="input-group">
                                <span class="input-group-text" id="">価格</span>
                                <input type="text" class = "form-control" id = "price" >
                            </div>
                        </div>
                        <div class="rounded-md">
                            <div class="rounded-md">
                                <a type="button" href="javascript:;addPartRegister()" class="btn btn-success" style="background-color: #f05656; border: 0;"><i class="fa fa-plus"></i> 追加</a>
                            </div>
                        </div>
                    </div>  
                    
                    <div class="p-2" id = "registerList">

                    </div>
                <div class="row mb-4 ">
                    <div class="col-12 d-flex justify-content-between">
                        <a href="{{route('meats.index')}}" class="btn btn-secondary mb-4 mx-auto"><i
                                class="fa fa-rotate-left" aria-hidden="true"></i> バック</a>
                    </div>
                </div>
            </div>
        </div><!-- /form user info -->

</div>


<div class="modal fade" id="updateModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">更新</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row form-group d-flex justify-content-between p-2">
                    <input type="hidden" id="ox_idModal" name='ox_idModal'>
                    <input type="hidden" id="part_idModal" name='part_idModal'>    
                    <div class="rounded-md mb-4">
                        <div class="input-group">
                            <span class="input-group-text pe-4" id="">部位</span>
                            <input type="text" id="PartNameModal" name="PartNameModal" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="rounded-md mb-4">
                        <div class="input-group">
                            <span class="input-group-text pe-4" id="">重さ</span>
                            <input type="text" id="WeightModal" name="WeightModal" class="form-control"  required>
                        </div>
                    </div>
                    <div class="rounded-md mb-4">
                        <div class="input-group">
                            <span class="input-group-text pe-4" id="">価格</span>
                            <input type="text" id="PriceModal" name="PriceModal" class="form-control" value="" >
                        </div>
                    </div>
                </div>  
                <div class="row rounded-md d-flex justify-content-center">
                        <a type="button" href="javascript:;updatePartRegister()" class="btn btn-success" style="background-color: #f05656; width:100px;m-auto;border: 0;"><i class="fa fa-plus"></i> 更新</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/common/registerList.js')}}"></script>

<style>
    .input-group .input-group-text {
        height: calc(2.08rem + 2px);
    }

    .input-group-text {
        background-color: transparent;
        padding-top: 0.26rem;
        padding-bottom: 0.26rem;
    }

    .input-group-text {
        display: flex;
        height: 100% !important;
        align-items: center;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.6;
        color: #4f4f4f;
        text-align: center;
        white-space: nowrap;
        background-color: #eee;
        border: 1px solid #bdbdbd;
        border-radius: 0.25rem;
    }
</style>
@endsection