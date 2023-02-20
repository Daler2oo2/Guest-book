<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user',
        'tel',
        'title',
        'desc',
        'price',
        'city',
        'images',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    protected $casts = [
        'images' => 'array'
    ];

}
