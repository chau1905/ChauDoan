<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SalaryRequest;
use App\User;
use App\Http\Controllers\Controller;
use App\Salary;
use Carbon\Carbon;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::select('salary.id', 'salary.salary', 'users.type','users.name', 'salary.updated_at')
            ->leftJoin('users', 'salary.user_id', '=', 'users.id')
            ->orderBy('salary.id', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        return view('admin.salary.index', ['salaries' =>$salaries]);
    }

    public function form_add()
    {
        $users = User::select('id', 'name')->whereIn('type', [User::EMPLOYEES])
            ->get();
        return view('admin.salary.add', ['users' => $users]);
    }

    public function add(SalaryRequest $request)
    {
        Salary::insert(
            [
                'user_id' => $request->input('user'),
                'salary' => $request->input('salary'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        return redirect(route('salary.index'))
            ->with('alert-success', trans('messages.successfully_created', ['name' => 'Lương nhân viên']));
    }
    public function form_edit($id)
    {
        $users = User::select('id', 'name')->whereIn('type', [User::EMPLOYEES])->get();
        $salary = Salary::select('id', 'user_id', 'salary')
            ->where('id', trim($id))->firstOrFail();

        return view('admin.salary.edit', ['salary' => $salary, 'users' => $users]);
    }
    public function edit($id, SalaryRequest $request)
    {
        $data = [
            'user_id' => $request->input('user'),
            'salary' => $request->input('salary'),
            'updated_at' => Carbon::now()
        ];
        Salary::where('id', trim($id))->update($data);

        return redirect(route('salary.index'))
            ->with('alert-success', trans('messages.successfully_updated', ['name' => 'Lương nhân viên']));
    }

    public function delete($id)
    {
        Salary::findOrFail(trim($id));
        Salary::where('id', trim($id))->delete();

        return redirect(route('salary.index'))
            ->with('alert-success', trans('messages.successfully_deleted', ['name' => 'Lương nhân viên']));
    }
}
