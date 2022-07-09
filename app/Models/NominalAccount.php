<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominalAccount extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'amount',
        'description',
        'date',
        'is_income',
        'user_id',
        'category_id'
    ];
}
