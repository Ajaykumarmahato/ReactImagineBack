<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{


    public function index()
    {
        return Category::with('media')->get();
    }
    public function store($data)
    {
        $categoryData = jsonDecode('category', $data);
        $file = null;
        if (array_key_exists('file', $data)) {
            $file = $data['file'];
        }

        return DB::transaction(function () use ($categoryData, $file) {
            $category = Category::create($categoryData);
            if ($file) {
                $category->addMedia($file)->toMediaCollection('category');
            }
        });
    }
}
