@extends('adminlte::page')

@section('title', 'Пользователи')

@section('content_header')
    <h1>Список всех пользователей</h1>
@stop

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <div></div>
        <div>
            <a href="{{ route('users.create') }}">
                <button type="button" class="btn btn-block btn-primary">Создать нового пользователя</button>
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-head pt-4 pl-4">
            <form action="{{ route('users.index') }}" method="GET" id="addTrashed">
                <input id="withTrashed" type="checkbox" value="withTrashed" name="withTrashed"
                    @if (!!request()->get('withTrashed')) checked @endif>
                <label for="withTrashed">Показывать удаленных пользователей</label>
            </form>
        </div>
        <div class="card-body">
            <div id="user-list_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="user-list" class="table table-bordered table-hover dataTable dtr-inline">
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
                                        Группа
                                    </th>
                                    <th tabindex="0" rowspan="1" colspan="1">
                                        Дата регестрации
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <a href="#">
                                        <tr class='clickable-row' data-href='{{ route('users.show', $user->id) }}'>
                                            <td class="dtr-control">{{ $user->id }}</td>
                                            <td>{{ $user->full_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->group->name }}</td>
                                            <td>{{ $user->created_at }}</td>
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

    @if (session('success'))
        <x-admin.alert colorClass="danger" :message="session()->get('success')" />
    @endif
@stop

@section('js')
    <script>
        $(function() {
            $(".dataTable").DataTable({
                "info": false,
                // "aoColumns": [{
                //     "sTitle": "<input type='checkbox'></input>",
                //     "mDataProp": null,
                //     "sWidth": "20px",
                //     "sDefaultContent": "<input type='checkbox' ></input>",
                //     "bSortable": false
                // }]
            });
        });

        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });

        document.querySelector('#withTrashed')
            .addEventListener('click', () => document.querySelector('#addTrashed').submit());
    </script>
@endsection

@section('css')
    <style>
        .clickable-row {
            cursor: pointer;
        }
    </style>
@endsection
