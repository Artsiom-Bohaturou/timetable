@extends('adminlte::page')

@section('title', 'Группа ' . $group->name)

@section('content_header')
    <h1>Группа {{ $group->name }}</h1>
@stop

@section('content')
    <div>
        {{-- NAVIGATION --}}
        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex">
                <a href="{{ route('groups.index') }}" class="mr-2">
                    <button type="button" class="btn btn-block btn-primary">
                        <i class="fas fa-arrow-left"></i> Список групп
                    </button>
                </a>
                <a href="{{ route('timetable.show', $group->id) }}">
                    <button type="button" class="btn btn-block btn-info">
                        <i class="fas fa-table"></i> Расписание
                    </button>
                </a>
            </div>

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
        <x-admin.modal modalId="deleteModal" :route="route('groups.destroy', $group->id)" method="DELETE" color="danger" modalTitle="Удаление группы"
            buttonName="Удалить">
            Вы уверены что хотите удалить группу {{ $group->name }}?
        </x-admin.modal>

        {{-- EDIT MODAL --}}
        <x-admin.modal modalId="editModal" :route="route('groups.update', $group->id)" method="PATCH" color="warning" modalTitle="Изменение группы"
            buttonName="Изменить">
            <div class="form-group">
                <label for="groupNameInput">Новое название группы. Текущее {{ $group->name }}</label>
                <input type="text" class="form-control" id="groupNameInput" name="name" value="{{ old('name') }}">
            </div>
        </x-admin.modal>

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
