@extends('adminlte::page')

@section('title', 'Расписание')

@section('content_header')
    <h1>Расписание групп</h1>
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
                                        Группа
                                    </th>
                                    <th tabindex="0" rowspan="1" colspan="1">
                                        Количество учащихся
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableList">
                                @foreach ($groups as $group)
                                    <a href="#">
                                        <tr class='clickable-row' data-href='{{ route('timetable.show', $group->id) }}'>
                                            <td class="dtr-control">{{ $group->id }}</td>
                                            <td>{{ $group->name }}</td>
                                            <td>{{ $group->users->count() }}</td>
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

@section('css')
    <style>
        .clickable-row {
            cursor: pointer;
        }
    </style>
@endsection
