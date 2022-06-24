<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    const UPLOAD_EMP_IMAGE_PATH  = '/public/assets/images/employee/';

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
