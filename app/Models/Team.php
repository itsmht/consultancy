<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Team extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'team_id';
    use HasFactory;
}
