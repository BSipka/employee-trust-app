<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'company_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'employer_id');
    }
    public function applications()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_user')->withTimestamps();
    }

    public function advertisement_saved()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_saved')->withTimestamps();
    }

    public function fullName()
    {
        return $this->first_name . " " . $this->last_name;
    }
    public function isAdmin()
    {
        return $this->role === Role::ADMIN->value;
    }

    public function isApplicant()
    {
        return $this->role === Role::APPLICANT->value;
    }

    public function scopeEmployers(Builder $builder)
    {
        $builder->where('role', Role::EMPLOYER->value);
    }

    public function scopeApplicants(Builder $builder)
    {
        $builder->where('role', Role::APPLICANT->value);
    }
}
