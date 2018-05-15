<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Language;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $listProduct = Product::select('products.id', 'brands.name AS brand','categories.name AS category', 'products.name', 'products.image', 'products.price', 'products.description');
        if ($request->has('name')) {
            $listProduct->where('products.name','like', "%{$request->input('name')}%");
        }
        $listProduct = $listProduct->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->orderBy('products.updated_at', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        return view('frontend.product', ['products'=> $listProduct]);
    }
    public function detail($id){

        return view('frontend.single');
    }
}
