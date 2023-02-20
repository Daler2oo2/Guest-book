<?php 

namespace App\Services;

use App\Repositories\CommentRepository;
use App\DTO\CommentDTO;

class CommentService {

    private $repository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->repository = $commentRepository;
    }

    public function commentUpdate($data,$id){
         $comment = $this->repository->findById($id);
         $data = CommentDTO::toArrayOnUpdate($data, $comment->name);
         return $this->repository->update($data,$id);
    }
}