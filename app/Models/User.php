<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
// class User extends Authenticatable implements MustVerifyEmail
{ 
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'role_id',
        'anonymous',
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

    /**
     * Relationship: Seorang user memiliki satu role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relationship: Seorang user dapat memiliki banyak laporan.
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'sender_id');
    }

    /**
     * Relationship: Seorang user dapat memiliki banyak penerimaan laporan.
     */

     public function reportRecivers()
     {
         return $this->hasMany(ReportReciver::class, 'reciver_id');
     }
}
