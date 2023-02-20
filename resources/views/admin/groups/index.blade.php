@extends('adminlte::page')

@section('title', 'Группы')

@section('content_header')
    <h1>Список всех групп</h1>
@stop

@section('content')
    {{-- COLORS --}}
    @php
        $count = 0;
        
        function getColor()
        {
            global $count;
            $colors = ['success', 'primary', 'danger', 'dark', 'warning', 'white'];
            $colorIndex = $count % count($colors);
            $count++;
            return $colors[$colorIndex];
        }
    @endphp

    {{-- SEARCH --}}
    <div class="row px-3 mb-2">
        <div>
            <form action="{{ route('groups.index') }}" method="GET" id="addTrashed">
                <input id="withTrashed" type="checkbox" value="1" name="withTrashed"
                    @if (!!request()->get('withTrashed')) checked @endif>

                @if (request()->get('page'))
                    <input hidden name='page' value="{{ request()->get('page') }}">
                @endif

                @if (request()->get('groupName'))
                    <input hidden name='groupName' value="{{ request()->get('groupName') }}">
                @endif
                <label for="withTrashed">Показывать удаленные группы</label>
            </form>
        </div>

        <div class="ml-auto">
            <form action="{{ route('groups.index') }}" method="GET" id="search" class="d-flex align-items-center">
                <input class="mr-2 py-1 pr-4 pl-1" id="groupName" name="groupName" placeholder="Поиск группы">

                @if (request()->get('withTrashed'))
                    <input hidden name='withTrashed' value="{{ request()->get('withTrashed') }}">
                @endif

                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>

    {{-- GROUP LIST --}}
    <div class="row">
        @foreach ($groups as $group)
            <x-admin.card url="{{ route('groups.show', $group->id) }}" colorClass="{{ getColor() }}" icon="fas fa-users">
                <h2>{{ $group->name }}</h2>
                @if ($group->deleted_at)
                    <p>Группа удалена {{ $group->deleted_at }}</p>
                @else
                    <p>Группа создана {{ $group->created_at }}</p>
                @endif
            </x-admin.card>
        @endforeach
    </div>

    {{-- ADD BUTTON --}}
    <div class="row absolute-bottom mt-4 mr-1">
        <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Добавить группу
        </button>
    </div>

    <div class="row absolute-bottom mt-4">
        <div class="mx-auto">{{ $groups->withQueryString()->links('pagination::bootstrap-4') }}</div>
    </div>

    {{-- CREATE GROUP MODAL --}}
    <x-admin.modal modalId="createModal" :route="route('groups.store')" method="POST" color="primary" modalTitle="Создание новой группы"
        buttonName="Создать">
        <div class="form-group">
            <label for="groupNameInput">Название группы</label>
            <input type="text" class="form-control" id="groupNameInput" name="name" value="{{ old('name') }}">
        </div>
    </x-admin.modal>

    @if ($errors->any())
        <x-admin.alert colorClass='danger' :message="$errors->first()" />
    @endif
    @if (session('success'))
        <x-admin.alert colorClass='success' :message="session()->get('success')" />
    @endif
@stop

@section('js')
    <script>
        document.querySelector('#withTrashed')
            .addEventListener('click', () => document.querySelector('#addTrashed').submit());
    </script>
@stop
