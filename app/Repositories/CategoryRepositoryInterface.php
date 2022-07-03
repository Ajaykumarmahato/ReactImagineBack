<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function index($data);
    public function search($data);
    public function store($data);
    public function delete($id);
}
