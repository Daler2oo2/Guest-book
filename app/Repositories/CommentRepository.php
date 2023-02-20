<?php 

namespace App\Repositories;

use App\Interfaces\CommentInterface;
use App\Models\Comments;

class CommentRepository implements CommentInterface{
     
    public function getComments()
    {
        return Comments::query()->with('answers')->orderBy('created_at','desc')->get();
    }

    public function findById($id)
    {
        return Comments::find($id);
    }

    public function create($data)
    {
        return Comments::query()->create($data);
    }
 
    public function update($data, $id)
    {
        return Comments::query()->find($id)->update($data);
    }

    public function delete($id)
    {
        return Comments::query()->find($id)->delete();
    }
}