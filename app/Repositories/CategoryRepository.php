<?php

namespace App\Repositories;

use App\Models\Category;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{


    public function index($data)
    {

        $pageNumber=$data['pageNumber'];
        $offset=($pageNumber-1)* itemsPerPage();
       
        return Category::where('user_id', Auth::id())->with('media')->limit(itemsPerPage())->offset($offset)->get();
        
    }


    public function search($data)
    {
        $pageNumber=$data['pageNumber'];
        $offset=($pageNumber-1)* itemsPerPage();
        return Category::where('user_id', Auth::id())->where('name', 'like', '%' . $data['name'] . '%')->with('media')->limit(itemsPerPage())->offset($offset)->get();
    }
    public function store($data)
    {
        $categoryData = jsonDecode('category', $data);
        $file = null;
        if (array_key_exists('file', $data)) {
            $file = $data['file'];
        }

        return DB::transaction(function () use ($categoryData, $file) {
            $categoryData['user_id'] = Auth::id();
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
