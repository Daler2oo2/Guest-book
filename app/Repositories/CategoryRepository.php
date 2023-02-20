<?php 

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface{

    public function getAll()
    {
        return Category::all();
    }  

    public function findBySlug($slug)
    {
        return Category::where('slug', $slug)->get();
    }
    
}