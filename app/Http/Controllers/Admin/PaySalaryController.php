<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaySalaryRequest;
use App\Paysalary;
use App\Salary;
use App\Service;
use App\TimeKeeping;
use App\User;
use Carbon\Carbon;
class PaySalaryController extends Controller
{
    public function index()
    {
        $pays = Paysalary::select('pay_salary.id', 'pay_salary.month', 'pay_salary.year', 'pay_salary.total', 'pay_salary.type', 'users.name')
            ->join('users', 'pay_salary.user_id', '=', 'users.id')
            ->orderBy('pay_salary.id', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        return view('admin.pay-salary.index', ['pays' => $pays]);
    }
    public function form_add()
    {
        $users = User::select('id', 'name')->whereIn('type', [User::EMPLOYEES])
            ->get();
        return view('admin.pay-salary.add', ['users'=>$users]);
    }
    public function add(PaySalaryRequest $request)
    {
        $salary = Salary::select('salary')->where('user_id', $request->input('user'))->first();
        if(empty($salary)) {
            return redirect(route('pay-salary.index'))->with('alert-danger', 'Bạn phải thêm lương người dùng');
        }

        $times = TimeKeeping::select('id', 'user_id')
            ->whereMonth('time', $request->input('month'))
            ->whereYear('time', $request->input('year'))
            ->where('user_id', $request->input('user'))
            ->get();

        Paysalary::create(
            [
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'user_id' => $request->input('user'),
                'type' => Paysalary::UNPAID,
                'total' => $salary->salary,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
        return redirect(route('pay-salary.index'))
            ->with('alert-success', trans('messages.successfully_created', ['name' => 'Lương']));

    }
    public function update($id)
    {
        Paysalary::where('id', trim($id))->update(['type' => Paysalary::PAID]);
        return redirect(route('pay-salary.index'))
            ->with('alert-success', 'Cập nhật trạng thái thành công');
    }

}
