<?php 

namespace App\Repositories;

use App\Interfaces\AdsInterface;
use App\Models\Ads;

class AdsRepository  implements  AdsInterface
{
    public function getAll()
    {
        return Ads::query()->orderBy('created_at','desc')->get();
    }

    public function findByCategoryId($id)
    {
         return Ads::query()->where('category_id',$id)->orderBy('created_at','desc')->get();
    }

    public function findById($id)
    {
        return Ads::query()->find($id);
    }

    public function create($data)
    {
        return Ads::query()->create($data);
    }
}