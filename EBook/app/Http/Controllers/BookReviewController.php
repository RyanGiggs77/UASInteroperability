<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookReview; // Adjust the namespace to reflect the correct location
use Illuminate\Http\Request;

class BookReviewController extends Controller
{
    public function index()
    {
        return BookReview::all();

    }
    

    public function show($id)
    {
        return BookReview::find($id);
    }

    public function store(Request $request, $id)
    {

        $userId = auth()->user()->id;
        $bookId = $id;

        $bookReview =  BookReview::create([
            'review' => $request->review,
            'rating' => $request->rating,
            'book_id' => $bookId,
            'user_id' => $userId,
        ]);

        return response()->json($bookReview, 201);
    }

    public function update(Request $request, $id)
    {
        $userId = auth()->user();

        $bookReview = BookReview::where('id', $id)
        ->where('user_id', $userId->id)
        ->first();

        if(!$bookReview){
            return response()->json(['error'=> 'You can only edit your own review']);
        }

        $bookReview = BookReview::find($id);
        
        $bookReview->update([
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return response()->json($bookReview, 200);
    }

    public function destroy($id)
    {
        $userId = auth()->user();

        $bookReview = BookReview::where('id', $id)
        ->where('user_id', $userId->id)
        ->first();

        if(!$bookReview){
            return response()->json(['error'=> 'You can only delete your own review']);
        }

        BookReview::find($id)->delete();
        return response()->json(['message' => 'Record deleted successfully']);
    }
}
