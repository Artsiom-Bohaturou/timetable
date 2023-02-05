@extends('adminlte::page')

@section('title', 'Создание пользователя')

@section('content_header')
    <h1>Создание нового пользователя</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="inputLogin">Логин<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputLogin" placeholder="Введите логин" name="login"
                        value="{{ old('login') }}" required>
                    @error('login')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputFullName">ФИО<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputFullName" placeholder="Введите ФИО" name="full_name"
                        value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail">Адрес электронной почты<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Введите адрес электронной почты"
                        name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputPassword">Пароль<span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Введите пароль"
                        name="password" value="{{ old('password') }}" required>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputPasswordConfirm">Подтверждение пароля<span class="text-danger">*</span></label>
                    <input name="password_confirmation" type="password" placeholder="Подтверждение пароля"
                        class="form-control" required id="inputPasswordConfirm">
                    @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="groupSelect">Выберите группу<span class="text-danger">*</span></label>
                    <select class="form-control" id="groupSelect" name="group_id" required>
                        <option disabled selected>Группа не выбрана</option>
                        @foreach ($groups as $group)
                            <option @if (old('group_id') == $group->id) selected @endif value="{{ $group->id }}">
                                {{ $group->name }}</option>
                        @endforeach
                    </select>
                    @error('group_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('users.index') }}"><button type="button" class="btn btn-secondary">Отменить</button></a>
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </form>
    </div>

    @if ($errors->any())
        <x-admin.alert colorClass="danger" :message="$errors->first()" />
    @endif
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#groupSelect').select2();
        });
    </script>
@stop
