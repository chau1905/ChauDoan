<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class UserController extends Controller
{

    public function index()
    {
        $users = User::select('id','name', 'type', 'email', 'updated_at')
            ->orderBy('updated_at', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        return view('admin.user.index', ['users'=>$users]);
    }

    public function form_add()
    {
        return view('admin.user.add');
    }
    public function add(UserRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'type' => $request->input('type'),
            'password' => bcrypt($request->input('password')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ];
        User::insert($data);
        $user = User::where('email', '=', $request['email'])->firstOrFail();

        $user->attachRole($request->input('type'));
        return redirect(route('user.index'))
            ->with('alert-success', trans('messages.successfully_created', ['name' => trans('messages.user')]));
    }

    public function form_edit($id)
    {
        $user = User::select('id')->where('id',$id)->firstOrFail();
        return view('admin.user.edit', ['user' => $user]);
    }

    public function edit($id, EditUserRequest $request)
    {
        User::where('id', trim($id))
            ->update(
                [
                    'password' => bcrypt($request->input('password')),
                ]
            );

        return redirect(route('user.index'))
            ->with('alert-success', trans('messages.successfully_updated', ['name' => trans('messages.user')]));
    }
    public function delete($id)
    {
        User::findOrFail(trim($id));
        User::where('id', trim($id))->delete();

        return redirect(route('user.index'))
            ->with('alert-success', trans('messages.successfully_deleted', ['name' => trans('messages.user')]));
    }
}
