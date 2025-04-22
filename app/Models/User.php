<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    const ROLE_ADMIN = 'admin';
    const ROLE_SALES_MANAGER = 'sales_manager';
    const ROLE_SALES_PERSON = 'sales_person';

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isSalesManager()
    {
        return $this->role === self::ROLE_SALES_MANAGER;
    }

    public function isSalesPerson()
    {
        return $this->role === self::ROLE_SALES_PERSON;
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function scopeManagers($query)
    {
        return $query->where('role', self::ROLE_SALES_MANAGER);
    }

    public function scopeSalesPeople($query)
    {
        return $query->where('role', self::ROLE_SALES_PERSON);
    }
}
