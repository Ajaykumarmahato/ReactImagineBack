<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function index();
    public function store($data);
}
