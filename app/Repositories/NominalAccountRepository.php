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
            $jsonData = jsonDecode('data', $data);
            $jsonData['user_id'] = Auth::id();
            $nominalAccount=NominalAccount::create($jsonData);
            if(array_key_exists('files',$data)){
                foreach($data['files'] as $file){
                    $nominalAccount->addMedia($file)->toMediaCollection('Nominal Account');
                }
            }
        });
    }

    public function index($data)
    {
        return NominalAccount::where('user_id', Auth::id())->where('is_income', $data['isIncome'])->with('category','media')->get();
    }
}
