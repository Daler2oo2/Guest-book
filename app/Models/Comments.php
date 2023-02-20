<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answers;


class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'text'];
    
    
    public function answers(){
        return $this->hasMany(Answers::class);
    }


}
