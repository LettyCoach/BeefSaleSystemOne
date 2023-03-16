<div class="panel-body">
    <div style="width: 100%; padding-left: -10px;">
        <div class="table-responsive">
            <table id="dtBasicExample" class="table table-striped table-fixed table-bordered table-sm"
                cellspacing="0" style="min-width: 1000px; overflow-x: scroll; width:100%">
                <thead>
                    <tr>
                        <th class="text-center">番号</th>
                        <th class="text-center">名前</th>
                        <th class="text-center">Eメール</th>
                        <th class="text-center">権限設定</th>
                        <th class="text-center">削除</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $counter = 1;
                    @endphp
                    @foreach ($users as $user)
                    <tr>
                        <td class="text-center">
                            <span class="break-all">{{ $counter++;}}</span>
                        </td>
                        <td class="text-center">
                            <span class="break-all" id = "userName{{ $user->id }}">{{ $user->name }}</span>
                        </td>
                        <td class="text-center">
                            <span class="break-all" id = "userEmail{{ $user->id }}">{{ $user->email }}</span>
                        </td>
                        <td class="text-center">
                            <span class="break-all">
                                <a href="javascript:;showAddRoleModal({{ $user->id }})">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="break-all">
                                <a href="javascript:;showConfirmModal({{$user->id}})">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </span>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>