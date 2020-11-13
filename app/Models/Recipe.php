<?php

namespace App\Models;

use App\Models\User;
use App\Traits\UpdateImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory, UpdateImage;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

}
