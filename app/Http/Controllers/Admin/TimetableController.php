<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateLessonRequest;
use App\Http\Requests\Admin\DeleteLessonRequest;
use App\Http\Requests\Admin\UpdateLessonRequest;
use App\Models\Group;
use App\Models\Lesson;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with('users')->get();

        return view('admin.timetables.index', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLessonRequest $request)
    {
        $data = $request->validated();
        $lesson = Lesson::create($data);

        return redirect()->route('timetable.show', $lesson->group_id)->with(['success' => 'Предмет успешно создан']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $weekNumber = $request->get('weekNumber') ?? 1;
        $group = Group::findOrFail($id);
        $lessonsRaw = $group->lessons()->where('week_number', $weekNumber)->get();
        $lessons = [];
        foreach ($lessonsRaw as $lesson) {
            $lessons[$lesson->day_number - 1][$lesson->lesson_start - 1] = $lesson;
        }

        return view('admin.timetables.show', compact('group', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonRequest $request)
    {
        $data = $request->validated();
        $lesson = Lesson::findOrFail($data['lesson_id']);
        $lesson->update($data);

        return redirect()->route('timetable.show', $lesson->group_id)->with(['success' => 'Предмет успешно изменен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteLessonRequest $request)
    {
        $id = $request->validated()['lesson_id'];
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('timetable.show', $lesson->group_id)->with(['success' => 'Предмет успешно удален']);
    }
}
