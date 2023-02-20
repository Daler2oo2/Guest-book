<?php 

namespace App\Interfaces;

interface AdsInterface {
    public function getAll();
    public function findByCategoryId($id);
    public function findById($id);
    public function create($data);
}