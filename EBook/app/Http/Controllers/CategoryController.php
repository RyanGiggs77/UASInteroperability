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
        $category = Category::with('books')->OrderBy("id", "ASC")->paginate(10)->toArray();

        $response = [
            "total_count" => $category["total"],
            "limit" => $category["per_page"],
            "paginate" => [
                "next_page" => $category["next_page_url"],
                "current_page" => $category["current_page"],
                "prev_page_url" => $category["prev_page_url"],
            ],
            "data" => $category["data"],
        ];
    

        return response()->json($response,200);
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