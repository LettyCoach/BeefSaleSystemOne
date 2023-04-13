<x-app-layout>
    <div class="container mt-5 pt-5 mb-4" style="min-height: calc(100vh - 350px)">
        <nav aria-label="breadcrumb" class="mt-4 pt-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">部位カット</li>
            </ol>
        </nav>
        <h2 class="text-center fw-bold">部位カットリスト</h2>
        <div class="panel panel-primary container mx-auto">
            <div class="rounded-md d-flex justify-content-between mb-2 mt-2">
                <div class="rounded-md">
                    <select name="pageSize" class="form-select" id="pageSize" onchange="getPartsList()">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="rounded-md">
                    <input type="text" class = "form-control" onkeyup="getPartsList()" placeholder="部位カッを入力してください" id="partName">
                </div>
                <div class="rounded-md">
                    <a href="{{ route('parts.create') }}" class="btn btn-primary" style="background-color:#f05656;"><i class="fa fa-plus" aria-hidden="true"></i> 追加</a>
                </div>
            </div>
            <div class="panel-body">
                <div style="width: 100%; padding-left: -10px;">
                    <div class="table-responsive" id = "partsList">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmModal" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="part_id" class="d-none"></div>
                        <h5 class="modal-title" id="staticBackdropLabel">削除を確認する</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center">本当に削除しますか？</h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="background-color: #6ea924; border: 0;"
                            onclick="trashPart()"><i class="fas fa-check"></i> はい</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fas fa-times"></i> 取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/admin/PartMana.js')}}"></script>
         <!-- Toastr -->
         <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
         <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
         <script>
             $(document).ready(function(){
                 toastr.options = {
                     'closeButton': true,
                     'debug': false,
                     'newestOnTop': false,
                     'progressBar': true,
                     'positionClass': 'toast-top-right',
                     'preventDuplicates': false,
                     'showDuration': '1000',
                     'hideDuration': '1000',
                     'timeOut': '5000',
                     'extendedTimeOut': '1000',
                     'showEasing': 'swing',
                     'hideEasing': 'linear',
                     'showMethod': 'fadeIn',
                     'hideMethod': 'fadeOut',
                 }
             })
         </script>
        
             @if($message = Session::get('updateSuccess'))
             <script>
                 toastr.success("{{$message}}");
             </script>
             @endif @if($message = Session::get('registerSuccess'))
             <script>
                 toastr.success("{{$message}}");
             </script>
             @endif @if($message = Session::get('deleteSuccess'))
             <script>
                 toastr.success("{{$message}}");
             </script>
             @endif @if($message = Session::get('deleteError'))
             <script>
                 toastr.warning("{{$message}}");
             </script>
             @endif
</x-app-layout>