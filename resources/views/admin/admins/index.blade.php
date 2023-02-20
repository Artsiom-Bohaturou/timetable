@extends('adminlte::page')

@section('title', 'Группы')

@section('content_header')
    <h1>Список администраторов</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <div id="user-list_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th tabindex="0" rowspan="1" colspan="1">
                                        #
                                    </th>
                                    <th tabindex="0" rowspan="1" colspan="1">
                                        Имя пользователя
                                    </th>
                                    <th tabindex="0" rowspan="1" colspan="1">
                                        Электронная почта
                                    </th>
                                    <th tabindex="0" rowspan="1" colspan="1">
                                        Дата регестрации
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableList">
                                @foreach ($admins as $admin)
                                    <a href="#">
                                        <tr>
                                            <td class="dtr-control">{{ $admin->id }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->created_at }}</td>
                                        </tr>
                                    </a>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection
