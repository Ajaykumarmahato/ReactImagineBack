<?php

namespace App\Http\Controllers;

use App\Repositories\NominalAccountRepositoryInterface;
use Illuminate\Http\Request;

class NominalAccountController extends Controller
{
    protected $nominalaccount;

    public function __construct(NominalAccountRepositoryInterface $nominalaccount)
    {
        $this->nominalaccount = $nominalaccount;
    }

    public function store(Request $request)
    {
        return $this->respond($this->nominalaccount->store($request->all()), 'Data Added Successfully.');
    }
}
