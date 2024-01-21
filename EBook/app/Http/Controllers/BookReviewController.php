<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        return BookReview::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $bookReview = BookReview::find($id);
        $bookReview->update($request->all());
        return $bookReview;
    }

    public function destroy($id)
    {
        BookReview::find($id)->delete();
        return response()->json(['message' => 'Record deleted successfully']);
    }
}
