@extends('adminlte::page')

@section('title', 'Изменение пользователя')

@section('content_header')
    <h1>Изменение пользователя {{ $user->full_name }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3>Поля которые не изменять оставить пустыми</h3>
        </div>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="inputLogin">Новый Логин</label>
                    <label for="inputLogin">(Старый Логин: {{ $user->login }})</label>
                    <input type="text" class="form-control" id="inputLogin" placeholder="Введите логин" name="login"
                        value="{{ old('login') }}">
                    @error('login')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputFullName">Новое ФИО</label>
                    <label for="inputFullName">(Старое ФИО: {{ $user->full_name }})</label>
                    <input type="text" class="form-control" id="inputFullName" placeholder="Введите ФИО" name="full_name"
                        value="{{ old('full_name') }}">
                    @error('full_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail">Новый Адрес электронной почты</label>
                    <label for="inputEmail">(Старый Адрес электронной почты: {{ $user->email }})</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Введите адрес электронной почты"
                        name="email" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputPassword">Новый Пароль</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Введите пароль"
                        name="password" value="{{ old('password') }}">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputPasswordConfirm">Подтверждение пароля</label>
                    <input name="password_confirmation" type="password" placeholder="Подтверждение пароля"
                        class="form-control" id="inputPasswordConfirm">
                    @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="groupSelect">Выберите новую группу</label>
                    <label for="groupSelect">(Старая группа: {{ $user->group->name }})</label>
                    <select class="form-control" id="groupSelect" name="group_id">
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
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>

    @if ($errors->any())
        <x-admin.alert colorClass="danger" :message="$errors->first()" />
    @endif
@stop
