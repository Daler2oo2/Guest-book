<?php 

namespace App\Interfaces;

interface CategoryInterface {
    public function getAll();
    public function findBySlug($slug);
}