<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index()
    {
        $categoryList = Category::with('parent')->get();

        return response()->json([
            "data"=>$categoryList,
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
            'parent' => 'numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                "errors"=>$validator->messages(),
                "result"=>false
            ],400);
        } else {
            $result = Category::create([
                'name'=>$request->name,
                'parent'=>$request->parent
            ]);
            if($result){
                return response()->json([
                    "data"=>$result,
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
        $category = Category::find($id);

        return response()->json([
            "data"=>$category,
            "result"=>true
        ],200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'parent' => 'numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                "errors"=>$validator->messages(),
                "result"=>false
            ],400);
        } else {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->parent = $request->parent;
            if($category->save()){
                return response()->json([
                    "data"=>$category->id,
                    "result"=>true
                ],200);
            }
        }
    }

    public function destroy($id)
    {
        $result = ProductCategory::where('category_id',$id)->delete();
        $result = Category::find($id)->delete();

        return response()->json([
            "data"=>$result,
            "result"=>true
        ],200);
    }
}
