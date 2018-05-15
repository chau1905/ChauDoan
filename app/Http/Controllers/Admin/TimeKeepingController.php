<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TimeKeepingRequest;
use App\Service;
use App\TimeKeeping;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class TimeKeepingController extends Controller
{
    public function index()
    {
        $timekeepings = TimeKeeping::select('time_keeping.id', 'time_keeping.type', 'time_keeping.user_id', 'users.type AS type_user', 'time_keeping.time', 'users.name')
            ->join('users', 'users.id', '=', 'time_keeping.user_id')
            ->orderBy('time_keeping.id', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        return view('admin.time-keeping.index', ['timekeepings' =>$timekeepings]);
    }

    public function form_add()
    {
        $users = User::select('id', 'name')->whereIn('type', [User::EMPLOYEES])
            ->get();
        return view('admin.time-keeping.add', ['users'=>$users]);
    }

    public function add(TimeKeepingRequest $request)
    {
        $data = [
            'user_id' => $request->input('user'),
            'type' => $request->input('type'),
            'time' => date('Y-m-d', strtotime($request->time)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        TimeKeeping::insert($data);

        return redirect(route('time-keeping.index'))
            ->with('alert-success', trans('messages.successfully_created', ['name' => 'Chấm công']));
    }
    public function detail($user_id)
    {
        $timekeepings = TimeKeeping::select('time_keeping.id', 'time_keeping.type', 'time_keeping.user_id', 'users.type AS type_user', 'time_keeping.time', 'users.name')
            ->join('users', 'users.id', '=', 'time_keeping.user_id')
            ->where('time_keeping.user_id', trim($user_id))
            ->orderBy('time_keeping.id', 'DESC')
            ->get();

        return view('admin.time-keeping.detail', ['timekeepings' => $timekeepings]);
    }

}
