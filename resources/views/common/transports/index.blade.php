@extends('layouts.commonUser')
@section('content')
<div class="panel container mt-5 pt-5 ">
    <h2 class="text-center font-bold mt-5 fw-bold">積み込み</h2>
    <form action="navForm" id="navForm" method="post" class="d-flex justify-content-end">
        @csrf
        <div class="rounded-md">
            <select name="SelectCompany" class="form-select" id="SelectCompany" onchange="selectCompany()">
                @foreach($transportCompanies as $transportCompany)
                <option value="{{$transportCompany->id}}">{{$transportCompany->name}}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>

<div class="container mx-auto" id="content">
</div>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function register(id) {
    SelectCompany = $('#SelectCompany').val();
    ox_id = $('#ox_id' + id).val();
    loadDate = $('#loadDate' + id).val();
    $.post(
            "{{ route('transports.list')}}", {
                'SelectCompany': SelectCompany,
                'ox_id': ox_id,
                'loadDate': loadDate
            },
            function(data) {
                $('#content').html(data);
            },
        )
        .fail(function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        });
}

function cancel(id) {
    ox_id = $('#ox_id' + id).val();
    SelectCompany = $('#SelectCompany').val();
    $('#confirmModal').modal('hide');
    $.post(
            "{{ route('transports.list')}}", {
                'SelectCompany': SelectCompany,
                'ox_id': id,
                'loadDate': '1900-01-01'
            },
            function(data) {
                $('#content').html(data);
            },
        )
        .fail(function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        });
}

function unloadDateregister(id) {
    SelectCompany = $('#SelectCompany').val();
    ox_id = $('#ox_id' + id).val();
    unloadDate = $('#unloadDate' + id).val();
        $.post(
                "{{ route('transports.list')}}", {
                    'SelectCompany': SelectCompany,
                    'ox_id': ox_id,
                    'unloadDate': unloadDate
                },
                function(data) {
                    alert(data)
                    $('#content').html(data);
                },

            )
            .fail(function(jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            });
}

function unloadDatecancel(id) {
    ox_id = $('#ox_id' + id).val();
    SelectCompany = $('#SelectCompany').val();
    $('#confirmModal2').modal('hide');
    $.post(
            "{{ route('transports.list')}}", {
                'SelectCompany': SelectCompany,
                'ox_id': id,
                'unloadDate': '1900-01-01'
            },
            function(data) {
                 $('#content').html(data);  
            },
        )
        .fail(function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        });
}

function selectCompany() {

    $.post(
            "{{ route('transports.list')}}",
            $('#navForm').serialize(),
            function(data) {
                $('#content').html(data);
            }
        )
        .fail(function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        });
}

function status() {

    $.post(
            "{{ route('transports.list')}}",
            $('#navForm').serialize(),
            function(data) {
                $('#content').html(data);
            }
        )
        .fail(function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        });
}

function initFunction() {
    $.post(
            "{{ route('transports.list')}}",
            $('#navForm').serialize(),
            function(data) {
                $('#content').html(data);
            }
        )
        .fail(function(jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        });
}
initFunction();

function verifyFunction() {
    var date = new Date();
    var month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1)
    var day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate()
    var current_date = date.getFullYear() + "-" + month + "-" + day;
    var select_date = $('#loadDate').val();
    if (select_date > current_date) {
        toastr.warning('日付入力時にエラーが発生しました。<br>もう一度お試しください。');
        event.preventDefault();
        return;
    }
}
</script>

<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('assets/js/common/ship.js') }}"></script>

<script>
$(document).ready(function() {
    toastr.options = {
        'closeButton': true,
        'debug': false,
        'newestOnTop': false,
        'progressBar': false,
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
});
</script>
@endsection