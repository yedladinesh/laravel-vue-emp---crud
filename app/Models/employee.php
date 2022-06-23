<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'empId',
        'name', 
        'email',
        'phone_number',
        'address',
        'dob',
        'image',
    ];    
}
