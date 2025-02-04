<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiUser extends Model
{
    protected $table = 'api_users';
    protected $primaryKey = 'api_user_id';
    use HasFactory;
}
