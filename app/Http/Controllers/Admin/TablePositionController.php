<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TableRequest;
use App\TablePosition;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TablePositionController extends Controller
{
    public function index(Request $request)
    {
        $categories = TablePosition::select('id', 'name');
        if($request->has('name')) {
            $categories->where('name', 'like', "%{$request->input('name')}%");
        }
        $categories = $categories->orderBy('id', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        return view('admin.table.index', ['categories' =>$categories]);
    }

    public function form_add()
    {
        return view('admin.table.add');
    }

    public function add(TableRequest $request)
    {
        TablePosition::insert(
            [
                'name' => $request->input('name'),
                'description' => $request->input('desc'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        return redirect(route('table.index'))
            ->with('alert-success', trans('messages.successfully_created', ['name' => 'Bàn']));
    }
    public function form_edit($id)
    {

        $category = TablePosition::select('id', 'name', 'description')
            ->where('id', trim($id))->firstOrFail();

        return view('admin.table.edit', ['category' => $category]);
    }
    public function edit($id, TableRequest $request)
    {
        TablePosition::where('id', trim($id))
            ->update(
                [
                    'name' => $request->input('name'),
                    'description' => $request->input('desc'),
                    'updated_at' => Carbon::now()
                ]
            );

        return redirect(route('table.index'))
            ->with('alert-success', trans('messages.successfully_updated', ['name' => 'Bàn']));
    }
    public function delete($id)
    {
        TablePosition::findOrFail(trim($id));
        TablePosition::where('id', trim($id))->delete();

        return redirect(route('table.index'))
            ->with('alert-success', trans('messages.successfully_deleted', ['name' => 'Bàn']));
    }
}
