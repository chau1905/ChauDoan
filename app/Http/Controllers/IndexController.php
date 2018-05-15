<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
//        dd($request->all());
        $categories = Category::select('id', 'name')
            ->where('type', Category::TYPE_PRODUCT)
            ->get();
        $listProduct = Product::select('products.id', 'categories.id AS idcategory', 'categories.name AS category', 'products.name', 'products.image', 'products.price', 'products.description')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id');

        if ($request->has('name') && $request->get('name') != '') {
            $listProduct = $listProduct->where('products.name', 'like', "%{$request->input('name')}%");
        }
        if ($request->has('category') && $request->get('category') != '') {
//            dd('hihihi');
            $listProduct = $listProduct->where('categories.id', '=', $request->get('category'));
        }
        $listProduct = $listProduct->orderBy('products.updated_at', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);

//        dd($listProduct);

        return view('frontend.index', ['products' => $listProduct, 'categories' => $categories]);
    }

    public function detail($id)
    {
        $product = Product::select('id', 'image', 'name', 'description', 'price');
        $product = $product->where('id', $id)->firstOrFail();
        return view('frontend.detail',['product' =>$product]);
    }

    public function about()
    {
        return view('frontend.about');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
}
