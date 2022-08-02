<?php

namespace App\Http\Controllers;

use App\ApiCode;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        return $this->respond($this->category->index($request->all()));
    }

    public function getAllCategories()
    {
        return $this->respond($this->category->getAllCategories());
    }

    public function store(Request $request)
    {

        $commonController = new CommonController();
        $userData = jsonDecode('category', $request->all());
        $rules = [
            'name' => 'required',
        ];
        $validation = $commonController->validator($userData, $rules);
        if ($validation['response'] == false) {
            return $this->respondErrorWithMessage($validation['error'], ApiCode::VALIDATION_ERROR, 401);
        }
        return $this->respond($this->category->store($request->all()), 'Category Added Successfully.');
    }

    public function delete($id)
    {
        return $this->respond($this->category->delete($id), 'Category Deleted Successfully.');
    }

    public function search(Request $request)
    {
        return $this->respond($this->category->search($request->all()), 'Category Deleted Successfully.');
    }
}
