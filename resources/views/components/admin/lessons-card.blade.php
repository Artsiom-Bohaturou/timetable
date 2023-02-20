<div class="card mx-2 col">
    <div class="card-header">
        {{ $dayName }}
    </div>
    <div class="card-body">
        <table class="table table-bordered dtr-inline">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Название предмета</th>
                    <th>Кабинет</th>
                    <th>ФИО предподавателя</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i <= 5; $i++)
                    <tr>
                        <th>{{ $i + 1 }}</th>
                        @if (isset($lessons[$i]))
                            <th>{{ $lessons[$i]->name }}</th>
                            <th>{{ $lessons[$i]->class_number }}</th>
                            <th>{{ $lessons[$i]->teacher_full_name }}</th>
                            <th class="d-flex justify-content-around">
                                <button class="btn btn-warning lessons_card_button" data-toggle="modal"
                                    data-target="#editModal" data-lesson_id="{{ $lessons[$i]->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger lessons_card_button" data-toggle="modal"
                                    data-target="#deleteModal" data-lesson_id="{{ $lessons[$i]->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </th>
                        @else
                            <th>-</th>
                            <th>-</th>
                            <th>-</th>
                            <th class="d-flex justify-content-center">
                                <button class="btn btn-success lessons_card_button" data-toggle="modal"
                                    data-target="#createModal" data-lesson_start="{{ $i + 1 }}"
                                    data-day_number="{{ [
                                        'Понедельник' => 1,
                                        'Вторник' => 2,
                                        'Среда' => 3,
                                        'Четверг' => 4,
                                        'Пятница' => 5,
                                        'Суббота' => 6,
                                    ][$dayName] }}"
                                    data-week_number="{{ request()->get('weekNumber') ?? 1 }}">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </th>
                        @endif
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
