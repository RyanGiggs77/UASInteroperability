<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::OrderBy("id", "DESC")->paginate(3)->toArray();

        $output = [
            'message' => 'category',
            'results' => $category
        ];

        return response()->json($output,200);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if(!$category){
            abort(404);
        }

        $output = [
            'message' => 'category',
            'results' => $category
        ];

        return response()->json($output,200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $category = Category::create($input);

        return response()->json($category, 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json(['message'=>'Category $id has been deleted'], 200);
    }
}