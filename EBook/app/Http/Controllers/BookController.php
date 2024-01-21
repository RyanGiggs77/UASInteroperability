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
        $book = Book::with('categories')->orderBy("id", "DESC")->paginate(3)->toArray();

        $response = [
            "total_count" => $book["total"],
            "limit" => $book["per_page"],
            "paginate" => [
                "next_page" => $book["next_page_url"],
                "current_page" => $book["current_page"],
                "prev_page_url" => $book["prev_page_url"],
            ],
            "data" => $book["data"],
        ];


        return response()->json($response,200);
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
        
        $book = Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'deskripsi' => $request->deskripsi,
            'tahun_terbit' => $request->tahun_terbit,
        ]);

        $book->categories()->attach($request->categories);

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
        return response()->json(['message'=>'Book has been deleted','Book_id'=>$id ], 200);
    }

}
