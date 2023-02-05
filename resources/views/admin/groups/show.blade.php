@extends('adminlte::page')

@section('title', 'Группа ' . $group->name)

@section('content_header')
    <h1>Группа {{ $group->name }}</h1>
@stop

@section('content')
    <div>
        {{-- NAVIGATION --}}
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('groups.index') }}">
                <button type="button" class="btn btn-block btn-primary">
                    <i class="fas fa-arrow-left"></i> Список групп
                </button>
            </a>

            <div class="d-flex">
                @if ($group->deleted_at)
                    <form action="{{ route('groups.restore', $group->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-block btn-success">
                            <i class="fas fa-plus"></i> Восстановить
                        </button>
                    </form>
                @else
                    <a>
                        <button type="button" class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#editModal">
                            <i class="fas fa-edit"></i> Изменить
                        </button>
                    </a>
                    <a class="ml-2">
                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal"
                            data-target="#deleteModal">
                            <i class="fas fa-trash"></i> Удалить
                        </button>
                    </a>
                @endif

            </div>
        </div>

        {{-- USERS TABLE --}}
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
                                <tbody id='tableList'>
                                    @foreach ($group->users as $user)
                                        <a href="#">
                                            <tr class='clickable-row' data-href='{{ route('users.show', $user->id) }}'>
                                                <td class="dtr-control">{{ $user->id }}</td>
                                                <td>{{ $user->full_name }}</td>
                                                <td>{{ $user->email }}</td>
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

        {{-- DELETE MODAL --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title" id="deleteModalLabel">Удаление группы</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Вы уверены что хотите удалить группу {{ $group->name }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- EDIT MODAL --}}
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('groups.update', $group->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="editModal">Изменение группы</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="groupNameInput">Новое название группы. Текущее {{ $group->name }}</label>
                                <input type="text" class="form-control" id="groupNameInput" name="name"
                                    value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-warning">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (session('success'))
            <x-admin.alert colorClass="success" :message="session()->get('success')" />
        @endif

        @if ($errors->any())
            <x-admin.alert colorClass="danger" :message="$errors->first()" />
        @endif
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
