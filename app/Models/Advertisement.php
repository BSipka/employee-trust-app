<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'job_title',
        'job_description',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
    public function applicants()
    {
        return $this->belongsToMany(User::class);
    }
}
