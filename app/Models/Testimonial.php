<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Testimonial extends Model
{
    protected $table = 'testimonials';
    protected $primaryKey = 'testimonial_id';
    use HasFactory;
}
