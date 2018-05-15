<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Product;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $listProduct = Product::select('products.id', 'categories.name AS category', 'products.name', 'products.image', 'products.price', 'products.description');

            if ($request->has('name')) {
                $listProduct->where('products.name', 'like', "%{$request->input('name')}%");
            }
        $listProduct = $listProduct->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->orderBy('products.updated_at', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        return view('admin.product.index', ['products' => $listProduct]);
    }

    public function form_add()
    {
        $categories = Category::select('id', 'name')
            ->where('type', Category::TYPE_PRODUCT)
            ->get();
        return view('admin.product.add', ['categories' => $categories]);
    }

    public function add(AddProductRequest $request)
    {
        $fileName = time().'assadl.'.time().pathinfo($request->file('image-service')->getClientOriginalName(), PATHINFO_EXTENSION);
        $request->file('image-service')->storeAs('public/product', $fileName);

        Product::create(
            [
                'image' => $fileName,
                'category_id' => $request->input('category'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        return redirect(route('product.index'))
            ->with('alert-success', trans('messages.successfully_created', ['name' => trans('messages.product')]));
    }
    public function form_edit($id)
    {
        $categories = Category::select('id', 'name')
            ->where('type', Category::TYPE_PRODUCT)
            ->get();

        $product = Product::select('id', 'image', 'category_id', 'name', 'price', 'description')
            ->where('id', trim($id))
            ->firstOrFail();

        return view('admin.product.edit', ['product' => $product, 'categories' => $categories]);
    }


    public function edit($id, EditProductRequest     $request)
    {
        $data = [
            'category_id' => $request->input('category'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'updated_at' => Carbon::now()
        ];
        if ($request->hasFile('image-service')) {
            $fileName = time().'assadl.'.time().'.'.pathinfo($request->file('image-service')->getClientOriginalName(), PATHINFO_EXTENSION);
            $request->file('image-service')->storeAs('public/product', $fileName);
            $data['image'] = $fileName;

        }
        Product::where('id', trim($id))->update($data);

        return redirect(route('product.index'))
            ->with('alert-success', trans('messages.successfully_updated', ['name' => trans('messages.product')]));
    }
    public function delete($id)
    {
        Product::findOrFail(trim($id));
        Product::where('id', trim($id))->delete();

        return redirect(route('product.index'))
            ->with('alert-success', trans('messages.successfully_deleted', ['name' => trans('messages.product')]));
    }

    public function detail($id)
    {
        $product = Product::select('id', 'image', 'name', 'description', 'price AS price')->where('id', $id)->firstOrFail();
        return view('admin.product.detail', ['product' => $product]);
    }

    public function image($id)
    {
        $photo = Product::where('id', trim($id))
            ->first();

        if (empty($photo)) {
            return abort(404);
        }
        $path = storage_path().'/app/public/product/'.$photo->image;
        echo file_get_contents($path);
        return true;

    }
}
