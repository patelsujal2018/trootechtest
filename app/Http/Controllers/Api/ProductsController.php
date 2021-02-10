<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        $productList = Product::with('categories.categoryName')->get();

        return response()->json([
            "data"=>$productList,
            "result"=>true
        ],200);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'categories' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "data"=>[
                    "errors"=>$validator->messages(),
                    "result"=>false
                ]
            ],400);
        } else {
            $product = Product::create([
                'name' =>  $request->name,
                'price' => $request->price,
            ]);

            foreach($request->categories as $category)
            {
                ProductCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $category
                ]);
            }

            if($product){
                return response()->json([
                    "data"=>$product,
                    "result"=>true
                ],200);
            }
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $product = Product::find($id);

        $categories = ProductCategory::where('product_id',$id)->select('category_id')->get();

        foreach($categories as $key => $category)
        {
            $oldcategories[$key] = $category->category_id;
        }

        return response()->json([
            "data"=>[
                "product"=>$product,
                "categories"=>$oldcategories
            ],
            "result"=>true
        ],200);        
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'categories' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "data"=>[
                    "errors"=>$validator->messages(),
                    "result"=>false
                ]
            ],400);
        } else {

            $product = Product::find($id);
            $product->name = $request->name;
            $product->price = $request->price;

            foreach($request->categories as $category)
            {
                ProductCategory::where('product_id',$id)->delete();
                ProductCategory::create([
                    'product_id' => $id,
                    'category_id' => $category
                ]);
            }
            
            if($product->save()){
                return response()->json([
                    "data"=>$product->id,
                    "result"=>true
                ],200);
            }
        }
    }

    public function destroy($id)
    {
        $result = Product::find($id)->delete();
        ProductCategory::where('product_id',$id)->delete();

        return response()->json([
            "data"=>$result,
            "result"=>true
        ],200);
    }
}
