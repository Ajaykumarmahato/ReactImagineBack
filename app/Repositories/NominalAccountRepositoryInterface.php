<?php

namespace App\Repositories;

interface NominalAccountRepositoryInterface
{
    public function store($data);
    public function index($data);
}
