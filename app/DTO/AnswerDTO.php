<?php

namespace App\DTO;

use Faker\Provider\Lorem;

class AnswerDTO
{
    public static function toArray($data,$id)
    {
        return [
            'name' => $data['name'],
            'text' => $data['text'],
            'comments_id' => $id
        ];
    }

    public static function toArrayOnUpdate($data,$answer)
    {
        return [
            'name' => $answer->name,
            'text' => $data['text'],
            'comments_id' => $answer->comments_id
        ];
    }
}
