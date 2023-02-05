@extends('adminlte::page')

@section('title', 'Главная')

@section('content_header')
    <h1>Главная</h1>
@stop

@section('content')

    <div class="row">
        <x-admin.card url="{{ route('users.index') }}" colorClass="warning" icon="fas fa-user">
            <h3>{{ $usersCount }}</h3>
            <p>Количество пользователей</p>
        </x-admin.card>
        <x-admin.card url="/admin/timetable" colorClass="success" icon="fas fa-table">
            <h3>2</h3>
            <p>Осталось пар (to do)</p>
        </x-admin.card>
        <x-admin.card url="{{ route('groups.index') }}" colorClass="info" icon="fas fa-users">
            <h3>{{ $groupsCount }}</h3>
            <p>Количество групп</p>
        </x-admin.card>
    </div>


@stop
