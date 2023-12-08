<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuFunctionModel extends Model
{
    use HasFactory;

    protected $table = 'menu_function';
    protected $primaryKey = 'id';

}
