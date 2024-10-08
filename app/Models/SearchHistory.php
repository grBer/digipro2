<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    // Define the fillable fields to allow mass assignment
    protected $fillable = [
        'full_name',
        'email',
        'num_questions',
        'difficulty',
        'type',
    ];
}
