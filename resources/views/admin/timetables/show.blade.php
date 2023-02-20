@extends('adminlte::page')

@section('title', 'Расписание')

@section('content_header')
    <h1>Расписание группы <a href="{{ route('groups.show', $group->id) }}">{{ $group->name }}</a></h1>
@stop

@section('content')
    <div class="mb-4">
        <p>Неделя:</p>
        @for ($i = 1; $i <= 4; $i++)
            <a class="select-week mr-3 @if ((request()->get('weekNumber') ?? 1) == $i) selected @endif"
                href="{{ route('timetable.show', $group->id) }}?weekNumber={{ $i }}">{{ $i }}</a>
        @endfor
    </div>

    <div id="lessons">
        <div class="row">
            <x-admin.lessons-card dayName="Понедельник" :lessons="$lessons[0] ?? null" />
            <x-admin.lessons-card dayName="Вторник" :lessons="$lessons[1] ?? null" />
        </div>
        <div class="row">
            <x-admin.lessons-card dayName="Среда" :lessons="$lessons[2] ?? null" />
            <x-admin.lessons-card dayName="Четверг" :lessons="$lessons[3] ?? null" />
        </div>
        <div class="row">
            <x-admin.lessons-card dayName="Пятница" :lessons="$lessons[4] ?? null" />
            <x-admin.lessons-card dayName="Суббота" :lessons="$lessons[5] ?? null" />
        </div>
    </div>

    <x-admin.modal modalId="createModal" :route="route('timetable.store')" method="POST" color="success" modalTitle="Добавление пары"
        buttonName="Добавить" formId="createForm">
        <div class="form-group">
            <label>Название предмета</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>ФИО предподователя</label>
            <input type="text" class="form-control" name="teacher_full_name" value="{{ old('teacher_full_name') }}">
        </div>
        <div class="form-group">
            <label>Кабинет</label>
            <input type="text" class="form-control" name="class_number" value="{{ old('class_number') }}">
        </div>
        <input hidden name="week_number" id="weekNumberInput">
        <input hidden name="lesson_start" id="lessonStartInput">
        <input hidden name="day_number" id="dayNumberInput">
        <input hidden name="group_id" value="{{ $group->id }}">
    </x-admin.modal>

    <x-admin.modal modalId="editModal" :route="route('timetable.update')" method="PATCH" color="warning" modalTitle="Изменение расписания"
        buttonName="Изменить">
        <label>Пустые поля изменены не будут</label>
        <div class="form-group">
            <label>Название предмета</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>ФИО предподователя</label>
            <input type="text" class="form-control" name="teacher_full_name" value="{{ old('teacher_full_name') }}">
        </div>
        <div class="form-group">
            <label>Кабинет</label>
            <input type="text" class="form-control" name="class_number" value="{{ old('class_number') }}">
        </div>
        <input hidden name="lesson_id" id="lessonIdInput">
    </x-admin.modal>

    <x-admin.modal modalId="deleteModal" :route="route('timetable.destroy')" method="DELETE" color="danger" modalTitle="Удалить предмет?"
        buttonName="Удалить">
        <div class="form-group">
            <label>Вы уверены что хотите удалить этот предмет?</label>
        </div>
        <input hidden name="lesson_id" id="lessonIdInput">
    </x-admin.modal>

    @if ($errors->any())
        <x-admin.alert colorClass="danger" :message="$errors->first()" />
    @endif
    @if (session('success'))
        <x-admin.alert colorClass="success" :message="session()->get('success')" />
    @endif
@stop

@section('css')
    <style>
        .select-week {
            color: black;
            text-decoration: none;
            font-size: 20px;
        }

        .select-week:hover {
            color: gray;
        }

        .selected {
            color: gray;
            text-decoration: underline;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('js/lessonsCard.js') }}"></script>
@stop
