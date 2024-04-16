<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserList extends Model
{
    use HasFactory;
    protected $fillable = ['name','user_id'];
    // protected $table = 'user_lists'; 

    public function user(): BelongsTo
    {
    return $this->belongsTo(
            User::class);
    }

    // public function books()
    // {
    //     return $this->belongsToMany(Book::class);
    // }
}
