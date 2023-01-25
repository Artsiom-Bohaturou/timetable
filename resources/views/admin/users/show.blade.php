@extends('adminlte::page')

@section('title', 'Пользователь ' . $user->full_name)

@section('content_header')
    <h1>Пользователь {{ $user->full_name }}</h1>
@stop

@section('content')
    <div>
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('users.index') }}">
                <button type="button" class="btn btn-block btn-primary">
                    <i class="fas fa-arrow-left"></i> Назад
                </button>
            </a>

            <div class="d-flex">
                @if ($user->deleted_at)
                    <form action="{{ route('users.restore', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-block btn-success">
                            <i class="fas fa-plus"></i> Восстановить
                        </button>
                    </form>
                @else
                    <a href="{{ route('users.edit', $user->id) }}">
                        <button type="button" class="btn btn-block btn-warning">
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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Данные {{ $user->full_name }}</h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>#</td>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td>Логин</td>
                            <td>{{ $user->login }}</td>
                        </tr>
                        <tr>
                            <td>Адрес электронной почты</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                        <tr>
                            <td>Группа</td>
                            {{-- {{ route('group.show') }} --}}
                            <td><a href="#">{{ $user->group->name }}</a></td>
                        </tr>
                        <td>Дата регестрации</td>
                        <td>{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Дата последнего изменения</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                        @if ($user->deleted_at)
                            <tr>
                                <td>Дата удаления</td>
                                <td>{{ $user->deleted_at }}</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Удаление пользователя</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Вы уверены что хотите удалить пользователя группы {{ $user->group->name }} {{ $user->full_name }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <x-admin.alert colorClass="success" :message="session()->get('success')" />
        @endif
    </div>
@stop
