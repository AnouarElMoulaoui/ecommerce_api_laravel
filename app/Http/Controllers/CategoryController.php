<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class CategoryController extends Controller
{
    //
    
    public function index(){
        $categories = Category::all(['id','slug','title','description','meta_title','meta_keyword','meta_description','status']);
        return response()->json([
           'status' => 200,
           'msg' => '',
           'data' => $categories  
        ]);
    }

    public function destroy($id){
        if(Category::destroy($id)){
            return response()->json([
                'status' => 200,
                'msg' => 'Success deleting category',
                'data' => null  
             ]);
        }
        return response()->json([
            'status' => 404,
            'msg' => 'problem to deleting category',
            'data' => null  
         ],404);
    }

    public function update(CategoryRequest $request){
        $category  = Category::find($request->id);
        $category->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'status' => $request->status == true ? 1 : 0
        ]);
        if($category){
            return response()->json([
                'status' => 200,
                'msg' => 'success update category' ,
                'data' => null
            ],200);
            
            return response()->json([
                'status' => 401,
                'msg' => 'faild update category' ,
                'data' => null
            ],401);

        }
    }

    public function store(CategoryRequest $request){
        $category = Category::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'status' => $request->status == true ? 1 : 0
        ]);
        if($category){
            return response()->json([
                'status' => 200,
                'msg' => 'success adding category' ,
                'data' => null
            ],200);
        }
         return response()->json([
            'status' => 401,
            'msg' => 'problem to adding category' ,
            'data' => null
        ],401);
    }
}
