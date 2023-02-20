<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $users = User::with('group')
            ->select('id', 'full_name', 'email', 'created_at', 'group_id', 'deleted_at')
            ->withTrashed(!!$request->get('withTrashed'))
            ->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $groups = Group::all();

        return view('admin.users.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);

        return redirect()->route('users.show', $user->id)->with(["success" => 'Пользователь успешно создан']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $groups = Group::all();

        return view('admin.users.edit', compact('user', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();
        User::findOrFail($id)->updateOrFail($data);

        return redirect()->route('users.show', $id)->with(['success' => 'Пользователь успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('users.index')->with(['success' => 'Пользователь успешно удален']);
    }

    /**
     * Restores deleted resource
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('users.show', $id)->with(['success' => 'Пользователь успешно восстановлен']);
    }
}
