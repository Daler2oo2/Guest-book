<?php 

namespace App\Repositories;

use App\Interfaces\AnswerInterface;
use App\Models\Answers;

class AnswerRepository implements AnswerInterface{

    public function findById($id)
    {
        return Answers::find($id);
    }  
    
    public function create($data)
    {
        return Answers::query()->create($data);
    }

    public function update($data, $id)
    {
        return Answers::query()->find($id)->update($data);
    }

    public function delete($id)
    {
        return Answers::query()->find($id)->delete();
    }
}