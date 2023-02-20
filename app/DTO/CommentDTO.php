<?php

namespace App\DTO;

class CommentDTO
{
    public static function toArray($data)
    {
        return [
            'name' => $data['name'],
            'text' => $data['text'],
        ];
    }

    public static function toArrayOnUpdate($data,$name)
    {
        return [
            'name' => $name,
            'text' => $data['text'],
        ];
    }
}