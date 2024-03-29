<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Book extends Model 
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 'judul','penulis','deskripsi','tahun_terbit'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category','books_id','categories_id');
    }
    

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    


    /**
     * A post belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User');
    // }


}