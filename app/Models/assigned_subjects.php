<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assigned_subjects extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject_id',
        'score'
    ];
}
