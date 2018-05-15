<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\RawRequest;
use App\Raw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RawController extends Controller
{
    public function index(Request $request)
    {
        $categories = Raw::select('id', 'name', 'price', 'quantity', 'unit');
        if($request->has('name')) {
            $categories->where('name', 'like', "%{$request->input('name')}%");
        }
        $categories = $categories->orderBy('id', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        return view('admin.raw.index', ['categories' =>$categories]);
    }

    public function form_add()
    {
        $categories = Category::select('id', 'name')
            ->where('type', Category::TYPE_SERVICE)
            ->get();
        return view('admin.raw.add', ['categories' => $categories]);
    }

    public function add(RawRequest $request)
    {
        Raw::insert(
            [
                'name' => $request->input('name'),
                'description' => $request->input('desc'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'category_id' => $request->input('category'),
                'unit' => $request->input('unit')
            ]
        );

        return redirect(route('raw.index'))
            ->with('alert-success', trans('messages.successfully_created', ['name' => 'Nguyên liệu']));
    }
    public function form_edit($id)
    {

        $raw = Raw::select('id', 'name', 'price', 'quantity', 'unit', 'description')
            ->where('id', trim($id))->firstOrFail();

        $categories = Category::select('id', 'name')
            ->where('type', Category::TYPE_SERVICE)
            ->get();

        return view('admin.raw.edit', ['raw' => $raw, 'categories' => $categories]);
    }
    public function edit($id, RawRequest $request)
    {
        Raw::where('id', trim($id))
            ->update(
                [
                    'name' => $request->input('name'),
                    'description' => $request->input('desc'),
                    'price' => $request->input('price'),
                    'quantity' => $request->input('quantity'),
                    'category_id' => $request->input('category'),
                    'unit' => $request->input('unit')
                ]
            );

        return redirect(route('raw.index'))
            ->with('alert-success', trans('messages.successfully_updated', ['name' => 'Nguyên liệu']));
    }
    public function delete($id)
    {
        Raw::findOrFail(trim($id));
        Raw::where('id', trim($id))->delete();

        return redirect(route('raw.index'))
            ->with('alert-success', trans('messages.successfully_deleted', ['name' => 'Nguyên liệu']));
    }
}
