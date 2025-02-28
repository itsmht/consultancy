<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ContactForm extends Model
{
    protected $table = 'contact_forms';
    protected $primaryKey = 'contact_form_id';
    use HasFactory;
}
