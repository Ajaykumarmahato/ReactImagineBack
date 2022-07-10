<?php

namespace App\Repositories;

use App\Models\NominalAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NominalAccountRepository implements NominalAccountRepositoryInterface
{

    public function store($data)
    {
        return DB::transaction(function () use ($data) {
            $data['is_income'] = $data['isIncome'];
            $data['user_id'] = Auth::id();
            $data['category_id'] = $data['categoryId'];
            NominalAccount::create($data);
        });
    }

    public function index($data)
    {
        return NominalAccount::where('user_id', Auth::id())->where('is_income', $data['isIncome'])->with('category')->get();
    }
}
