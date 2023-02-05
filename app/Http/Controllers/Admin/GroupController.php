<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateGroupRequest;
use App\Http\Requests\Admin\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = Group::withTrashed(!!$request->get('withTrashed'))
            ->where('name', 'like', '%' . $request->get('groupName') . '%')
            ->orderBy('name')
            ->paginate(16);

        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGroupRequest $request)
    {
        $data = $request->validated();
        $group = Group::create($data);

        return redirect()->route('groups.show', $group->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::withTrashed()->findOrFail($id);

        return view('admin.groups.show', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, $id)
    {
        $data = $request->validated();
        Group::findOrFail($id)->updateOrFail($data);

        return redirect()->route('groups.show', $id)->with(['success' => 'Группа успешно обновлена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::destroy($id);

        return redirect()->route('groups.index')->with(['success' => 'Группа успешно удалена']);
    }

    public function restore($id)
    {
        Group::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('groups.show', $id)->with(['success' => 'Группа успешно восстановлена']);
    }
}
