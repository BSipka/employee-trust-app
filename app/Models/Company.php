<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $with = 'advertisements';
    protected $fillable = [
        'name',
        'industry'
    ];
    public function advertisements()
    {
        return $this->hasManyThrough(Advertisement::class, User::class, 'company_id', 'employer_id');
    }
}
