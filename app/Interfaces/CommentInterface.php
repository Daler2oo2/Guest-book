<?php 

namespace App\Interfaces;

interface CommentInterface {
    public function getComments();
    public function findById($id);
    public function create($data);
    public function update($data,$id);
    public function delete($id);
}