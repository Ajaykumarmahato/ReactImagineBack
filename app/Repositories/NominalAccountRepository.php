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
            NominalAccount::create($data);
        });
    }
}
