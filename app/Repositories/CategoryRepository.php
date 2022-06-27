<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{


    public function index()
    {
        return Category::where('user_id',Auth::id())->with('media')->get();
    }
    public function store($data)
    {
        $categoryData = jsonDecode('category', $data);
        $file = null;
        if (array_key_exists('file', $data)) {
            $file = $data['file'];
        }

        return DB::transaction(function () use ($categoryData, $file) {
            $categoryData['user_id']=Auth::id();
            $category = Category::create($categoryData);
            if ($file) {
                $category->addMedia($file)->toMediaCollection('category');
            }
        });
    }

    public function delete($id)
    {
        return Category::where('id', $id)->delete();
    }
}
