<?php

namespace App\DTO;

class AdsDTO
{
    public static function toArray($data,$id)
    {
        return [
            'user' => $data['user'],
            'tel' => $data['tel'],
            'title' => $data['title'],
            'price' => $data['price'],
            'city' => $data['city'],
            'desc' => $data['text'],
            'category_id' => $id
        ];
    }

}