<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $book = Book::OrderBy("id", "DESC")->paginate(3)->toArray();

        $output = [
            'message' => 'book',
            'results' => $book
        ];

        return response()->json($output,200);
    }

    public function show($id)
    {
        $books = Book::find($id);

        if(!$books){
            abort(404);
        }

        $output = [
            'message' => 'books',
            'results' => $books
        ];

        return response()->json($output,200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $book = Book::create($input);

        return response()->json($book, 200);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->update($request->all());
        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        Book::find($id)->delete();
        return response()->json(['message'=>'Book has been deleted','Book_id'=>'$id' ], 200);
    }
}
