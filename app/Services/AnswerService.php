<?php 

namespace App\Services;

use App\Repositories\AnswerRepository;
use App\DTO\AnswerDTO;

class AnswerService {

    private $repository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->repository = $answerRepository;
    }

    public function answerUpdate($data,$id){
         $answer = $this->repository->findById($id);
         $data = AnswerDTO::toArrayOnUpdate($data, $answer);
         return $this->repository->update($data,$id);
    }
}