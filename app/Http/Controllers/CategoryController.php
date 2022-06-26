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

    public function index()
    {
        return $this->respond($this->category->index());
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
}
