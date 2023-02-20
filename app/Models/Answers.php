<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;
class Answers extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'text', 'comments_id'];


    public function comment(){
        return $this->belongsTo(Comments::class);
    }
}
