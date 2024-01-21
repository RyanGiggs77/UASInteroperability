<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{
    protected $table = 'book_reviews';
    protected $fillable = ['user_id', 'book_id', 'rating', 'review'];
}